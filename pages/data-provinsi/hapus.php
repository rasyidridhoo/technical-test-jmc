<?php
include('../../config/connection.php');
$id_provinsi = $_GET['id'];

$sql = mysqli_query($conn, "delete from provinsi where id_provinsi='$id_provinsi'");

if ($sql) {
    echo "<script> alert ('Data berhasil dihapus'); location.href='index';</script>";
} else {
    echo "<script> alert ('Data gagal dihapus'); location.href='index';</script>";
}
