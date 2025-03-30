<h2>Chỉnh sửa Danh mục</h2>
<form method="POST">
    <input type="hidden" name="id" value="<?= $data['category']['id'] ?>">
    <div class="mb-3">
        <label class="form-label">Tên danh mục</label>
        <input type="text" name="name" class="form-control" value="<?= $data['category']['name'] ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Trạng thái hiển thị trên trang chủ</label>
        <select name="show_home" id="" class="form-select">
            <option value="2" <?= $data['category']['show_home'] === 2 ? 'selected' : ''?>>Ẩn</option>
            <option value="1" <?= $data['category']['show_home'] === 1 ? 'selected' : ''?>>Hiển thị</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
