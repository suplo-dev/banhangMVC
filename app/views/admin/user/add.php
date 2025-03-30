<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="bi bi-house"></i></li>
        <li class="breadcrumb-item" aria-current="page">Quản lý tài khoản</li>
        <li class="breadcrumb-item active" aria-current="page">Thêm tài khoản</li>
    </ol>
</nav>
<h2 class="mb-4">Thêm tài khoản</h2>

<!--    <div class="col-md-4">-->
<!--        <img src="--><?php //= !empty($data['user']['avatar']) ? $data['user']['avatar'] : 'default-avatar.jpg' ?><!--" class="img-fluid rounded-circle" alt="Ảnh đại diện">-->
<!--    </div>-->
<form action="#" method="POST">
    <div class="row">
        <div class="col-3">
            <label class="form-label" for="">Tên</label>
            <input class="form-control" type="text" name="username">
        </div>
        <div class="col-3">
            <label class="form-label" for="">Email</label>
            <input class="form-control" type="ẹmail" name="email">
        </div>
        <div class="col-3">
            <label class="form-label" for="">SĐT</label>
            <input class="form-control" type="text" name="phone">
        </div>
        <div class="col-3">
            <label class="form-label">Vai trò</label>
            <select name="role" class="form-select">
                <option value="admin">Quản trị hệ thống</option>
                <option value="customer">Khách hàng</option>
            </select>
        </div>

    </div>
    <div class="my-2">
        <label class="form-label" for="">Địa chỉ</label>
        <textarea class="form-control" type="textarea" name="address"></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Thêm</button>
</form>
