<?php
// file: xoa_hp.php
session_start();
require_once 'db.php';

if (!isset($_SESSION['MaSV']) || !isset($_GET['MaHP'])) {
    header("Location: dangkydetail.php");
    exit;
}

$MaSV = $_SESSION['MaSV'];
$MaHP = $_GET['MaHP'];
$NgayDK = date('Y-m-d');

// Lấy MaDK
$sql = "SELECT MaDK FROM DangKy WHERE MaSV=? AND NgayDK=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $MaSV, $NgayDK);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $MaDK = $row['MaDK'];

    // Xóa học phần khỏi chi tiết đăng ký
    $sql = "DELETE FROM ChiTietDangKy WHERE MaDK=? AND MaHP=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $MaDK, $MaHP);
    $stmt->execute();
}

header("Location: dangkydetail.php");
exit;
