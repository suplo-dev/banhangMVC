<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="bi bi-house"></i></li>
        <li class="breadcrumb-item active" aria-current="page">Quản lý sản phẩm</li>
    </ol>
</nav>
<h2 class="mb-4">Quản lý thành viên</h2>
<a href="?controller=user&action=add" class="btn btn-success mb-3">Thêm thành viên</a>
<form method="GET" class="row mb-4" id="formFilter">
    <input type="hidden" name="controller" value="user">
    <input type="hidden" name="action" value="search">

    <div class="col-md-3">
        <label class="form-label">Nhập tên thành viên</label>
        <input type="text" name="keyword" class="form-control" placeholder="Tên thành viên" value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
    </div>
    <div class="col-md-3">
        <label class="form-label">Vai trò</label>
        <select name="role" class="form-select">
            <option value="" <?= isset($_GET['role']) ?? 'selected'?>>-- Chọn vai trò --</option>
            <option value="admin" <?= isset($_GET['role']) && $_GET['role'] === 'admin' ? 'selected' : '' ?>>Quản trị hệ thống</option>
            <option value="customer" <?= isset($_GET['role']) && $_GET['role'] === 'customer'? 'selected' : '' ?>>Khách hàng</option>

        </select>
    </div>
    <div class="offset-4 col-md-2 d-flex align-items-end">
        <button type="submit" class="btn btn-primary me-2">Tìm kiếm</button>
        <a href="?controller=user&action=search" class="btn btn-secondary">Đặt lại</a>
    </div>
</form>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tên đăng nhập</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>Vai trò</th>
        <th>Tổng đơn hàng</th>
        <th>Hành động</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($data['users'] as $user): ?>
        <tr class="align-middle">
            <td><?= $user['id'] ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['phone'] ?></td>
            <td><?= $user['role'] === 'admin' ? 'Quản trị hệ thống' : 'Khách hàng' ?></td>
            <td><?= $user['total_orders'] ?? 0 ?></td>
            <td>
                <a href="?controller=user&action=edit&id=<?= $user['id'] ?>" class="btn btn-primary">
                    <i class="bi bi-pencil"></i>
                </a>
                <button class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal"
                        data-delete-url="?controller=user&action=delete"
                        data-product-id="<?= $user['id'] ?>">
                    <i class="bi bi-trash"></i>
                </button>

            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<nav class="d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <span class="me-2">Hiển thị</span>
        <select style="width: 80px; font-size: 0.875rem;" class="form-select form-select-sm" form="formFilter" aria-label="Số lượng sản phẩm mỗi trang" name="per_page">
            <option value="20" <?= ($_GET['per_page'] ?? 20) == 20 ? 'selected' : '' ?>>20</option>
            <option value="50" <?= ($_GET['per_page'] ?? 20) == 50 ? 'selected' : '' ?>>50</option>
            <option value="100" <?= ($_GET['per_page'] ?? 20) == 100 ? 'selected' : '' ?>>100</option>
            <option value="200" <?= ($_GET['per_page'] ?? 20) == 200 ? 'selected' : '' ?>>200</option>
        </select>
        <span class="ms-2">mỗi trang</span>
    </div>

    <ul class="pagination justify-content-end mb-0">
        <!-- Previous -->
        <?php if ($data['current_page'] > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?controller=admin&action=productList&page=<?= $data['current_page'] - 1 ?>" aria-label="Previous">
                    &lt;
                </a>
            </li>
        <?php endif; ?>

        <!-- Page Numbers -->
        <?php for ($i = 1; $i <= $data['total_pages']; $i++): ?>
            <li class="page-item <?= ($i == $data['current_page']) ? 'active' : '' ?>">
                <a class="page-link" href="?controller=admin&action=productList&page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <!-- Next -->
        <?php if ($data['current_page'] < $data['total_pages']): ?>
            <li class="page-item">
                <a class="page-link" href="?controller=admin&action=productList&page=<?= $data['current_page'] + 1 ?>" aria-label="Next">
                    &gt;
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

<!-- Modal Xác nhận Xoá -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="deleteForm">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận xoá</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Bạn chắc chắn muốn xoá mục này?
                    <input type="hidden" name="id" id="productId"> <!-- Input hidden để chứa ID sản phẩm -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                    <button type="submit" class="btn btn-danger">Xoá</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Nút kích hoạt modal
        var deleteUrl = button.getAttribute('data-delete-url'); // Lấy URL xóa từ data-attribute
        var productId = button.getAttribute('data-product-id'); // Lấy ID sản phẩm từ data-attribute

        // Cập nhật action của form với URL xóa
        var deleteForm = deleteModal.querySelector('#deleteForm');
        deleteForm.action = deleteUrl;

        // Cập nhật giá trị của input hidden với ID sản phẩm
        var productIdInput = deleteModal.querySelector('#productId');
        productIdInput.value = productId; // Truyền ID vào input hidden
    });
</script>


