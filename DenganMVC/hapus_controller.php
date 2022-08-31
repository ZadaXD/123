<?php
// Mengambi action file koneksi.php
include 'model.php';
// Mengambil id
$id = $_GET['id'];
// Melakukan perintah query delete berdasarkan id dalam tabel gambar
$result = mysqli_query($connect, "DELETE FROM gambar WHERE id=$id");
//  Kembali kehalaman index.php
header("location:view.php");

?>