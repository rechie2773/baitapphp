<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Chỉ admin mới được truy cập
if ($_SESSION['role_id'] != 2) {
    header("Location: sinhvien_giangvien.php");
    exit();
}

include 'db.php';
include 'templates/header.php';

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
        echo "<div class='alert alert-success'>Thêm giảng viên thành công!</div>";
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
    }
}

// Xóa giảng viên
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM GiangVien WHERE GiangVienID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Xóa giảng viên thành công!</div>";
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
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
        echo "<div class='alert alert-success'>Cập nhật giảng viên thành công!</div>";
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
    }
}

// Lấy danh sách giảng viên
$result = $conn->query("SELECT * FROM GiangVien");
?>

<div class="container mt-4">
    <h2 class="text-center">Danh sách Giảng viên</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Họ Tên</th><th>Mã GV</th><th>Email</th><th>SĐT</th><th>Bộ môn</th><th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['GiangVienID'] ?></td>
                <td><?= $row['HoTen'] ?></td>
                <td><?= $row['MaGiangVien'] ?></td>
                <td><?= $row['Email'] ?></td>
                <td><?= $row['SoDienThoai'] ?></td>
                <td><?= $row['BoMon'] ?></td>
                <td>
                    <a href="giangvien.php?edit=<?= $row['GiangVienID'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="giangvien.php?delete=<?= $row['GiangVienID'] ?>" class="btn btn-danger btn-sm">Xoá</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h2 class="text-center mt-4">Thêm Giảng viên</h2>
    <form method="POST" class="w-50 mx-auto">
        <input type="text" name="hoten" class="form-control mb-2" placeholder="Họ tên" required>
        <input type="text" name="magv" class="form-control mb-2" placeholder="Mã GV" required>
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="text" name="sdt" class="form-control mb-2" placeholder="Số điện thoại">
        <input type="text" name="bomon" class="form-control mb-2" placeholder="Bộ môn" required>
        <button type="submit" name="add" class="btn btn-primary">Thêm</button>
    </form>

    <?php
    // Hiển thị form cập nhật nếu người dùng bấm "Sửa"
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $editResult = $conn->query("SELECT * FROM GiangVien WHERE GiangVienID=$id");
        $editRow = $editResult->fetch_assoc();
    ?>
    <h2 class="text-center mt-4">Cập nhật Giảng viên</h2>
    <form method="POST" class="w-50 mx-auto">
        <input type="hidden" name="id" value="<?= $editRow['GiangVienID'] ?>">
        <input type="text" name="hoten" class="form-control mb-2" value="<?= $editRow['HoTen'] ?>" required>
        <input type="text" name="magv" class="form-control mb-2" value="<?= $editRow['MaGiangVien'] ?>" required>
        <input type="email" name="email" class="form-control mb-2" value="<?= $editRow['Email'] ?>" required>
        <input type="text" name="sdt" class="form-control mb-2" value="<?= $editRow['SoDienThoai'] ?>">
        <input type="text" name="bomon" class="form-control mb-2" value="<?= $editRow['BoMon'] ?>" required>
        <button type="submit" name="update" class="btn btn-success">Cập nhật</button>
    </form>
    <?php } ?>
</div>

<?php include 'templates/footer.php'; ?>
