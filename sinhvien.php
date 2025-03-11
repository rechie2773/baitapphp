<?php
include 'db.php';
include 'templates/header.php';

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
        echo "<div class='alert alert-success'>Thêm sinh viên thành công!</div>";
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
    }
}

// Xoá sinh viên
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM SinhVien WHERE SinhVienID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Xoá sinh viên thành công!</div>";
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
    }
}

// Lấy danh sách sinh viên
$result = $conn->query("SELECT * FROM SinhVien");
?>

<div class="container mt-4">
    <h2 class="text-center">Danh sách Sinh viên</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Họ Tên</th><th>Mã SV</th><th>Ngày Sinh</th><th>Lớp</th><th>Email</th><th>SĐT</th><th>Hành động</th>
            </tr>
        </thead>
        <tbody>
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
                    <a href="sinhvien.php?edit=<?= $row['SinhVienID'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="sinhvien.php?delete=<?= $row['SinhVienID'] ?>" class="btn btn-danger btn-sm">Xoá</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h2 class="text-center mt-4">Thêm Sinh viên</h2>
    <form method="POST" class="w-50 mx-auto">
        <input type="text" name="hoten" class="form-control mb-2" placeholder="Họ tên" required>
        <input type="text" name="masv" class="form-control mb-2" placeholder="Mã SV" required>
        <input type="date" name="ngaysinh" class="form-control mb-2" required>
        <input type="text" name="lop" class="form-control mb-2" placeholder="Lớp" required>
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="text" name="sdt" class="form-control mb-2" placeholder="Số điện thoại">
        <button type="submit" name="add" class="btn btn-primary">Thêm</button>
    </form>
</div>

<?php include 'templates/footer.php'; ?>
