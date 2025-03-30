<form method="GET" class="mb-3 d-flex">
    <input type="hidden" name="controller" value="product">
    <input type="hidden" name="action" value="index">
    <input type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm sản phẩm..." value="<?= $data['search'] ?? '' ?>">
    <button class="btn btn-outline-primary" type="submit">Tìm kiếm</button>
</form>
