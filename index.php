<!DOCTYPE html>
<html>
<head>
	<title>DENZ STORE</title>
	<link rel="shortcut icon" type="image/png" href="gambar/contoh.jpg"/>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	 <header>
    <img src="gambar/contoh.jpg" alt="Logo">
    <h1>JOKI BY DENZ</h1>
 	 </header>
	<h1>Jasa Joki Mobile Legend</h1>
	<form method="POST" action="">
		<label for="nama">Nama User:</label>
		<input type="text" name="nama" required>

		<label for="id">ID Mobile Legend:</label>
		<input type="text" name="id" required>

		<label for="req">Request Hero (maks.3):</label>
		<textarea name="req" required></textarea>

		<label for="jenis_joki">Jenis Joki:</label>
		<select name="jenis_joki" required>
			<option value="==PILIH==">==PILIH==</option>
			<option value="Epic - Mitik Grading">Epic - Mitik Grading</option>
			<option value="Epic - Legend">Epic - Legend</option>
			<option value="Epic - Mitik Glory">Epic - Mitik Glory</option>
			<option value="Legend - Mitik Glory">Legend - Mitik Glory</option>
		</select>

		<label for="waktu">Waktu Pengerjaan:</label>
		<input type="number" name="waktu" min="1" max="12" required>JAM (1-12 jam)<br>
		<br>
		<input type="submit" name="proses" value="Buat Pesanan"><input type="reset" value="Hapus Form">
	</form>

	<button id="scroll-up" onclick="topFunction()">Scroll Up</button>

<script>
		// ambil tombol scroll up
		var btnScrollUp = document.getElementById("scroll-up");

		// fungsi untuk menampilkan tombol scroll up
		window.onscroll = function() {
			if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				btnScrollUp.style.display = "block";
			} else {
				btnScrollUp.style.display = "none";
			}
		};

		// fungsi untuk melakukan scroll up
		function topFunction() {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}
	</script>

	<?php
		// Cek jika form telah di-submit
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$nama = $_POST['nama'];
			$id = $_POST['id'];
			$req = $_POST['req'];
			$jenis_joki = $_POST['jenis_joki'];
			$waktu = $_POST['waktu'];

			// Simpan data ke dalam file JSON
			$file = 'data/data.json';
			$json_data = file_get_contents($file);
			$array_data = json_decode($json_data, true);

			// Simpan data ke dalam array
			$data = array(
				'nama' => $nama,
				'id' => $id,
				'req' => $req,
				'jenis_joki' => $jenis_joki,
				'waktu' => $waktu,		
			);

			array_push($array_data, $data);
			array_multisort($array_data, SORT_ASC);
			$json_data = json_encode($array_data, JSON_PRETTY_PRINT);
			file_put_contents($file, $json_data);

			// Tampilkan pesan sukses
			echo "<p class='success'>Pesanan anda berhasil disimpan.</p>";
		}
	?>

	<p><br><br>
		<h3>LIST PESANAN JOKI</h3>
		<table style="width: ;: 100%" border="1" style="text-align: center;">
		<tr>
			<td>Nama User</td>
			<td>ID Mobile Legend</td>
			<td>Request Hero</td>
			<td>Jenis Joki</td>
			<td>Waktu Pengerjaan</td>
			<td>Total Harga</td>
		</tr>	

<?php
$array_data = array();
for ($i=0; $i < count($array_data); $i++) { 
	$nama = $array_data[$i]['nama'];
	$id = $array_data[$i]['id'];
	$req = $array_data[$i]['req'];
	$jenis_joki = $array_data[$i]['jenis_joki'];
	$waktu = $array_data[$i]['waktu'];


	if ($jenis_joki == "Epic - Mitik Grading") $teksjenis_joki = "Epic - Mitik Grading"; 
	elseif ($jenis_joki == "Epic - Legend") $teksjenis_joki = "Epic - Legend";
	elseif ($jenis_joki == "Epic - Mitik Glory") $teksjenis_joki = "Epic - Mitik Glory";
	elseif ($jenis_joki == "Legend - Mitik Glory") $teksjenis_joki = "Legend - Mitik Glory";

	if ($jenis_joki == 'Epic - Mitik Grading') {
		$price = $waktu * 50000;
	} elseif ($jenis_joki == 'Epic - Legend') {
		$price = $waktu * 40000;
	} elseif ($jenis_joki == 'Epic - Mitik Glory') {
		$price = $waktu * 80000;
	} elseif ($jenis_joki == 'Legend - Mitik Glory') {
		$price = $waktu * 70000;
	}
	
	echo "<tr>
		<td>".$nama."</td>
		<td>".$id."</td>
		<td>".$req."</td>
		<td>".$teksjenis_joki."</td>
		<td>".$waktu."</td>
		<td>".$price."</td>
		</tr>";
}
?>
</table>
</body>
</html>
