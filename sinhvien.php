<?php
include 'db.php';

// Thêm sinh viên
if (isset($_POST['add'])) {
    $hoten = $_POST['hoten'];
    $masv = $_POST['masv'];
    $ngaysinh = $_POST['ngaysinh'];
    $lop = $_POST['lop'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];

    $sql = "INSERT INTO SinhVien (HoTen, MaSinhVien, NgaySinh, Lop, Email, SoDienThoai) 
            VALUES ('$hoten', '$masv', '$ngaysinh', '$lop', '$email', '$sdt')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm sinh viên thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Xoá sinh viên
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM SinhVien WHERE SinhVienID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Xoá sinh viên thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Cập nhật sinh viên
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $hoten = $_POST['hoten'];
    $masv = $_POST['masv'];
    $ngaysinh = $_POST['ngaysinh'];
    $lop = $_POST['lop'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];

    $sql = "UPDATE SinhVien SET HoTen='$hoten', MaSinhVien='$masv', NgaySinh='$ngaysinh', 
            Lop='$lop', Email='$email', SoDienThoai='$sdt' WHERE SinhVienID=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Lấy danh sách sinh viên
$result = $conn->query("SELECT * FROM SinhVien");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quản lý Sinh viên</title>
</head>
<body>
    <h2>Danh sách Sinh viên</h2>
    <table border="1">
        <tr>
            <th>ID</th><th>Họ Tên</th><th>Mã SV</th><th>Ngày Sinh</th><th>Lớp</th><th>Email</th><th>SĐT</th><th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['SinhVienID'] ?></td>
            <td><?= $row['HoTen'] ?></td>
            <td><?= $row['MaSinhVien'] ?></td>
            <td><?= $row['NgaySinh'] ?></td>
            <td><?= $row['Lop'] ?></td>
            <td><?= $row['Email'] ?></td>
            <td><?= $row['SoDienThoai'] ?></td>
            <td>
                <a href="sinhvien.php?delete=<?= $row['SinhVienID'] ?>">Xoá</a> |
                <a href="sinhvien.php?edit=<?= $row['SinhVienID'] ?>">Sửa</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Thêm Sinh viên</h2>
    <form method="POST">
        <input type="text" name="hoten" placeholder="Họ tên" required><br>
        <input type="text" name="masv" placeholder="Mã SV" required><br>
        <input type="date" name="ngaysinh" required><br>
        <input type="text" name="lop" placeholder="Lớp" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="sdt" placeholder="Số điện thoại"><br>
        <button type="submit" name="add">Thêm</button>
    </form>

    <?php
    // Chỉnh sửa sinh viên
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $editResult = $conn->query("SELECT * FROM SinhVien WHERE SinhVienID=$id");
        $editRow = $editResult->fetch_assoc();
    ?>
    <h2>Cập nhật Sinh viên</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $editRow['SinhVienID'] ?>">
        <input type="text" name="hoten" value="<?= $editRow['HoTen'] ?>" required><br>
        <input type="text" name="masv" value="<?= $editRow['MaSinhVien'] ?>" required><br>
        <input type="date" name="ngaysinh" value="<?= $editRow['NgaySinh'] ?>" required><br>
        <input type="text" name="lop" value="<?= $editRow['Lop'] ?>" required><br>
        <input type="email" name="email" value="<?= $editRow['Email'] ?>" required><br>
        <input type="text" name="sdt" value="<?= $editRow['SoDienThoai'] ?>"><br>
        <button type="submit" name="update">Cập nhật</button>
    </form>
    <?php } ?>

</body>
</html>
