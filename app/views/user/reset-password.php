<div class="container mt-5" style="max-width: 500px;">
    <h3 class="mb-4 text-center">Đặt lại mật khẩu</h3>

    <!-- Hiển thị lỗi hoặc thông báo thành công -->
    <?php if (isset($data['error'])): ?>
        <div class="alert alert-danger"><?= $data['error'] ?></div>
    <?php elseif (isset($data['success'])): ?>
        <div class="alert alert-success"><?= $data['success'] ?></div>
    <?php endif; ?>

    <!-- Form đặt lại mật khẩu -->
    <form method="POST" action="?controller=user&action=resetPassword">
        <input type="hidden" value="<?= $data['user_id'] ?>" name="id">
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu mới</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Đặt lại mật khẩu</button>
    </form>
</div>
