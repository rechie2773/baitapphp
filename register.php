<?php
include 'db.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "<div class='alert alert-danger'>Mật khẩu không khớp!</div>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Thêm user mới với role mặc định là Member (role_id = 1)
        $stmt = $conn->prepare("INSERT INTO users (username, password, role_id) VALUES (?, ?, 1)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Đăng ký thành công! <a href='login.php'>Đăng nhập</a></div>";
        } else {
            echo "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 w-50">
        <h2 class="text-center">Đăng ký</h2>
        <form method="POST">
            <input type="text" name="username" class="form-control mb-2" placeholder="Tài khoản" required>
            <input type="password" name="password" class="form-control mb-2" placeholder="Mật khẩu" required>
            <input type="password" name="confirm_password" class="form-control mb-2" placeholder="Nhập lại mật khẩu" required>
            <button type="submit" name="register" class="btn btn-success w-100">Đăng ký</button>
        </form>
        <p class="text-center mt-3">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
    </div>
</body>
</html>