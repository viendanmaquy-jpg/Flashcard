<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "db_flashcard"; // Khớp 100% với tên database trên phpMyAdmin của em

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
?>
