

<!doctype html>
<html lang="en">

<head>
    <title>Laporan Data Penduduk</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
    <link href='https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>
    <style type="text/css">
        @media print {
            #printButton, #generateButton, #exportButton {
                display: none;
            }

            @page {
                size: auto;
                margin: 3mm 3mm 3mm 1mm;
            }

            body {
                margin: 0px;
            }

            #header, #footer {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h3 align='center'>Laporan Data Penduduk</h3>
        <br>

        <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="selectProvinsi">Pilih Provinsi:</label>
                <select class="form-control" name="provinsi" id="selectProvinsi">
                    <option value="all" <?php echo isset($_GET['provinsi']) && $_GET['provinsi'] == 'all' ? 'selected' : ''; ?>>Semua Provinsi</option>
                    <?php
                    include('../../config/connection.php');
                    $sql = "SELECT * FROM provinsi";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $selected = isset($_GET['provinsi']) && $_GET['provinsi'] == $row['id_provinsi'] ? 'selected' : '';
                            echo '<option value="' . $row['id_provinsi'] . '" ' . $selected . '>' . $row['nama_provinsi'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <button id="generateButton" type="submit" class="btn btn-primary mt-3">Filter</button>
        </form>

        <?php
        if (isset($_GET['provinsi'])) {
            $selectedProvinsi = $_GET['provinsi'];
        ?>
            <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="provinsi" value="<?php echo $selectedProvinsi; ?>">
                <div class="form-group mt-4" >
                    <label for="selectKabupaten">Pilih Kabupaten:</label>
                    <select class="form-control" name="kabupaten" id="selectKabupaten">
                        <option value="all">Semua Kabupaten</option>
                        <?php
                        $sqlKabupaten = "SELECT * FROM kabupaten WHERE id_provinsi = $selectedProvinsi";
                        $resultKabupaten = $conn->query($sqlKabupaten);
                        if ($resultKabupaten->num_rows > 0) {
                            while ($rowKabupaten = $resultKabupaten->fetch_assoc()) {
                                $selectedKabupaten = isset($_GET['kabupaten']) && $_GET['kabupaten'] == $rowKabupaten['id_kabupaten'] ? 'selected' : '';
                                echo '<option value="' . $rowKabupaten['id_kabupaten'] . '" ' . $selectedKabupaten . '>' . $rowKabupaten['nama_kabupaten'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <button id="generateButton" type="submit" class="btn btn-primary mt-3 mb-5">Filter</button>
            </form>
        <?php
        }
        ?>

        <?php
        include('../../config/connection.php');

        if (isset($_GET['provinsi'])) {
            $selectedProvinsi = $_GET['provinsi'];
            $selectedKabupaten = isset($_GET['kabupaten']) ? $_GET['kabupaten'] : 'all';

            if ($selectedProvinsi == 'all') {
                $sql2 = "SELECT penduduk.nama, penduduk.nik, penduduk.tanggal_lahir, penduduk.alamat, penduduk.jenis_kelamin, penduduk.ts
                    FROM penduduk
                    JOIN kabupaten ON penduduk.id_kabupaten = kabupaten.id_kabupaten";
                
                if ($selectedKabupaten != 'all') {
                    $sql2 .= " WHERE kabupaten.id_kabupaten = $selectedKabupaten";
                }
            } else {
                $sql2 = "SELECT penduduk.nama, penduduk.nik, penduduk.tanggal_lahir, penduduk.alamat, penduduk.jenis_kelamin, penduduk.ts
                    FROM penduduk
                    JOIN kabupaten ON penduduk.id_kabupaten = kabupaten.id_kabupaten
                    WHERE kabupaten.id_provinsi = $selectedProvinsi";
                
                if ($selectedKabupaten != 'all') {
                    $sql2 .= " AND kabupaten.id_kabupaten = $selectedKabupaten";
                }
            }

            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0) {
                
                echo '</h4>';
                echo '<table class="table mt-4" id="exportsTable">';
                echo '<thead><tr><th>No</th><th>Nama</th><th>NIK</th><th>Tanggal Lahir</th><th>Alamat</th><th>Jenis Kelamin</th><th>Timestamp</th></tr></thead>';
                echo '<tbody>';
                $no = 1; 
                while ($row2 = $result2->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $no . '</td>';
                    echo '<td>' . $row2['nama'] . '</td>';
                    echo '<td>' . $row2['nik'] . '</td>';
                    echo '<td>' . $row2['tanggal_lahir'] . '</td>';
                    echo '<td>' . $row2['alamat'] . '</td>';
                    echo '<td>' . $row2['jenis_kelamin'] . '</td>';
                    echo '<td>' . $row2['ts'] . '</td>';
                    echo '</tr>';
                    $no++;
                }
                echo '</tbody>';
                echo '</table >';
            } else {
                echo '<p>Tidak ada data untuk provinsi ini.</p>';
            }
        }
        $conn->close();
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#exportsTable").DataTable({
                dom: "Bfrtip",
                buttons: [
                {
                    extend: "excel",
                    text: "Export Excel",
                },
                ],
            });
        });

    </script>
</body>

</html>
