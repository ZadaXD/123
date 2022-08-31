<?php
// Mengambil action di file koneksi.php
include "model.php";
//gambar
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

?> 
