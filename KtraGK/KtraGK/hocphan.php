<?php
// file: hocphan.php
require_once 'db.php';

// Giả sử sinh viên đăng nhập có mã là "0123456789"
$MaSV = '0123456789';

$sql = "SELECT * FROM HocPhan";
$hocphans = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Danh sách học phần</title>
    <style>
        table, th, td { border: 1px solid #ccc; border-collapse: collapse; padding: 8px; }
        button { background-color: green; color: white; padding: 5px 10px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h2>DANH SÁCH HỌC PHẦN</h2>
    <table>
        <tr>
            <th>Mã Học Phần</th>
            <th>Tên Học Phần</th>
            <th>Số Tín Chỉ</th>
            <th></th>
        </tr>
        <?php while($hp = $hocphans->fetch_assoc()): ?>
        <tr>
            <td><?= $hp['MaHP'] ?></td>
            <td><?= $hp['TenHP'] ?></td>
            <td><?= $hp['SoTinChi'] ?></td>
            <td>
                <form method="post" action="dangky.php">
                    <input type="hidden" name="MaSV" value="<?= $MaSV ?>">
                    <input type="hidden" name="MaHP" value="<?= $hp['MaHP'] ?>">
                    <button type="submit">Đăng Ký</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
