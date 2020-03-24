<?php 
// menghubungkan dengan koneksi
$koneksi = mysqli_connect("localhost", "root", "", "ujikom_cheri");
// cek koneksi
if (mysqli_connect_errno()) {
  echo "koneksi database gagal :" . mysqli_connect_error();
}

function query($query){
  global $koneksi;
  $result = mysqli_query($koneksi, $query);
  $rows = [];
  while($row = mysqli_fetch_assoc($result)){
    $rows [] = $row;
  }
  return $rows;
}

// tambah user
function tambah_u($data){
  global $koneksi;
$user=htmlspecialchars($data["username"]);
$password=htmlspecialchars($data["password"]);
$nama=htmlspecialchars($data["nama_user"]);
$level=htmlspecialchars($data["id_level"]);

  $query ="INSERT into user values ('','$user','$password','$nama','$level')";
  mysqli_query($koneksi,$query);
  return mysqli_affected_rows($koneksi);
}

// ket
function query_ket($query) {
  global $koneksi;
  $ket = mysqli_query($koneksi, $query);
  $rows = [];
  while( $row = mysqli_fetch_assoc($ket) ){
    $rows[] = $row;
  }
  return $rows;
 }

function tambah_ket($data){
global $koneksi;
$user=htmlspecialchars($data["ket"]);


  $query="UPDATE detail_order SET
      keterangan='$nama'
      WHERE
      id_masakan='$id'
      ";

  mysqli_query($koneksi,$query);
  return mysqli_affected_rows($koneksi);
}
//uba user

function ubah_u($data){
  global $koneksi;
  $user=htmlspecialchars($data["username"]);
  $nama=htmlspecialchars($data["nama_user"]);
  $level=htmlspecialchars($data["id_level"]);
  

 
  $query="UPDATE user SET
      nama_user='$nama',
      username='$user',
      id_level='$level'
      WHERE
      id_user = $id";

  mysqli_query($koneksi,$query);
  return mysqli_affected_rows($koneksi);

  }


//hapus user
function hapus_u($id) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM user WHERE id_user = $id");
	return mysqli_affected_rows($koneksi);
}

//registrasi
function registrasi($data){
	global $koneksi;

	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
	$nama=strtolower(stripcslashes($data["nama_user"]));
	$level=strtolower(stripcslashes($data["id_level"]));



	//cek username sudah ada aatu belum
	$result = mysqli_query($koneksi, "SELECT username, nama_user FROM user WHERE username = '$username' and nama_user = '$nama'");
	if( mysqli_fetch_assoc($result) ){

		echo "<script>
					alert('username yang dipilih sudah terpakai');
			  </script>";

			  return false;
	}

	// // //enksripsipassworrd
	// $password = password_hash($password, PASSWORD_DEFAULT);

	//tambahkan user baru ke databases
	mysqli_query($koneksi, "INSERT into user values ('','$username','$password','$nama','$level')");

	return mysqli_affected_rows($koneksi);
}

// upload
function upload(){
  $namaFile=$_FILES['foto']['name'];
  $ukuranFile=$_FILES['foto']['size'];
  $error=$_FILES['foto']['error'];
  $tmpName=$_FILES['foto']['tmp_name'];
// // cek apakah tidak ada gambar yang diupload
  if( $error === 4){
    echo "
    <script>
      alert('pilih gambar terlebih dahulu!');
    </script>";

    return false;
  } 
  $ekstensiGambarValid=['jpg','jpeg','png'];
  $ekstensiGambar=explode('.', $namaFile);
  $ekstensiGambar=strtolower(end($ekstensiGambar));
  if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
    echo "
    <script>
      alert('yang anda upload bukan gambar')
    </script>";
    return false;

  }
  $namafile_baru=uniqid();
  $namafile_baru.= '.';
  $namafile_baru.=$ekstensiGambar;
  $folder ="../img/";
  move_uploaded_file($tmpName,$folder . $namafile_baru);
  return $namafile_baru;
}


// tambah masakan
function tambah($data){
  global $koneksi;
  $nama=htmlspecialchars($data["nama_masakan"]);
  $harga=htmlspecialchars($data["harga"]);
  $status=htmlspecialchars($data["status_masakan"]);
  // $kode= 'QU00'.
  $text = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
  $pnj = 4;
  $text1 = strlen($text)-1;
  $kode_tiket ='';
  for ($i=1; $i<=$pnj; $i++) { 
    $kode_tiket .= $text[rand(0, $text1)];
  }

$foto = upload();
if( !$foto ){
  return false;
}
  $query ="INSERT into masakan values ('','$kode_tiket','$foto','$nama','$harga','$status')";

  mysqli_query($koneksi,$query);
  return mysqli_affected_rows($koneksi);
}

// ubah masakan
// ubah galeri
function query_m($query) {
  global $koneksi;
  $menu = mysqli_query($koneksi, $query);
  $rows = [];
  while( $row = mysqli_fetch_assoc($menu) ){
    $rows[] = $row;
  }
  return $rows;
 }
function ubah_m($data){
  global $koneksi;
  $id = $data["id"];
  $nama=htmlspecialchars($data["nama_masakan"]);
  $harga=htmlspecialchars($data["harga"]);
  $status=htmlspecialchars($data["status_masakan"]);
  $gambarLama = htmlspecialchars($data["gambarLama"]);
  // apakah yang di pilih gambar
  if($_FILES['foto']['error'] === 4){
    $foto = $gambarLama;
  } else {
    $foto = upload();
  }
  $query="UPDATE masakan SET
      foto='$foto',
      nama_masakan='$nama',
      harga='$harga',
      status_masakan='$status'
      WHERE
      id_masakan='$id'
      ";

  mysqli_query($koneksi,$query);
  return mysqli_affected_rows($koneksi);
  }

//hapus menu
function hapus_m($id) {
  global $koneksi;
  mysqli_query($koneksi, "DELETE FROM masakan WHERE id_masakan = $id");
  return mysqli_affected_rows($koneksi);
}

//order

function order($data){
  global $koneksi;
  $id = $data['id'];
 $sql = mysqli_query($koneksi,"SELECT id_masakan FROM keranjang WHERE id_masakan='$id' AND id_session='$sid'");
 $ketemu=mysqli_num_rows($sql);        
 if ($ketemu==0){                
 // kalau barang belum ada, maka di jalankan perintah insert                
 mysqli_query($koneksi,"INSERT INTO keranjang (id_keranjang, jumlah, id_masakan) VALUES ('', 1, '$id')");} 
 else {                
 //  kalau barang ada, maka di jalankan perintah update                
  mysqli_query($koneksi,"UPDATE keranjang SET jumlah = jumlah + 1 WHERE id_masakan ='$id'");        
 }        

} 

