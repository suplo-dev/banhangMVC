
<div class="container mt-5" style="max-width: 500px;">
    <h3 class="mb-4 text-center">Quên mật khẩu</h3>

    <!-- Hiển thị lỗi -->
    <?php if (isset($data['error'])): ?>
        <div class="alert alert-danger"><?= $data['error'] ?></div>
    <?php endif; ?>

    <?php if (isset($data['success'])): ?>
        <div class="alert alert-success"><?= $data['success'] ?></div>
    <?php endif; ?>

    <form method="POST" action="?controller=user&action=forgotPassword">
        <div class="mb-3">
            <label>Email</label>
            <input type="text" name="email" class="form-control" required value="<?= $data['email'] ?? '' ?>">
        </div>
        <!-- Nút căn giữa -->
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Gửi email xác nhận</button>
        </div>
    </form>
</div>
