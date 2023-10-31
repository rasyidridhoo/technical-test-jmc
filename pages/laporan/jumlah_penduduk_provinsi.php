<!doctype html>
<html lang="en">

<head>
    <title>Laporan Jumlah Penduduk per Provinsi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style type="text/css">

    @media print {
         #printButton {
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
        <h3 align='center'>Laporan Jumlah Penduduk per Provinsi</h3>
        <br>
        <table id="provinsiTable" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Provinsi</th>
                    <th>Jumlah Penduduk</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../../config/connection.php');

                $query = "SELECT pr.id_provinsi, pr.nama_provinsi, COUNT(p.id_penduduk) AS jumlah_penduduk
                FROM provinsi pr
                LEFT JOIN penduduk p ON pr.id_provinsi = p.id_provinsi
                GROUP BY pr.id_provinsi, pr.nama_provinsi
                ORDER BY jumlah_penduduk DESC";
                $result = $conn->query($query);

                if ($result) {
                    $data = array();
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $no. '</td>';
                        echo '<td>' . $row['nama_provinsi'] . '</td>';
                        echo '<td>' . $row['jumlah_penduduk'] . '</td>';
                        echo '</tr>';
                        $no++;
                    }
                } else {
                    echo '<tr><td colspan="2">Gagal mengambil data.</td></tr>';
                }

                $conn->close();
                ?>
            </tbody>
        </table>

        <button id="printButton" class="btn btn-primary">Print</button>
    </div>
</body>

</html>


<script>
    document.getElementById('printButton').addEventListener('click', function () {
        window.print();
    });
</script>

