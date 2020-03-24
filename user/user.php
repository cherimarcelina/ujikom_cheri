<?php 
include "../hal/sidebar.php";
if ($_SESSION['akun_level'] != 1) { header("location:../index.php");}
 $result = mysqli_query($koneksi,"SELECT * FROM user u inner join level l  on u.id_level=l.id_level");
 ?>

<h1>USER</h1>
<hr>
<div class="row">
	<div class="col-md-6 mb-3">
		<a href="../register.php" class="btn btn-primary">[+] Tambah</a>
	</div>
	<!-- <div class="col-md-6 mb-3">
		<form method="post" action="" autocomplete="on">
			<div class="input-group">
				<input type="text" name="inputan"
				placeholder="masukan yang anda cari"
				class="form-control">
				<div class="input-group-append">
					<button type="submit" name="cari" value="cari" class="btn btn-primary">
						Search !
					</button>
				</div>
			</div>
		</form>
	</div> -->
</div>

<table class="table table-striped mb-3">
	<tr>
		<th>Nama Pengguna</th><th>Username</th><th>Akses</th><th></th>
	</tr>
<?php while($row = mysqli_fetch_assoc($result)) : ?>
	<tr>
		<td><?= $row["nama_user"]; ?></td>
		<td><?= $row["username"]; ?></td>
		<td><?= $row["nama_level"]; ?></td>
		 
		<td>

			<a class="btn btn-success btn-sm fa fa-w fa-edit" href="ubah.php?id=<?= $row["id_user"]; ?>" style="height: 30px;">ubah</a>
<?php if ($_SESSION['user'] != $row["id_user"] ) {?>
			<a href="hapus_user.php?id=<?= $row["id_user"]; ?>" onclick="return confirm('yakin?');" class="btn btn-danger btn-sm btn-trash fa fa-w fa-trash" style="height: 30px;">Hapus</a>
		<?php } ?>
		
		</td>
	</tr>
<?php endwhile; ?>
</table>
<?php include "../hal/footer.php"; ?>