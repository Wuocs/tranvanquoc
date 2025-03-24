<?php
// file: xoa_dangky.php
session_start();
require_once 'db.php';

if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit;
}

$MaSV = $_SESSION['MaSV'];
$NgayDK = date('Y-m-d');

// Lấy MaDK hiện tại
$sql = "SELECT MaDK FROM DangKy WHERE MaSV=? AND NgayDK=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $MaSV, $NgayDK);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $MaDK = $row['MaDK'];

    // Xóa chi tiết học phần trước
    $sql = "DELETE FROM ChiTietDangKy WHERE MaDK=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $MaDK);
    $stmt->execute();

    // Sau đó xóa bản ghi DangKy chính
    $sql = "DELETE FROM DangKy WHERE MaDK=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $MaDK);
    $stmt->execute();
}

header("Location: dangkydetail.php");
exit;
