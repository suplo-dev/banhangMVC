<div class="container mt-5" style="max-width: 500px;">
    <h3 class="mb-4 text-center">Đăng nhập</h3>

    <!-- Hiển thị lỗi -->
    <?php if (isset($data['error'])): ?>
        <div class="alert alert-danger"><?= $data['error'] ?></div>
    <?php endif; ?>

    <form method="POST" action="?controller=user&action=login">
        <div class="mb-3">
            <label>Tên đăng nhập</label>
            <input type="text" name="username" class="form-control" required value="<?= $data['username'] ?? '' ?>">
        </div>
        <div class="mb-3">
            <label>Mật khẩu</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="text-end mb-2">
            <a href="?controller=user&action=forgotPassword" class="text-decoration-none ms-auto">Quên mật khẩu?</a>
        </div>

        <!-- Nút căn giữa -->
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </div>
    </form>
</div>
