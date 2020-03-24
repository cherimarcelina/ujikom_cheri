<?php 
include "../koneksi.php";


$id = $_GET["id"];

if (hapus_u($id) > 0) {
	echo "
		<script>
			alert('data berhasil di hapus!!');
			document.location.href = 'user.php';
		</script>
	";
}else{
	echo "
		<script>
			alert('data gagal di hapus!!');
			document.location.href = 'user.php';
		</script>
	";
}

 ?>