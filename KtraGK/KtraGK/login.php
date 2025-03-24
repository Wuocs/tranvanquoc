<?php
// file: login.php
session_start();
require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $MaSV = $_POST['MaSV'];
    $sql = "SELECT * FROM SinhVien WHERE MaSV = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $MaSV);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['MaSV'] = $MaSV;
        header("Location: hocphan.php");
        exit;
    } else {
        $error = "Mã sinh viên không tồn tại.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
</head>
<body>
    <h2>ĐĂNG NHẬP</h2>
    <form method="post">
        <label>MaSV:</label><br>
        <input type="text" name="MaSV" required><br><br>
        <button type="submit">Đăng Nhập</button>
    </form>
    <?php if ($error): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>
    <a href="index.php">Back to List</a>
</body>
</html>
