<?php
require 'cek_login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistem Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Sistem Inventory</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>

    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                            Data order
                        </a>
                        <a class="nav-link" href="stock.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                            Stock Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-clipboard-check"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="pelanggan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-id-card"></i></div>
                            Kelola Pelanggan
                        </a>
                        <a class="nav-link" href="logout.php">
                            <div class="sb-nav-link-icon"><i class="fa fa-sign-out"></i></div>
                            Logout
                        </a>

                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Barang Masuk</h1>
                    <div class="col-xl-3 col-md-6">
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                            data-bs-target="#myModal">
                            Tambah Barang Masuk
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Barang Masuk
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama produk - deskripsi</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                               $getbarangmasuk = mysqli_query($koneksi, "SELECT * FROM masuk m,produk p WHERE m.id_produk=p.id_produk");
                               $i = 1;

                               while ($bm = mysqli_fetch_array($getbarangmasuk)) {
                                   $id_produk = $bm['id_produk'];
                                   $id_masuk = $bm['id_masuk'];
                                   $nama_produk = $bm['nama_produk'];
                                   $deskripsi = $bm['deskripsi'];
                                    $quantity=$bm['qty'];
                                    $tgl_masuk=$bm['tgl_masuk'];
                                ?>
                                
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $nama_produk;?> - <?= $deskripsi;?> </td>
                                        <td><?= $quantity; ?></td>
                                        <td><?= $tgl_masuk; ?></td>
                                        <td><button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#edit<?= $id_masuk; ?>">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete<?= $id_masuk; ?>">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal" id="edit<?= $id_masuk; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Barang <?= $nama_produk;  ?></h4>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <form method="POST">
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <input type="text" name="nama_produk" class="form-control mt-3"
                                                            placeholder="nama produk" value="<?= $nama_produk; ?> - <?= $deskripsi; ?>"
                                                            disabled>
                                                    
                                                        <input type="num" name="qty" class="form-control mt-3"
                                                            placeholder="Quantity" value="<?= $quantity;  ?>">

                                                        <input type="hidden" name="id_produk" class="form-control mt-3"
                                                            value="<?= $id_produk;  ?>"
                                                            hidden>
                                                        <input type="hidden" name="id_masuk" class="form-control mt-3"
                                                            value="<?= $id_masuk;  ?>" >
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success"
                                                            name="editbarangmasuk">Simpan</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal" id="delete<?= $id_masuk; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete Barang <?= $nama_produk;  ?></h4>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <form method="POST">
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        Apakah Anda Yakin akan menghapus barang ini?
                                                        <input type="hidden" name="id_masuk" class="form-control mt-3"
                                                            value="<?= $id_masuk;  ?>">
                                                            <input type="hidden" name="id_produk" class="form-control mt-3"
                                                            value="<?= $id_produk;  ?>">
                                                       
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success"
                                                            name="hapusbarangmasuk">Hapus</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                } ?>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Data Pesanan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST">
                <!-- Modal body -->
                <div class="modal-body">
                    Pilih Barang
                    <select name="id_produk" class="form-control">
                        <?php
                        $getproduk = mysqli_query($koneksi, "SELECT * FROM produk");

                        while ($pr = mysqli_fetch_array($getproduk)) {
                            $id_produk = $pr['id_produk'];
                            $nama_produk = $pr['nama_produk'];
                            $deskripsi = $pr['deskripsi'];
                            $stock = $pr['stock'];
                        ?>
                        <option value="<?= $id_produk; ?>">
                            <?= $nama_produk;  ?> - <?= $deskripsi;  ?> (Stock : <?= $stock;  ?>)
                        </option>
                        <?php
                        };
                        ?>
 <input type="number" name="qty" class="form-control mt-3" placeholder="Quantity" min ="1" required">
                    </select>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="barangmasuk">Simpan</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>