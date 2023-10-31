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
                        <h1 class="mt-3 mb-3">Edit Data Penduduk</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data">
                                        <?php
                                            $id_penduduk = $_GET['id'];
                                            $getpenduduk = mysqli_query($conn, "SELECT * FROM penduduk WHERE id_penduduk = '$id_penduduk'");
                                            while ($data = mysqli_fetch_array($getpenduduk)) {
                                                
                                                $parts = explode(', ', $data['alamat']);
                                                if (count($parts) >= 2) {
                                                    $provinsi = array_pop($parts);
                                                    $kabupaten = array_pop($parts);
                                                    $alamat = implode(', ', $parts); 
                                                } else {
                                                    $alamat = $data['alamat'];
                                                    $kabupaten = '';
                                                    $provinsi = '';
                                                }
                                        ?>
                                        <div class="form-group row">
                                            <label for="nama_penduduk" class="col-md-3 col-form-label">Nama Penduduk</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" id="nama_penduduk" name="nama_penduduk" autocomplete="off" value="<?php echo $data['nama']?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group row mt-3">
                                            <label for="nik" class="col-md-3 col-form-label">NIK</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" id="nik" name="nik" autocomplete="off" maxlength="18" value="<?php echo $data['nik']?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group row mt-3">
                                            <label for="jenis_kelamin" class="col-md-3 col-form-label">Jenis Kelamin</label>
                                            <div class="col-md-9">
                                                <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="Laki-laki" required  <?php if ( $data['jenis_kelamin'] == 'Laki-laki') echo 'checked'; ?>>
                                                <label>Laki-laki</label>
                                                <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="Perempuan" required <?php if ( $data['jenis_kelamin'] == 'Perempuan') echo 'checked'; ?>>
                                                <label>Perempuan</label>
                                            </div>
                                        </div>

                                        <div class="form-group row mt-3">
                                            <label for="tanggal_lahir" class="col-md-3 col-form-label">Tanggal Lahir</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $data['tanggal_lahir']?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group row mt-3">
                                            <label for="alamat" class="col-md-3 col-form-label">Alamat</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" id="alamat" name="alamat" style="height: 150px" required><?php echo $alamat?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row mt-3">
                                            <label class="col-md-3 col-form-label">Nama Provinsi</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="editprovinsiID" id="editprovinsiID" required>
                                                    <option value="" disabled selected hidden>Select</option>
                                                    <?php
                                                    $q = mysqli_query($conn, "select * from provinsi");
                                                    while ($p = mysqli_fetch_assoc($q)) {
                                                        $selected = ($p['id_provinsi'] == $data['id_provinsi']) ? 'selected' : '';
                                                    ?>
                                                        <option value="<?= $p['id_provinsi'] ?>" <?= $selected ?>><?= $p['nama_provinsi'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mt-3">
                                            <label class="col-md-3 col-form-label">Nama Kabupaten</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="editkabupatenID" id="editkabupatenID" required>
                                                    <option value="" disabled selected hidden>Select</option>
                                                    <?php
                                                    $q = mysqli_query($conn, "select * from kabupaten");
                                                    while ($p = mysqli_fetch_assoc($q)) {
                                                        $selected = ($p['id_kabupaten'] == $data['id_kabupaten']) ? 'selected' : '';
                                                    ?>
                                                        <option value="<?= $p['id_kabupaten'] ?>" <?= $selected ?>><?= $p['nama_kabupaten'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="modal-footer mt-5">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light" name="editbtn">Simpan</button>
                                        </div>
                                        <?php }?>
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
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="../../js/datatables.js"></script>
    </body>
</html>


<script>
$(document).ready(function() {
    $('#editprovinsiID').change(function() {
        loadKabupaten($(this).find(':selected').val());
    });
});

function loadKabupaten(menuKabupaten) {
    $("#editkabupatenID").children().remove(); // Menghapus elemen anak saat dropdown berubah
    $.ajax({
        type: "POST",
        url: "dd-dropdown/get_data_edit.php",
        data: "get=kabupaten&menuKabupaten=" + menuKabupaten
    }).done(function(result) {
        $("#editkabupatenID").append($(result)); // Menambahkan opsi kabupaten yang baru
    });
}

loadProvinsi();
</script>

<?php
if (isset($_POST['editbtn'])) {
    $nama_penduduk = $_POST['nama_penduduk'];
    $nik = $_POST['nik'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $editprovinsiID = $_POST['editprovinsiID'];
    $editkabupatenID = $_POST['editkabupatenID'];

    $query_provinsi = "SELECT nama_provinsi FROM provinsi WHERE id_provinsi = '$editprovinsiID'";
    $query_kabupaten = "SELECT nama_kabupaten FROM kabupaten WHERE id_kabupaten = '$editkabupatenID'";

    $result_provinsi = mysqli_query($conn, $query_provinsi);
    $result_kabupaten = mysqli_query($conn, $query_kabupaten);

    if ($result_provinsi && $result_kabupaten) {
        $data_provinsi = mysqli_fetch_assoc($result_provinsi);
        $data_kabupaten = mysqli_fetch_assoc($result_kabupaten);

        $nama_provinsi = $data_provinsi['nama_provinsi'];
        $nama_kabupaten = $data_kabupaten['nama_kabupaten'];

        $alamat = $_POST['alamat'] . ', ' . $nama_kabupaten . ', ' . $nama_provinsi;
    } else {
        
    }

    $sql = mysqli_query($conn, "UPDATE penduduk SET nama='$nama_penduduk', nik='$nik', jenis_kelamin='$jenis_kelamin', tanggal_lahir='$tanggal_lahir',alamat='$alamat', id_provinsi='$editprovinsiID', id_kabupaten='$editkabupatenID' WHERE id_penduduk = '$id_penduduk'");

    

    if ($sql) {
        echo "<script> alert ('Data berhasil diedit'); location.href='index';</script>";
    } else {
        echo "<script> alert ('Data gagal diedit'); location.href='index';</script>";
    }
}
?>
