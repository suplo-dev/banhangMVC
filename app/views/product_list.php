<h2 class="mb-4">Sản phẩm</h2>

<form method="GET" class="row mb-4">
    <input type="hidden" name="controller" value="product">
    <input type="hidden" name="action" value="search">

    <div class="col-md-3">
        <select name="category_id" class="form-select">
            <option value="0" <?= ($_GET['category_id'] ?? 0 == 0) ? 'selected' : '' ?>>-- Chọn danh mục --</option>
            <?php foreach($data['categories'] as $category): ?>
                <option value="<?= $category['id'] ?>" <?= (($_GET['category_id'] ?? 0) == $category['id']) ? 'selected' : '' ?>>
                    <?= $category['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-2">
        <input type="number" min="0" name="min_price" class="form-control" placeholder="Giá từ" value="<?= $data['minPrice'] ?? null ?>">
    </div>
    <div class="col-md-2">
        <input type="number" min="0" name="max_price" class="form-control" placeholder="Giá đến" value="<?= $data['maxPrice'] ?? null ?>">
    </div>

    <div class="col-md-3">
        <button type="submit" class="btn btn-primary">Lọc</button>
        <a href="index.php?controller=product&action=search" class="btn btn-secondary">Xoá lọc</a>
    </div>
</form>

<div class="row">
    <?php foreach($data['products'] as $product): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="<?= $product['thumb_url'] ?>" class="card-img-top" alt="<?= $product['name'] ?>" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= $product['name'] ?></h5>
                    <p class="card-text"><?= number_format($product['price']) ?> VND</p>

                    <div class="mt-auto">
                        <a href="?controller=product&action=detail&id=<?= $product['id'] ?>" class="btn btn-outline-primary me-2">Chi tiết</a>
                        <button type="button" class="btn btn-success add-to-cart" data-id="<?= $product['id'] ?>">Thêm vào giỏ</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
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
