<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="bi bi-house"></i></li>
        <li class="breadcrumb-item" aria-current="page">Quản lý banner</li>
        <li class="breadcrumb-item active" aria-current="page">Thêm banner</li>
    </ol>
</nav>
<h2>Thêm Banner</h2>
<form class="mt-3" method="POST" enctype="multipart/form-data" action="?controller=banner&action=add">
    <div class="row mb-3">
        <div class="col-6">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="col-6">
            <label class="form-label">Link</label>
            <input type="text" name="link" class="form-control" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Ảnh</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="d-flex justify-content-end">
        <button type="reset" class="btn btn-secondary me-2">Huỷ</button>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </div>
</form>

