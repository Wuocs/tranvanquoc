<?php
// file: create.php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $Hinh = $_POST['Hinh'];
    $MaNganh = $_POST['MaNganh'];

    $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

$nganh = $conn->query("SELECT * FROM NganhHoc");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Thêm sinh viên</title>
</head>
<body>
    <h2>THÊM SINH VIÊN</h2>
    <form method="post">
        <label>MaSV:</label><br>
        <input type="text" name="MaSV" required><br>

        <label>HoTen:</label><br>
        <input type="text" name="HoTen" required><br>

        <label>GioiTinh:</label><br>
        <input type="text" name="GioiTinh" required><br>

        <label>NgaySinh:</label><br>
        <input type="date" name="NgaySinh" required><br>

        <label>Hinh:</label><br>
        <input type="text" name="Hinh" required><br>

        <label>MaNganh:</label><br>
        <select name="MaNganh" required>
            <?php while($row = $nganh->fetch_assoc()): ?>
                <option value="<?= $row['MaNganh'] ?>"><?= $row['TenNganh'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <button type="submit">Create</button>
        <a href="index.php">Back to List</a>
    </form>
</body>
</html>
