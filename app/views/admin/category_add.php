<h2>Thêm Danh mục</h2>
<form method="POST">
    <div class="mb-3">
        <label class="form-label">Tên danh mục</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Trạng thái hiển thị trên trang chủ</label>
        <select name="show_home" id="" class="form-select">
            <option value="2">Ẩn</option>
            <option value="1">Hiển thị</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Thêm</button>
</form>
