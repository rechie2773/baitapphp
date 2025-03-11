<?php
include 'db.php';

// Thêm quan hệ sinh viên - giảng viên
if (isset($_POST['add'])) {
    $sinhvien_id = $_POST['sinhvien_id'];
    $giangvien_id = $_POST['giangvien_id'];
    $ghichu = $_POST['ghichu'];

    $sql = "INSERT INTO SinhVienGiangVienHuongDan (SinhVienID, GiangVienID, NgayBatDau, GhiChu)
            VALUES ('$sinhvien_id', '$giangvien_id', CURDATE(), '$ghichu')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Hiển thị danh sách
$result = $conn->query("SELECT * FROM SinhVienGiangVienHuongDan");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quan hệ Sinh viên - Giảng viên</title>
</head>
<body>
    <h2>Danh sách quan hệ hướng dẫn</h2>
    <table border="1">
        <tr>
            <th>ID</th><th>Sinh viên</th><th>Giảng viên</th><th>Ngày bắt đầu</th><th>Ghi chú</th><th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['ID'] ?></td>
            <td><?= $row['SinhVienID'] ?></td>
            <td><?= $row['GiangVienID'] ?></td>
            <td><?= $row['NgayBatDau'] ?></td>
            <td><?= $row['GhiChu'] ?></td>
            <td><a href="sinhvien_giangvien.php?delete=<?= $row['ID'] ?>">Xoá</a></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Thêm quan hệ</h2>
    <form method="POST">
        <input type="text" name="sinhvien_id" placeholder="ID Sinh viên" required><br>
        <input type="text" name="giangvien_id" placeholder="ID Giảng viên" required><br>
        <input type="text" name="ghichu" placeholder="Ghi chú"><br>
        <button type="submit" name="add">Thêm</button>
    </form>
</body>
</html>
