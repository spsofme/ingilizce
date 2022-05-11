async function tabloCek(_tablo, _aranan='') {
	await fetch('req.php', {
		method: 'POST',
		body: `bolum=${_tablo}${_aranan ? `&aranan=${_aranan}` : ''}&tablo_cek=1`,
		headers: { 'Content-type' : 'application/x-www-form-urlencoded; charset=UTF-8' }
	})
		.then(response => response.text())
		.then(result => {
			try {
				document.querySelectorAll(`#${_tablo} > tbody > tr:not(:nth-child(1))`).forEach(element => {
					document.querySelector(`#${_tablo} > tbody`).removeChild(element);
				});
			} catch (e) {}
			const tr_gecici = document.createElement('tr');
			tr_gecici.classList.add("gecici");
			document.querySelector(`#${_tablo} > tbody`).appendChild(tr_gecici);
			document.querySelector(`#${_tablo} > tbody > tr.gecici`).outerHTML = result;
		})
		.catch(err => console.error(err));
}

async function veriEkle(_tablo, _veri) {
	console.info(`Veri ekle (${_tablo}) : [${_veri.toString()}]`);
	
	await fetch('req.php', {
		method: 'POST',
		body: `bolum=${_tablo}&veriler=${_veri.toString()}&veri_ekle=1`,
		headers: { 'Content-type' : 'application/x-www-form-urlencoded; charset=UTF-8' }
	})
		.then(response => response.text())
		.then(result => {
			tabloCek(_tablo);
		})
		.catch(err => console.error(err));
}

async function veriSil(_tablo, _veri) {
	console.warn(`Veri sil (${_tablo}) : [${_veri.toString()}]`);

	await fetch('req.php', {
		method: 'POST',
		body: `bolum=${_tablo}&veriler=${_veri.toString()}&veri_sil=1`,
		headers: { 'Content-type' : 'application/x-www-form-urlencoded; charset=UTF-8' }
	})
		.then(response => response.text())
		.then(result => {
			console.log(result);
			tabloCek(_tablo);
		})
		.catch(err => console.error(err));
}

// veri silmeyi tetikleyecek fonksiyon
function sil(_tablo, _index) {
	veriler = [];
	let i = 1;
	document.querySelectorAll(`#${_tablo} > tbody > tr:nth-child(${_index+1}) > th`).forEach(element => {
		if (i > 1 && i < document.querySelectorAll(`#${_tablo} > tbody > tr:nth-child(${_index+1}) > th`).length) {
			veriler[veriler.length] = btoa(unescape(encodeURIComponent(element.innerText)));
		}
		i++;
	});
	veriSil(_tablo, veriler);
}
