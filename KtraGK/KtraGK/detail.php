<?php
// file: detail.php
require_once 'db.php';

if (!isset($_GET['MaSV'])) {
    echo "Mã sinh viên không hợp lệ.";
    exit;
}

$MaSV = $_GET['MaSV'];
$sql = "SELECT sv.*, nh.TenNganh FROM SinhVien sv JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh WHERE MaSV=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $MaSV);
$stmt->execute();
$result = $stmt->get_result();
$sv = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết sinh viên</title>
</head>
<body>
    <h2>Thông tin chi tiết</h2>
    <p><strong>Họ tên:</strong> <?= $sv['HoTen'] ?></p>
    <p><strong>Giới tính:</strong> <?= $sv['GioiTinh'] ?></p>
    <p><strong>Ngày sinh:</strong> <?= $sv['NgaySinh'] ?></p>
    <p><strong>Hình:</strong><br><img src="<?= $sv['Hinh'] ?>" width="150"></p>
    <p><strong>Ngành:</strong> <?= $sv['TenNganh'] ?></p>
    <a href="index.php">Back to List</a>
</body>
</html>
