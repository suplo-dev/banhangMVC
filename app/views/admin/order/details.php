<h2 class="mb-4">Đơn hàng #<?= $data['order']['id'] ?></h2>

<?php if (empty($data['order'])): ?>
    <p class="text-muted">Không tìm thấy đơn hàng.</p>
<?php else: ?>
<div class="row">
    <div class="col-4 border-end me-2 pe-4">
        <h4>Thông tin khách hàng</h4>
        <form action="#" method="POST">
            <input type="hidden" name="id" value="<?= $data['order']['id']?>">
            <div>
                <label for="" class="form-label">Tên khách hàng</label>
                <input type="text" name="customer_name" class="form-control" value="<?= $data['order']['customer_name']?>">
            </div>
            <div class="my-2">
                <label for="" class="form-label">SĐT</label>
                <input type="text" name="phone" class="form-control" value="<?= $data['order']['phone']?>">
            </div>
            <div>
                <label for="" class="form-label">Địa chỉ</label>
                <textarea class="form-control" name="address"><?= $data['order']['address']?></textarea>
            </div>
            <div class="my-2">
                <label for="" class="form-label">Trạng thái</label>
                <select class="form-control" name="status">
                    <option value="Chờ xác nhận" <?= $data['order']['status'] === 'Chờ xác nhận' ? 'selected' : ''?>>Chờ xác nhận</option>
                    <option value="Đang giao" <?= $data['order']['status'] === 'Đang giao' ? 'selected' : ''?>>Đang giao</option>
                    <option value="Hoàn thành" <?= $data['order']['status'] === 'Hoàn thành' ? 'selected' : ''?>>Hoàn thành</option>
                    <option value="Đã huỷ" <?= $data['order']['status'] === 'Đã huỷ' ? 'selected' : ''?>>Đã huỷ</option>
                </select>
            </div>
            <button class="btn btn-primary mt-2">Cập nhật</button>
        </form>
    </div>
    <div class="col">
        <h4>Chi tiết đơn hàng</h4>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['order_details'] as $item): ?>
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td><?= number_format($item['price']) ?> VND</td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= number_format($item['price'] * $item['quantity']) ?> VND</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-end mt-2"><strong>Tổng tiền: <?= number_format($data['order']['total_amount'])?> VND</strong></div>
    </div>
</div>


<?php endif; ?>
