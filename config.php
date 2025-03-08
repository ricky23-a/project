<?php
$host = "localhost";
$user = "root"; // Sesuaikan dengan user database Anda
$password = ""; // Sesuaikan dengan password database Anda
$dbname = "db_toko"; // Ganti dengan nama database Anda

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_errno) { // Gunakan connect_errno, bukan connect_error sebagai string
    die("Koneksi gagal: (" . $conn->connect_errno . ") " . $conn->connect_error);
}
?>
