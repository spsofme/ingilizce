// başlangıç olayları
tabloCek('kelimeler');

let menu = 'kelimeler';

// arama
document.getElementById('btn_ara').addEventListener('click', () => {
	tabloCek(menu, document.getElementById('input_ara').value.trim())
});
document.getElementById('input_ara').addEventListener('input', () => {
	tabloCek(menu, document.getElementById('input_ara').value.trim())
});

// veri çek
for (let i = 0; i < document.querySelectorAll('#sidebar > ul > li').length; i++) {
	document.querySelectorAll('#sidebar > ul > li')[i].addEventListener('click', () => {
		menu = document.querySelectorAll('#sidebar > ul > li')[i].getAttribute('target');
		// sidebar daki seçeneğin renklendirilmesi
		document.querySelector('#sidebar > ul > li > a.active').classList.remove('active');
		document.querySelectorAll('#sidebar > ul > li > a')[i].classList.add('active');
		
		// başlığu değiştirme
		document.getElementById('baslik').innerText = document.querySelectorAll('#sidebar > ul > li > a')[i].innerText;

		// menüyü gösterme
		document.querySelector('#icerik > table.active').classList.remove('active');
		document.getElementById(menu).classList.add('active');

		// tabloyu yazdırma
		tabloCek(menu);
	});
}

// veri ekle
for (let i = 0; i < document.querySelectorAll('tr.ekle > th > button').length; i++) {
	document.querySelectorAll('tr.ekle > th > button')[i].addEventListener('click', () => {
		veriler = [];
		document.querySelectorAll(`#${menu} > tbody > tr > th > input`).forEach(element => {
			element.value = element.value.trim();
			veriler[veriler.length] = btoa(unescape(encodeURIComponent(element.value)));
			//veriler[veriler.length] = btoa(element.value);
			element.value = '';
		});
		let ekle = true;
		veriler.forEach(veri => {
			if (ekle) ekle = veri ? true : false;
		});
		if (ekle) veriEkle(menu, veriler);
	});
}
