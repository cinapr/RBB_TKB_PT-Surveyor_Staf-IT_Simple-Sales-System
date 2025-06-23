<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "rbb2025_pt surveyor_system sales";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
