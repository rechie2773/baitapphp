<?php
include 'db.php';

// Thêm giảng viên
if (isset($_POST['add'])) {
    $hoten = $_POST['hoten'];
    $magv = $_POST['magv'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $bomon = $_POST['bomon'];

    $sql = "INSERT INTO GiangVien (HoTen, MaGiangVien, Email, SoDienThoai, BoMon) 
            VALUES ('$hoten', '$magv', '$email', '$sdt', '$bomon')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm giảng viên thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Xoá giảng viên
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM GiangVien WHERE GiangVienID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Xoá giảng viên thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Cập nhật giảng viên
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $hoten = $_POST['hoten'];
    $magv = $_POST['magv'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $bomon = $_POST['bomon'];

    $sql = "UPDATE GiangVien SET HoTen='$hoten', MaGiangVien='$magv', Email='$email', 
            SoDienThoai='$sdt', BoMon='$bomon' WHERE GiangVienID=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Hiển thị danh sách giảng viên
$result = $conn->query("SELECT * FROM GiangVien");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quản lý Giảng viên</title>
</head>
<body>
    <h2>Danh sách Giảng viên</h2>
    <table border="1">
        <tr>
            <th>ID</th><th>Họ Tên</th><th>Mã GV</th><th>Email</th><th>SĐT</th><th>Bộ môn</th><th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['GiangVienID'] ?></td>
            <td><?= $row['HoTen'] ?></td>
            <td><?= $row['MaGiangVien'] ?></td>
            <td><?= $row['Email'] ?></td>
            <td><?= $row['SoDienThoai'] ?></td>
            <td><?= $row['BoMon'] ?></td>
            <td>
                <a href="giangvien.php?delete=<?= $row['GiangVienID'] ?>">Xoá</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Thêm Giảng viên</h2>
    <form method="POST">
        <input type="text" name="hoten" placeholder="Họ tên" required><br>
        <input type="text" name="magv" placeholder="Mã GV" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="sdt" placeholder="Số điện thoại"><br>
        <input type="text" name="bomon" placeholder="Bộ môn" required><br>
        <button type="submit" name="add">Thêm</button>
    </form>
</body>
</html>