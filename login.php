<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("
        SELECT users.*, roles.role_name 
        FROM users 
        JOIN roles ON users.role_id = roles.id 
        WHERE users.username = ?
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_id'] = $user['role_id']; // Lưu role_id vào session
            $_SESSION['role_name'] = $user['role_name']; // Lưu tên role

            // Chuyển hướng theo quyền
            if ($user['role_id'] == 2) {
                header("Location: sinhvien.php");
            } else {
                header("Location: sinhvien_giangvien.php");
            }
            exit();
        } else {
            echo "<div class='alert alert-danger'>Sai mật khẩu!</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Tài khoản không tồn tại!</div>";
    }
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 w-50">
        <h2 class="text-center">Đăng nhập</h2>
        <form method="POST">
            <input type="text" name="username" class="form-control mb-2" placeholder="Tài khoản" required>
            <input type="password" name="password" class="form-control mb-2" placeholder="Mật khẩu" required>
            <button type="submit" name="login" class="btn btn-primary w-100">Đăng nhập</button>
        </form>
        <p class="text-center mt-3">Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
    </div>
</body>
</html>