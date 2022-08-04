$insert = mysqli_query
($koneksi, "INSERT INTO prduk(nama_produk, deskripsi, harga, stock)    
 VALUES ('$nama_produk','$deskripsi','$harga', $stock)");  
 
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