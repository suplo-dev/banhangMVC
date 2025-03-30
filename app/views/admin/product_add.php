<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="bi bi-house"></i></li>
        <li class="breadcrumb-item" aria-current="page">Quản lý sản phẩm</li>
        <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</li>
    </ol>
</nav>
<h2>Thêm sản phẩm</h2>
<form class="mt-3" method="POST" enctype="multipart/form-data" action="?controller=admin&action=addProduct">
    <div class="row mb-3">
        <div class="col-4">
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
        <div class="col-4">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-4">
            <label class="form-label">Giá (VND)</label>
            <input type="number" min="0" name="price" class="form-control" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea name="description" class="form-control" id="editor"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Ảnh thumbnail</label>
        <input type="file" name="thumb" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Ảnh chi tiết</label>
        <input type="file" name="files[]" class="form-control" multiple>
    </div>
    <div class="d-flex justify-content-end">
        <button type="reset" class="btn btn-secondary me-2">Huỷ</button>
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
    </div>
</form>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            height: 500,
        })
        .catch(error => {
            console.error('CKEditor error:', error);
        });
</script>

