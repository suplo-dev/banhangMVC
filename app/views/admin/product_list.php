<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="bi bi-house"></i></li>
        <li class="breadcrumb-item active" aria-current="page">Quản lý sản phẩm</li>
    </ol>
</nav>
<h2 class="mb-4">Quản lý sản phẩm</h2>
<a href="?controller=admin&action=addProduct" class="btn btn-success mb-3">Thêm sản phẩm</a>
<form method="GET" class="row mb-4" id="formFilter">
    <input type="hidden" name="controller" value="admin">
    <input type="hidden" name="action" value="productList">

    <div class="col-md-3">
        <label class="form-label">Nhập tên sản phẩm</label>
        <input type="text" name="keyword" class="form-control" placeholder="Tên sản phẩm" value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
    </div>

    <div class="col-md-3">
        <label class="form-label">Danh mục</label>
        <select name="category_id" class="form-select">
            <option value="0" <?= ($_GET['category_id'] ?? 0 == 0) ? 'selected' : '' ?>>-- Chọn danh mục --</option>
            <?php foreach($data['categories'] as $category): ?>
                <option value="<?= $category['id'] ?>" <?= ($_GET['category_id'] ?? 0 == $category['id']) ? 'selected' : '' ?>>
                    <?= $category['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-2">
        <label class="form-label">Giá thấp nhất</label>
        <input type="number" min="0" name="min_price" class="form-control" value="<?= $_GET['minPrice'] ?? 0 ?>">
    </div>
    <div class="col-md-2">
        <label class="form-label">Giá cao nhất</label>
        <input type="number" min="0" name="max_price" class="form-control" value="<?= $_GET['maxPrice'] ?? 0 ?>">
    </div>


    <div class="col-md-2 d-flex align-items-end">
        <button type="submit" class="btn btn-primary me-2">Tìm kiếm</button>
        <a href="?controller=admin&action=productList" class="btn btn-secondary">Đặt lại</a>
    </div>
</form>

<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Ảnh</th>
        <th>Tên sản phẩm</th>
        <th>Danh mục</th>
        <th>Giá</th>
        <th>Ngày thêm</th>
        <th>Ngày cập nhật</th>
        <th>Hành động</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($data['products'] as $product): ?>
        <tr class="align-middle">
            <td><?= $product['id'] ?></td>
            <td>
                <img src="<?= $product['thumb_url'] ?>" alt="<?= $product['name'] ?>" style="width: 100px; height: 100px; object-fit: cover;">
            </td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['category']['name'] ?></td>
            <td><?= number_format($product['price']) ?> VND</td>
            <td><?= $product['created_at'] ?></td>
            <td><?= $product['updated_at'] ?></td>
            <td>
                <a href="?controller=admin&action=editProduct&id=<?= $product['id'] ?>" class="btn btn-primary">
                    <i class="bi bi-pencil"></i>
                </a>
                <button class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal"
                        data-delete-url="?controller=admin&action=deleteProduct"
                        data-product-id="<?= $product['id'] ?>">
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


