<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="bi bi-house"></i></li>
        <li class="breadcrumb-item active" aria-current="page">Quản lý danh mục</li>
    </ol>
</nav>

<h2 class="mb-4">Quản lý danh mục</h2>

<a href="?controller=admin&action=addCategory" class="btn btn-success mb-3">Thêm danh mục</a>

<form method="GET" class="row mb-4" id="formFilter">
    <input type="hidden" name="controller" value="admin">
    <input type="hidden" name="action" value="categoryList">

    <div class="col-md-3">
        <label class="form-label">Nhập tên danh mục</label>
        <input type="text" name="keyword" class="form-control" placeholder="Tên danh mục" value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
    </div>

    <div class="col-md-3">
        <label class="form-label">Hiển thị trên trang chủ</label>
        <select name="show_home" class="form-select">
            <option value="0" <?= ($_GET['show_home'] ?? 0 == 0) ? 'selected' : '' ?>>-- Chọn trạng thái --</option>
            <option value="1" <?= ($_GET['show_home'] ?? 0 == 1) ? 'selected' : '' ?>>Hiển thị</option>
            <option value="2" <?= ($_GET['show_home'] ?? 0 == 2) ? 'selected' : '' ?>>Ẩn</option>
        </select>
    </div>

    <div class="col-md-2 d-flex align-items-end">
        <button type="submit" class="btn btn-primary me-2">Tìm kiếm</button>
        <a href="?controller=admin&action=categoryList" class="btn btn-secondary">Đặt lại</a>
    </div>
</form>

<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th>Trạng thái hiển thị trên trang chủ</th>
        <th>Ngày thêm</th>
        <th>Ngày cập nhật</th>
        <th>Hành động</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($data['categories'] as $category): ?>
        <tr class="align-middle">
            <td><?= $category['id'] ?></td>
            <td><?= $category['name'] ?></td>
            <td><?= $category['show_home'] == 1 ? 'Hiển thị' : 'Ẩn' ?></td>
            <td><?= $category['created_at'] ?></td>
            <td><?= $category['updated_at'] ?></td>
            <td>
                <a href="?controller=admin&action=editCategory&id=<?= $category['id'] ?>" class="btn btn-primary">
                    <i class="bi bi-pencil"></i>
                </a>
                <button class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal"
                        data-delete-url="?controller=admin&action=deleteCategory"
                        data-category-id="<?= $category['id'] ?>">
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
        <select style="width: 80px; font-size: 0.875rem;" class="form-select form-select-sm" form="formFilter" aria-label="Số lượng danh mục mỗi trang" name="per_page">
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
                <a class="page-link" href="?controller=admin&action=categoryList&page=<?= $data['current_page'] - 1 ?>" aria-label="Previous">
                    &lt;
                </a>
            </li>
        <?php endif; ?>

        <!-- Page Numbers -->
        <?php for ($i = 1; $i <= $data['total_pages']; $i++): ?>
            <li class="page-item <?= ($i == $data['current_page']) ? 'active' : '' ?>">
                <a class="page-link" href="?controller=admin&action=categoryList&page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <!-- Next -->
        <?php if ($data['current_page'] < $data['total_pages']): ?>
            <li class="page-item">
                <a class="page-link" href="?controller=admin&action=categoryList&page=<?= $data['current_page'] + 1 ?>" aria-label="Next">
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
                    <input type="hidden" name="id" id="categoryId"> <!-- Input hidden để chứa ID sản phẩm -->
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
        var categoryId = button.getAttribute('data-category-id'); // Lấy ID sản phẩm từ data-attribute

        // Cập nhật action của form với URL xóa
        var deleteForm = deleteModal.querySelector('#deleteForm');
        deleteForm.action = deleteUrl;

        // Cập nhật giá trị của input hidden với ID sản phẩm
        var categoryIdInput = deleteModal.querySelector('#categoryId');
        categoryIdInput.value = categoryId; // Truyền ID vào input hidden
    });
</script>
