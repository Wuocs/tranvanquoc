<?php
// file: index.php
require_once 'db.php';
$sql = "SELECT sv.*, nh.TenNganh FROM SinhVien sv JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh";
$students = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Trang Sinh Viên</title>
    <style>
        img { width: 100px; height: 100px; object-fit: cover; }
        table, th, td { border: 1px solid #ddd; border-collapse: collapse; padding: 10px; }
    </style>
</head>
<body>
    <h2>TRANG SINH VIÊN</h2>
    <a href="create.php">Add Student</a>
    <table>
        <tr>
            <th>MaSV</th><th>HoTen</th><th>GioiTinh</th><th>NgaySinh</th><th>Hinh</th><th>Nganh</th><th>Action</th>
        </tr>
        <?php while($sv = $students->fetch_assoc()): ?>
        <tr>
            <td><?= $sv['MaSV'] ?></td>
            <td><?= $sv['HoTen'] ?></td>
            <td><?= $sv['GioiTinh'] ?></td>
            <td><?= $sv['NgaySinh'] ?></td>
            <td><img src="<?= $sv['Hinh'] ?>" alt=""></td>
            <td><?= $sv['TenNganh'] ?></td>
            <td>
                <a href="edit.php?MaSV=<?= $sv['MaSV'] ?>">Edit</a> |
                <a href="detail.php?MaSV=<?= $sv['MaSV'] ?>">Detail</a> |
                <a href="delete.php?MaSV=<?= $sv['MaSV'] ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
