<?php
// file: delete.php
require_once 'db.php';

if (!isset($_GET['MaSV'])) {
    echo "Mã sinh viên không hợp lệ.";
    exit;
}

$MaSV = $_GET['MaSV'];

// Nếu xác nhận xóa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "DELETE FROM SinhVien WHERE MaSV=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $MaSV);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

// Lấy thông tin sinh viên
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
    <title>Xóa sinh viên</title>
</head>
<body>
    <h2>XÓA THÔNG TIN</h2>
    <p>Bạn có chắc muốn xóa sinh viên này?</p>
    <p><strong>Họ tên:</strong> <?= $sv['HoTen'] ?></p>
    <p><strong>Giới tính:</strong> <?= $sv['GioiTinh'] ?></p>
    <p><strong>Ngày sinh:</strong> <?= $sv['NgaySinh'] ?></p>
    <p><strong>Hình:</strong><br><img src="<?= $sv['Hinh'] ?>" width="150"></p>
    <p><strong>Ngành:</strong> <?= $sv['TenNganh'] ?></p>

    <form method="post">
        <button type="submit">Xác nhận xóa</button>
        <a href="index.php">Hủy</a>
    </form>
</body>
</html>
