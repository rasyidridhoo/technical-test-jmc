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
                            <a class="nav-link" href="../data-provinsi/index"> <div class="sb-nav-link-icon"><i class="fas fa-globe"></i></div> Data Provinsi</a>

                            <a class="nav-link" href="../data-kabupaten/index">
                                <div class="sb-nav-link-icon"><i class="fas fa-building"></i></i></div>
                                Data Kabupaten
                            </a>

                            <a class="nav-link active" href="index">
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
                        <h1 class="mt-3 mb-3">Data Penduduk</h1>
                        <div class="card mb-4 ">
                            
                            <div class="card-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <a href="tambah">
                                        <button type="button" class="btn btn-primary">Tambah Data</button>
                                    </a>

                                    <div style="display: flex;">
                                    <select id="provinsiSelect" class="btn">
                                        <option value="">Pilih Provinsi</option>
                                        <?php
                                        $getProvinsi = mysqli_query($conn, "SELECT * FROM provinsi");
                                        while ($row = mysqli_fetch_assoc($getProvinsi)) {
                                            echo '<option value="' . $row['nama_provinsi'] . '">' . $row['nama_provinsi'] . '</option>';
                                        }
                                        ?>
                                    </select>

                                    <select id="kabupatenSelect" class="btn">
                                        <option value="">Pilih Kabupaten</option>
                                        <?php
                                        $getKabupaten = mysqli_query($conn, "SELECT * FROM kabupaten");
                                        while ($row = mysqli_fetch_assoc($getKabupaten)) {
                                            echo '<option value="' . $row['nama_kabupaten'] . '">' . $row['nama_kabupaten'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    </div>

                                </div>
                            </div>

                            <div class="card-body">
                                <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Aksi</th>
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Timestamp</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                        $getpenduduk = mysqli_query($conn, "select * from penduduk");
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($getpenduduk)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i++ ?></td>
                                            <td>
                                                <a href="edit?id=<?php echo $data['id_penduduk']; ?>"><button type="button" class="btn btn-success">Edit</button></a>
                                                <a href="hapus?id=<?php echo $data['id_penduduk']; ?>" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><button type="button" class="btn btn-danger">Hapus</button></a>
                                            </td>
                                            <td><?php echo $data['nama']?></td>
                                            <td><?php echo $data['nik']?></td>
                                            <td><?php echo $data['tanggal_lahir']?></td>
                                            <td><?php echo $data['alamat']?></td>
                                            <td><?php echo $data['jenis_kelamin']?></td>
                                            <td><?php echo $data['ts']?></td>
                                        </tr>
                                        <?php } ?> 
                                    </tbody>
                                </table>
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
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="../../js/datatables.js"></script>
    </body>
</html>

<script>
    $(document).ready(function() {
        var dataTable = $('#dataTable').DataTable();

        $('#provinsiSelect, #kabupatenSelect').on('change', function() {
            var selectedProvince = $('#provinsiSelect').val();
            var selectedDistrict = $('#kabupatenSelect').val();

            var regexPattern = selectedProvince;
            if (selectedDistrict) {
                regexPattern += ".*" + selectedDistrict;
            }

            dataTable.column(5).search(regexPattern, true, false).draw();
        });
    });
</script>


