<?php

include('../../../config/connection.php');

$command = isset($_POST['get']) ? $_POST['get'] : "";
$menuKabupaten = isset($_POST['menuKabupaten']) ? $_POST['menuKabupaten'] : 0;

switch ($command) {
    case "provinsi":
        $statement = "SELECT * FROM provinsi";
        $dt = mysqli_query($conn, $statement);
        while ($result = mysqli_fetch_assoc($dt)) {
            echo $result1 = "<option value=" . $result['id_provinsi'] . " >" . $result['nama_provinsi'] . "</option>";
        }
        break;

    case "kabupaten":
        $result1 = "<option selected='selected' disabled selected hidden>Select</option>";
        $statement = "SELECT id_kabupaten, nama_kabupaten, id_provinsi FROM kabupaten WHERE id_provinsi  = '$menuKabupaten'";
        $dt = mysqli_query($conn, $statement);

        while ($result = mysqli_fetch_assoc($dt)) {
            $result1 .= "<option value=" . $result['id_kabupaten'] . ">" . $result['nama_kabupaten'] . "</option>";
        }
        echo $result1;
        break;
}

exit();
