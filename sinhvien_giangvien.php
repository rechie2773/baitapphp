<?php
include 'db.php';
include 'templates/header.php';

// Thêm quan hệ sinh viên - giảng viên
if (isset($_POST['add'])) {
    $sinhvien_id = $_POST['sinhvien_id'];
    $giangvien_id = $_POST['giangvien_id'];
    $ghichu = $_POST['ghichu'];

    $sql = "INSERT INTO SinhVienGiangVienHuongDan (SinhVienID, GiangVienID, NgayBatDau, GhiChu)
            VALUES ('$sinhvien_id', '$giangvien_id', CURDATE(), '$ghichu')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Thêm quan hệ thành công!</div>";
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
    }
}

// Lấy danh sách quan hệ
$result = $conn->query("SELECT * FROM SinhVienGiangVienHuongDan");
?>

<div class="container mt-4">
    <h2 class="text-center">Danh sách Quan hệ Hướng dẫn</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Sinh viên</th><th>Giảng viên</th><th>Ngày bắt đầu</th><th>Ghi chú</th><th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['ID'] ?></td>
                <td><?= $row['SinhVienID'] ?></td>
                <td><?= $row['GiangVienID'] ?></td>
                <td><?= $row['NgayBatDau'] ?></td>
                <td><?= $row['GhiChu'] ?></td>
                <td>
                    <a href="sinhvien_giangvien.php?delete=<?= $row['ID'] ?>" class="btn btn-danger btn-sm">Xoá</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h2 class="text-center mt-4">Thêm Quan hệ</h2>
    <form method="POST" class="w-50 mx-auto">
        <input type="text" name="sinhvien_id" class="form-control mb-2" placeholder="ID Sinh viên" required>
        <input type="text" name="giangvien_id" class="form-control mb-2" placeholder="ID Giảng viên" required>
        <input type="text" name="ghichu" class="form-control mb-2" placeholder="Ghi chú">
        <button type="submit" name="add" class="btn btn-primary">Thêm</button>
    </form>
</div>

<?php include 'templates/footer.php'; ?>
