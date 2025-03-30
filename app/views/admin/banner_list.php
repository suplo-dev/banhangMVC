<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="bi bi-house"></i></li>
        <li class="breadcrumb-item active" aria-current="page">Quản lý banner</li>
    </ol>
</nav>
<h2>Quản lý Banner</h2>
<a href="?controller=banner&action=add" class="btn btn-success my-3">Thêm Banner</a>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Hình ảnh</th>
        <th>Tiêu đề</th>
        <th>Link</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($data['banners'] as $banner): ?>
        <tr>
            <td><img src="<?= $banner['image'] ?>" width="100"></td>
            <td><?= $banner['title'] ?></td>
            <td><?= $banner['link'] ?></td>
            <td>
                <a href="?controller=banner&action=edit&id=<?= $banner['id'] ?>" class="btn btn-primary btn-sm">Sửa</a>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-delete-url="?controller=banner&action=delete&id=<?= $banner['id'] ?>">Xóa</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

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
                    <input type="hidden" name="id" id="bannerId">
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
        var bannerId = button.getAttribute('data-banner-id'); // Lấy ID sản phẩm từ data-attribute

        // Cập nhật action của form với URL xóa
        var deleteForm = deleteModal.querySelector('#deleteForm');
        deleteForm.action = deleteUrl;

        // Cập nhật giá trị của input hidden với ID sản phẩm
        var bannerIdInput = deleteModal.querySelector('#bannerId');
        bannerIdInput.value = bannerId; // Truyền ID vào input hidden
    });
</script>
