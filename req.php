<?php
error_reporting(0);

$host = 'localhost';
$dbname = 'ingilizce';
$username = 'root';
$password = '123456789Fa';

try {
	$db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->exec("SET NAMES utf8");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    print "<script>alert('Veritabanı bağlantısı oluşturulamadı! HATA: ".$e->getMessage()."');</script>";
    die();
}

// veri sil
if (isset($_POST['bolum']) && isset($_POST['veriler']) && isset($_POST['veri_sil'])) {
	$tablo = $_POST['bolum'];
	$veriler_str = $_POST['veriler'];
	$veriler_arr = explode(',', $veriler_str);
	for ($i = 0; $i < count($veriler_arr); $i++)
		$veriler_arr[$i] = base64_decode($veriler_arr[$i]);

	// sütun isimlerini çekme
	$sutunlar = [];
	$sorgu = $db->query("SELECT column_name FROM information_schema.columns WHERE table_name = '$tablo' ORDER BY ORDINAL_POSITION")->fetchAll(PDO::FETCH_ASSOC);
	foreach ($sorgu as $sutun) {
		if ($sutun['COLUMN_NAME'] != 'ID')
			$sutunlar[] = $sutun['COLUMN_NAME'];
	}

	$veri_yapisi_arr = [];
	for($i = 0; $i < count($veriler_arr); $i++)
		$veri_yapisi_arr[] = "`".$sutunlar[$i]."`=?";
	
	$veri_yapisi_str = implode(' AND ', $veri_yapisi_arr);
	
	$sorgu = $db->prepare("DELETE FROM $tablo WHERE $veri_yapisi_str");
	if ($sorgu->execute($veriler_arr))
		echo "silindi";
}

// veri ekleme
if (isset($_POST['bolum']) && isset($_POST['veriler']) && isset($_POST['veri_ekle'])) {
	$tablo = $_POST['bolum'];
	$veriler_str = $_POST['veriler'];
	$veriler_arr = explode(',', $veriler_str);
	for ($i = 0; $i < count($veriler_arr); $i++)
		$veriler_arr[$i] = base64_decode($veriler_arr[$i]);

	$veri_sayisi_arr = [];
	for($i = 0; $i < count($veriler_arr); $i++)
		$veri_sayisi_arr[] = "?";

	$veri_sayisi_str = implode(',', $veri_sayisi_arr);
	$sorgu = $db->prepare("INSERT INTO $tablo values (NULL, $veri_sayisi_str)");
	$exec = $sorgu->execute($veriler_arr);
}

// tablo çekme
if (isset($_POST['bolum']) && isset($_POST['tablo_cek'])) {
	$tablo = $_POST['bolum'];
	$aranan = $_POST['aranan'] ? $_POST['aranan'] : '';

	if ($aranan) {
		// sütun isimlerini çekme
		$sutunlar = [];
		$sorgu = $db->query("SELECT column_name FROM information_schema.columns WHERE table_name = '$tablo' ORDER BY ORDINAL_POSITION")->fetchAll(PDO::FETCH_ASSOC);
		foreach ($sorgu as $sutun) {
			if ($sutun['COLUMN_NAME'] != 'ID')
				$sutunlar[] = "`".$sutun['COLUMN_NAME']."`";
		}
		$sutunlar_str = implode(' OR ', $sutunlar);

		$like_arr = [];
		for ($i = 0; $i < count($sutunlar); $i++) {
			$like_arr[] = "(".$sutunlar[$i]." LIKE '%$aranan%')";
		}
		$like_str = implode(' OR ', $like_arr);

		$tablo_cek = $db->query("SELECT * FROM $tablo WHERE $like_str ORDER BY 2")->fetchAll(PDO::FETCH_ASSOC);
	}
	else
		$tablo_cek = $db->query("SELECT * FROM $tablo ORDER BY 2")->fetchAll(PDO::FETCH_ASSOC);

	$i = 1;
	foreach ($tablo_cek as $arr) { ?>
		<tr>
			<?php
			$j = 0;
			foreach ($arr as $k => $v) {
			?>
				<th <?php echo ($j===0 ? 'scope="row"' : ''); ?>><?php echo ($j===0 ? $i : htmlspecialchars($v)); $j++; ?></th>
			<?php } ?>
			<th>
				<button class="btn btn-outline-danger" onclick="sil('<?php echo $tablo; ?>', <?php echo $i; ?>)">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
						<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
						<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
					</svg>
				</button>
			</th>
		</tr>
<?php
		$i++;
	}
}

$db = null;

?>
