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
<form method="post" enctype="multipart/form-data" action="upload_controller.php">
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
// Mengambil action dari file koneksi.php
include "model.php";
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
?>
</table>
</body>
</html>