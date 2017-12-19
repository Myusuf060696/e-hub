<?php
if (!empty($_GET['q'])){
	if (ctype_digit($_GET['q'])) {
		include '../koneksi/koneksi.php';
		$query = mysqli_query($koneksi, "SELECT * FROM lokasi where lokasi_propinsinyo=$_GET[q] and lokasi_kecamatannyo=0 and lokasi_kelurahannyo=0 and lokasi_kabupatenkota!=0 order by lokasi_namo");
		echo"<option selected value=''>Pilih Kota/Kab</option>";
		while($d = mysqli_fetch_array($query)){
			echo "<option value='$d[lokasi_kabupatenkota]&prop=$_GET[q]'>$d[lokasi_namo]</option>";
		}
		



	}
}

if (empty($_GET['kel'])){

	if (!empty($_GET['kec']) and !empty($_GET['prop'])){
		if (ctype_digit($_GET['kec']) and ctype_digit($_GET['prop'])) {
		include '../koneksi/koneksi.php';
			$query = mysqli_query($koneksi, "SELECT * FROM lokasi where lokasi_propinsinyo=$_GET[prop] and lokasi_kecamatannyo!=0 and lokasi_kelurahannyo=0 and lokasi_kabupatenkota=$_GET[kec] order by lokasi_namo");
			echo"<option selected value=''>Pilih Kecamatan</option>";
			while($d = mysqli_fetch_array($query)){
				echo "<option value='$d[lokasi_kecamatannyo]&kec=$d[lokasi_kabupatenkota]&prop=$d[lokasi_propinsinyo]''>$d[lokasi_namo]</option>";
			}
		}
	}
} else {
	if (!empty($_GET['kec']) and !empty($_GET['prop'])){
		if (ctype_digit($_GET['kec']) and ctype_digit($_GET['prop'])) {
		include '../koneksi/koneksi.php';
			$query = mysqli_query($koneksi, "SELECT * FROM lokasi where lokasi_propinsinyo=$_GET[prop] and lokasi_kecamatannyo=$_GET[kel] and lokasi_kelurahannyo!=0 and lokasi_kabupatenkota=$_GET[kec] order by lokasi_namo");
			echo"<option selected value=''>Pilih Kelurahan/Desa</option>";
			while($d = mysqli_fetch_array($query)){
				echo "<option value='$d[lokasi_cirinyo]'>$d[lokasi_namo]</option>";
			}
		}
	}
}
?>
