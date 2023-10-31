<?php
include('../../config/connection.php');
$id_kabupaten = $_GET['id'];

$sql = mysqli_query($conn, "delete from kabupaten where id_kabupaten='$id_kabupaten'");

if ($sql) {
    echo "<script> alert ('Data berhasil dihapus'); location.href='index';</script>";
} else {
    echo "<script> alert ('Data gagal dihapus'); location.href='index';</script>";
}
