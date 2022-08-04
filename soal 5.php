<?php                                     
$getview = mysqli_query(                                         
    $koneksi,                                         
    "SELECT * FROM detail_pesanan p, produk pr, pelanggan pl WHERE p.id_produk=pr.id_produk AND id_pesanan='$idp' AND id_pelanggan='$idpel'"                                     );                                     $i = 1;                                      while ($ap = mysqli_fetch_array($getview)) {                                         $idpr = $ap['id_produk'];                                         $iddetail = $ap['id_detailpesanan'];                                         $idp = $ap['id_pesanan'];                                         $qty = $ap['qty'];                                         $harga = $ap['harga'];                                         $namaproduk = $ap['nama_produk'];                                         $deskripsi = $ap['deskripsi'];                                         $subtotal = $qty * $harga;                                     
    ?>                                     
    <tr>                                         
        <td><?= $i++; ?></td>                                         
        <td><?= $namaproduk; ?> (<?= $deskripsi;  ?>)</td>                                         
        <td>Rp.<?= number_format($harga); ?></td>                                         
        <td><?= number_format($qty);  ?></td>                                
        <td>Rp.<?= number_format($subtotal);  ?></td>             
        <td>Edit l Delete </td>    
    </tr>  
    <?
    php }; 
    ?>         