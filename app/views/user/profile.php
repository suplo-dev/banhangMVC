<h2 class="mb-4">Thông tin tài khoản</h2>

<div class="row">
<!--    <div class="col-md-4">-->
<!--        <img src="--><?php //= !empty($data['user']['avatar']) ? $data['user']['avatar'] : 'default-avatar.jpg' ?><!--" class="img-fluid rounded-circle" alt="Ảnh đại diện">-->
<!--    </div>-->
    <div class="col-md-8">
        <form action="#" method="POST">
            <div>
                <label class="form-label" for="">Tên</label>
                <input class="form-control" type="text" name="name" value="<?= $data['user']['username'] ?>">
            </div>
            <div class="my-2">
                <label class="form-label" for="">Email</label>
                <input class="form-control" type="text" name="mail" value="<?= $data['user']['email'] ?>">
            </div>
            <div>
                <label class="form-label" for="">SĐT</label>
                <input class="form-control" type="text" name="phone" value="<?= $data['user']['phone'] ?>">
            </div>
            <div class="my-2">
                <label class="form-label" for="">Địa chỉ</label>
                <textarea class="form-control" type="textarea" name="address" value="<?= $data['user']['address'] ?>"></textarea>
            </div>
        </form>
        <!-- Chỉnh sửa thông tin -->
        <button class="btn btn-primary">Cập nhật thông tin</button>
    </div>
</div>
