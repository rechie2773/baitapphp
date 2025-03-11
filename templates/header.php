<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Lý</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Hệ Thống Quản Lý</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?> 
                    <?php if ($_SESSION['role_id'] == 2): ?> 
                        <li class="nav-item"><a class="nav-link" href="sinhvien.php">Sinh Viên</a></li>
                        <li class="nav-item"><a class="nav-link" href="giangvien.php">Giảng Viên</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="sinhvien_giangvien.php">Quan hệ Hướng dẫn</a></li>
                    
                    <!-- Hiển thị Username -->
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold">
                            👤 <?= htmlspecialchars($_SESSION['username']); ?>
                        </a>
                    </li>

                    <!-- Nút Logout -->
                    <li class="nav-item"><a class="nav-link btn btn-danger text-white" href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link btn btn-primary text-white" href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
