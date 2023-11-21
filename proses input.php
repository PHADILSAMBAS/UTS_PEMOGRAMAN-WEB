<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Toko Jaya</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>

<?php

$servername = "localhost";  // Ganti dengan nama server Anda
$username = "";  // Ganti dengan nama pengguna Anda
$password = "";     // Ganti dengan kata sandi Anda
$database = "2106176_sambas";  // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];
    $tanggal_rilis = $_POST["tanggal_rilis"];

    // Memanggil fungsi validasi sebelum data disimpan ke database
    if (validasiForm($nama, $jenis, $harga, $stok, $tanggal_rilis)) {
        // Melakukan operasi penyimpanan data ke database
        $sql = "INSERT INTO toko_jaya (nama, jenis, harga, stok, tanggal_rilis) 
                VALUES ('$nama', '$jenis', $harga, $stok, '$tanggal_rilis')";

        if ($conn->query($sql) === TRUE) {
            echo "Data berhasil disimpan ke database.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

function validasiForm($nama, $jenis, $harga, $stok, $tanggal_rilis) {
    $error = false;

    // Validasi nama (wajib diisi)
    if (empty($nama)) {
        echo "<p class='error'>Nama wajib diisi.</p>";
        $error = true;
    }

    // Validasi jenis (wajib diisi)
    if (empty($jenis)) {
        echo "<p class='error'>Jenis wajib diisi.</p>";
        $error = true;
    }

    // Validasi harga (wajib diisi dan harus angka)
    if (!is_numeric($harga) || $harga <= 0) {
        echo "<p class='error'>Harga harus diisi dengan angka yang lebih besar dari 0.</p>";
        $error = true;
    }

    // Validasi stok (wajib diisi dan harus angka)
    if (!is_numeric($stok) || $stok < 0) {
        echo "<p class='error'>Stok harus diisi dengan angka yang tidak kurang dari 0.</p>";
        $error = true;
    }

    // Validasi tanggal_rilis (wajib diisi dan harus format tanggal yang benar)
    $tanggal_rilis_obj = DateTime::createFromFormat('Y-m-d', $tanggal_rilis);
    if (!$tanggal_rilis_obj || $tanggal_rilis_obj->format('Y-m-d') !== $tanggal_rilis) {
        echo "<p class='error'>Format tanggal_rilis tidak valid.</p>";
        $error = true;
    }

    return !$error;
}

// Menutup koneksi
$conn->close();

?>

<form action="" method="post">
    Nama: <input type="text" name="nama"><br>
    Jenis: <input type="text" name="jenis"><br>
    Harga: <input type="text" name="harga"><br>
    Stok: <input type="text" name="stok"><br>
    Tanggal Rilis: <input type="text" name="tanggal_rilis" placeholder="YYYY-MM-DD"><br>
    <input type="submit" value="Kirim">
</form>

</body>
</html>
