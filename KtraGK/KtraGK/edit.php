<?php
// file: edit.php
require_once 'db.php';

if (!isset($_GET['MaSV'])) {
    echo "Mã sinh viên không hợp lệ.";
    exit;
}

$MaSV = $_GET['MaSV'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $Hinh = $_POST['Hinh'];
    $MaNganh = $_POST['MaNganh'];

    $sql = "UPDATE SinhVien SET HoTen=?, GioiTinh=?, NgaySinh=?, Hinh=?, MaNganh=? WHERE MaSV=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh, $MaSV);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

// Lấy thông tin sinh viên
$sql = "SELECT * FROM SinhVien WHERE MaSV=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $MaSV);
$stmt->execute();
$result = $stmt->get_result();
$sv = $result->fetch_assoc();

// Lấy danh sách ngành
$nganh = $conn->query("SELECT * FROM NganhHoc");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa thông tin sinh viên</title>
</head>
<body>
    <h2>Hiệu chỉnh thông tin sinh viên</h2>
    <form method="post">
        <label>Họ tên:</label><br>
        <input type="text" name="HoTen" value="<?= $sv['HoTen'] ?>"><br>

        <label>Giới tính:</label><br>
        <input type="text" name="GioiTinh" value="<?= $sv['GioiTinh'] ?>"><br>

        <label>Ngày sinh:</label><br>
        <input type="date" name="NgaySinh" value="<?= $sv['NgaySinh'] ?>"><br>

        <label>Hình:</label><br>
        <input type="text" name="Hinh" value="<?= $sv['Hinh'] ?>"><br>
        <img src="<?= $sv['Hinh'] ?>" width="100"><br>

        <label>Ngành:</label><br>
        <select name="MaNganh">
            <?php while($row = $nganh->fetch_assoc()): ?>
                <option value="<?= $row['MaNganh'] ?>" <?= $sv['MaNganh'] == $row['MaNganh'] ? 'selected' : '' ?>><?= $row['TenNganh'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <button type="submit">Lưu</button>
        <a href="index.php">Quay lại</a>
    </form>
</body>
</html>
