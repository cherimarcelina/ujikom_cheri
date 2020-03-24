<?php 
include "../koneksi.php";
$id = $_GET["id"];

if (hapus_m($id) > 0) {
	echo "
		<script>
			alert('data berhasil di hapus!!');
			document.location.href = 'menu.php';
		</script>
	";
}else{
	echo "
		<script>
			alert('data gagal di hapus!!');
			document.location.href = 'menu.php';
		</script>
	";
}

 ?>