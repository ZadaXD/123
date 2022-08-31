<?php
$host = "localhost"; // Nama hostnya
$user = "root"; // Username
$pass = ""; // Password (Isi jika menggunakan password)
$db = "gambar"; // Database (Isikan dengan nama database yang kamu buat)
$connect = mysqli_connect($host, $user, $pass, $db); // Koneksi ke MySQL
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identitas</title>
    <link rel="stylesheet" type="text/css" href="css/css.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<!-- Membuat form upload dengan action upload.php -->
<center>
<h1>Form Upload Gambar</h1>
<form method="post" enctype="multipart/form-data" action="../denganmvc/upload_controller.php">
    <input type="file" name="gambar">
    <input type="submit" value="Upload">
</form>
</center>
<!-- Form menampilkan data gambar ke dalam tabel -->
<h2>Data Gambar</h2><hr>
<table class="table table-striped">
<tr>
    <th>Gambar</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Tempat Lahir</th>
    <th>Tanggal Lahir</th>
    <th>Mimpi</th> 
    <th>Action</th>
</tr>

    <!-- Membuat proses tampil data -->
<?php
// Memanggil semua data dalam tabel gambar
$query = "SELECT * FROM gambar";
// Eksekusi/Jalankan query dari variabel $query
$sql = mysqli_query($connect, $query);
// Ambil jumlah data dari hasil eksekusi $sql
$row = mysqli_num_rows($sql);
// Kondisi perulangan Jika jumlah data lebih dari 0 (Berarti jika data ada)
if($row > 0){
    // Mengambil semua data dari hasil eksekusi $sql
  while($data = mysqli_fetch_array($sql)){
    $tanggal_php = strtotime($data["Tanggal_Lahir"]);
    $tanggal = date("d - m - Y", $tanggal_php);
    echo "<tr>";
    echo "<td><img src='images/".$data['nama_file']."' width='100' height='100'></td>";
    echo "<td>".$data['Nama']."</td>";
    echo "<td>".$data['alamat']."</td>";
    echo "<td>".$data['Tempat_Lahir']."</td>";
    echo "<td>".$data['Tanggal_Lahir']."</td>";
    echo "<td>".$data['mimpi']."</td>";
    echo "<td><a href='hapus_controller.php?id=$data[id]'>Hapus</a></td></tr>";

}
}
function upload(){
    $gambar_file = $_FILES['gambar']['name'];
// Ambil Data yang Dikirim dari Form upload
$nama_file = $_FILES['gambar']['name'];
// Ambil ukuran files dalam bentuk bytes
$ukuran_file = $_FILES['gambar']['size'];
// Ambil tipe gambar berupa JPG / JPEG / PNG
$tipe_file = $_FILES['gambar']['type'];
// Ambil url path folder
$tmp_file = $_FILES['gambar']['tmp_name'];

// Set path folder tempat menyimpan gambarnya
$path = "images/".$nama_file;

// Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){

  // Jika tipe file yang diupload JPG / JPEG / PNG, lakukan tindakan :
  // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
  if($ukuran_file <= 1000000){
    // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
    // Proses upload
    if(move_uploaded_file($tmp_file, $path)){
      // Cek apakah gambar berhasil diupload atau tidak
      // Jika gambar berhasil diupload, Lakukan :  
      // Proses simpan ke Database
      $query = "INSERT INTO gambar(nama_file) VALUES('".$gambar_file."')";
      // Eksekusi/ Jalankan query dari variabel $query
      $sql = mysqli_query($connect, $query);

        // Cek jika proses simpan ke database sukses atau tidak
      if($sql){
        // Jika Sukses, Lakukan :
        header("location: view.php"); // Redirectke halaman index.php
      }else{
        // Jika Gagal, Lakukan :
        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
        echo "<br><a href='view.php'>Kembali Ke Form</a>";
      }
    }else{
      // Jika gambar gagal diupload, Lakukan ini
      echo "Maaf, Gambar gagal untuk diupload.";
      echo "<br><a href='form.php'>Kembali Ke Form</a>";
    }
  }else{
    // Jika ukuran file lebih dari 1MB, lakukan :
    echo "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB";
    echo "<br><a href='view.php'>Kembali Ke Form</a>";
  }
}else{
  // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
  echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
  echo "<br><a href='view.php'>Kembali Ke Form</a>";
}
}
?> 
</table>
</body>
</html>