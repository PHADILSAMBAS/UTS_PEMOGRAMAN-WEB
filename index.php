<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Toko Jaya</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
</body>
</html>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa apakah formulir dikirimkan melalui metode POST

    $nama = $_POST["nama"];
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];
    $tanggal_rilis = $_POST["tanggal_rilis"];

    // Memanggil fungsi validasi sebelum data disimpan ke database
    if (validasiForm($nama, $jenis, $harga, $stok, $tanggal_rilis)) {
        // Lakukan operasi penyimpanan data ke database di sini
        echo "Data berhasil disimpan ke database.";
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

?>

<div class="container">
    <h1 align="center"><B>FORM INPUT BARANG</B> </h1>
    <form action="" method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br>

        <label for="jenis">Jenis:</label>
        <input type="text" id="jenis" name="jenis" required><br>

        <label for="harga">Harga:</label>
        <input type="text" id="harga" name="harga" required><br>

        <label for="stok">Stok:</label>
        <input type="text" id="stok" name="stok" required><br>

        <label for="tanggal_rilis">Tanggal Rilis:</label>
        <input type="text" id="tanggal_rilis" name="tanggal_rilis" placeholder="YYYY-MM-DD" required><br>

        <input type="submit" value="Kirim">
    </form>
</div>

</body>
</html>

</body>

</html>

