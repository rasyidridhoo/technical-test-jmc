<!doctype html>
<html lang="en">

<head>
    <title>Laporan Jumlah Penduduk per Kabupaten</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style type="text/css">
    @media print {
        #printButton, #generateButton {
            display: none;
        }

        @page {
            size: auto;
            margin: 3mm 3mm 3mm 4mm;
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
        <h3 align='center'>Laporan Jumlah Penduduk per Kabupaten</h3>
        <br>

        <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="selectProvinsi">Pilih Provinsi:</label>
                <select class="form-control" name="provinsi" id="selectProvinsi">
                    <option value="all">Semua Provinsi</option>
                    <?php
                    include('../../config/connection.php');
                    if (isset($_GET['provinsi'])) {
                        $selectedProvinsi = $_GET['provinsi'];
                    } else {
                        $selectedProvinsi = '';
                    }
                    $sql = "SELECT * FROM provinsi";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $selected = ($row['id_provinsi'] == $selectedProvinsi) ? 'selected' : '';
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
            if ($selectedProvinsi == 'all') {
                $sql2 = "SELECT kabupaten.nama_kabupaten, COUNT(penduduk.id_penduduk) AS jumlah_penduduk
                    FROM kabupaten
                    LEFT JOIN penduduk ON kabupaten.id_kabupaten = penduduk.id_kabupaten
                    GROUP BY kabupaten.id_kabupaten, kabupaten.nama_kabupaten
                    ORDER BY jumlah_penduduk DESC";
            } else {
                $sql2 = "SELECT kabupaten.nama_kabupaten, COUNT(penduduk.id_penduduk) AS jumlah_penduduk
                    FROM kabupaten
                    LEFT JOIN penduduk ON kabupaten.id_kabupaten = penduduk.id_kabupaten
                    WHERE kabupaten.id_provinsi = $selectedProvinsi
                    GROUP BY kabupaten.id_kabupaten, kabupaten.nama_kabupaten
                    ORDER BY jumlah_penduduk DESC";
            }

            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0) {
                echo '<table class="table">';
                echo '<thead><tr><th>No</th><th>Kabupaten</th><th>Jumlah Penduduk</th></tr></thead>';
                echo '<tbody>';
                $no = 1;
                while ($row2 = $result2->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $no . '</td>';
                    echo '<td>' . $row2['nama_kabupaten'] . '</td>';
                    echo '<td>' . $row2['jumlah_penduduk'] . '</td>';
                    echo '</tr>';
                    $no++;
                }
                echo '</tbody>';
                echo '</table>';
                echo '<button id="printButton" class="btn btn-primary">Print</button>';
            } else {
                echo '<p>Tidak ada data untuk provinsi ini.</p>';
            }

            $conn->close();
        }
        ?>
    </div>

    <script>
        document.getElementById('printButton').addEventListener('click', function () {
            window.print();
        });
    </script>
</body>

</html>
