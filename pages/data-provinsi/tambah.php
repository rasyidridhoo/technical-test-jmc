<?php
include('../../config/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tes Teknis</title>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link href="../../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand ps-3" href="#">Tes Teknis</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
           
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link active" href="index"> <div class="sb-nav-link-icon"><i class="fas fa-globe"></i></div> Data Provinsi</a>

                            <a class="nav-link" href="../data-kabupaten/index">
                                <div class="sb-nav-link-icon"><i class="fas fa-building"></i></i></div>
                                Data Kabupaten
                            </a>

                            <a class="nav-link" href="../data-penduduk/index">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Data Penduduk
                            </a>

                            <a class="nav-link" href="../laporan/index">
                                <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
                                Laporan
                            </a>
                        </div>
                    </div>
                   
                </nav>
            </div>


            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-3 mb-3">Tambah Data Provinsi</h1>
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>-->
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label for="tambahprovinsi" class="col-md-3 col-form-label">Nama Provinsi</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" id="tambahprovinsi" name="tambahprovinsi" autocomplete="off" required>
                                            </div>
                                        </div>
                                        
                                        <div class="modal-footer mt-5">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light" name="tambahbtn">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="../../js/datatables.js"></script>
    </body>
</html>

<?php
if (isset($_POST['tambahbtn'])) {
    $tambahprovinsi = $_POST['tambahprovinsi'];

    $sql = mysqli_query($conn, "insert into provinsi(nama_provinsi) VALUES ('$tambahprovinsi')");

    if ($sql) {
        echo "<script> alert ('Data berhasil ditambahkan'); location.href='index';</script>";
    } else {
        echo "<script> alert ('Data gagal ditambahkan'); location.href='index';</script>";
    }
}
?>