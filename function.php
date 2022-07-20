<?php
session_start();

$koneksi = mysqli_connect('localhost', 'root', '', 'inventory');

if (isset($_POST['login'])) {
    //initial variable
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = mysqli_query(
        $koneksi,
        "SELECT * FROM user 
        WHERE username='$username' 
            AND password='$password'"
    );
    $hitung = mysqli_num_rows($check);

    if ($hitung > 0) {
        // jika datanya ada, dan ditemukan 
        // berhasil login
        $_SESSION['login'] = true;
        header('location:index.php');
    } else {
        //Datanya g ada
        // gagal login
        echo '
        <script>
        alert("Username atau Password salah")
        window.location.href="login.php"
        </script>';
    }
}

if (isset($_POST['tambahpelanggan'])) {
    // initial variable
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];

    $tambahpelanggan = mysqli_query(
        $koneksi,
        "INSERT INTO pelanggan (nama_pelanggan, no_telp, alamat) 
   VALUES ('$nama_pelanggan','$no_telp','$alamat')"
    );

    if ($tambahpelanggan) {
        // kalau sukses
        header('location:pelanggan.php');
    } else {
        echo '<script>
    alert("Gagal Tambag Pelanggan")
    window.location.href="pelanggan.php"
    </script>';
    }
}

if (isset($_POST['hapuspelanggan'])) {
    $id_pelanggan = $_POST['id_pelanggan'];

    $hapuspelanggan = mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");

    if ($hapuspelanggan) {
        // kalau sukses
        header('location:pelanggan.php');
    } else {
        echo '<script> 
        alert("Gagal Hapus Pelanggan")
        window.location.href="pelanggan.php"
        </script>';
    }
}

//edit pelanggan
if (isset($_POST['editpelanggan'])) {

    $nama_pelanggan = $_POST['nama_pelanggan'];
    $notelp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];
    $id_pelanggan = $_POST['id_pelanggan'];

    $edit_pelanggan = mysqli_query($koneksi, "UPDATE pelanggan SET nama_pelanggan='$nama_pelanggan', no_telp='$notelp', alamat='$alamat' WHERE id_pelanggan='$id_pelanggan'");

    if ($edit_pelanggan) {
        header('location:pelanggan.php');
    } else {
        echo '
        <script>
        alert("Gagal Edit Pelanggan")
        window.location.href="pelanggan.php"
        </script>';
    }
}

if (isset($_POST['tambahproduk'])) {
    //deskripsi initial variable
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];

    $tambahproduk = mysqli_query(
        $koneksi,
        "INSERT INTO product (nama_produk, deskripsi, harga, stock) 
   VALUES ('$nama_produk','$deskripsi','$harga', $stock)"
    );

    if ($tambahproduk) {
        // kalau sukses
        header('location:stock.php');
    } else {
        echo '<script>
    alert("Gagal Tambah Produk")
    window.location.href="stock.php"
    </script>';
    }
}
if (isset($_POST['editproduk'])) {

    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];
    $id_produk = $_POST['id_produk'];

    $edit_produk = mysqli_query($koneksi, "UPDATE product SET nama_produk='$nama_produk', 
                                deskripsi='$deskripsi', 
                                harga='$harga',
                                stock='$stock' WHERE id_produk='$id_produk'");

    if ($edit_produk) {
        header('location:stock.php');
    } else {
        echo '
        <script>
        alert("Gagal Edit Stock")
        window.location.href="stock.php"
        </script>';
    }
}
if (isset($_POST['hapusproduk'])) {
    $id_produk = $_POST['id_produk'];

    $hapusproduk = mysqli_query($koneksi, "DELETE FROM product WHERE id_produk='$id_produk'");

    if ($hapusproduk) {
        // kalau sukses
        header('location:stock.php');
    } else {
        echo '<script> 
        alert("Gagal Hapus Stock")
        window.location.href="stock.php"
        </script>';
    }
}