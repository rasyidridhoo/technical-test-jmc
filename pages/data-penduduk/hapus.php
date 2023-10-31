<?php
include('../../config/connection.php');
$id_penduduk = $_GET['id'];

$sql = mysqli_query($conn, "delete from penduduk where id_penduduk='$id_penduduk'");

if ($sql) {
    echo "<script> alert ('Data berhasil dihapus'); location.href='index';</script>";
} else {
    echo "<script> alert ('Data gagal dihapus'); location.href='index';</script>";
}
