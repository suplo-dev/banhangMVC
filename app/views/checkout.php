<?php if (isset($data['success']) && $data['success']): ?>
    <div class="text-center mt-5">
        <h3>Đặt hàng thành công!</h3>
        <a class="btn btn-primary mt-3" href="index.php">Tiếp tục mua hàng</a>
    </div>

<?php else: ?>
    <h2 class="mb-4">Thanh toán đơn hàng</h2>
    <form method="POST">
        <div class="row">
            <h4>Chi tiết đơn hàng</h4>
            <table class="table table-bordered text-center align-middle">
                <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['order_details'] as $item): ?>
                    <tr>
                        <input type="hidden" name="productIds[]" value="<?= $item['product_id'] ?>">
                        <td>
                            <img src="<?= $item['thumb_url'] ?>" width="60" height="60" style="object-fit: cover;">
                        </td>
                        <td><?= $item['name'] ?></td>
                        <td><?= number_format($item['price']) ?> VND</td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['price'] * $item['quantity']) ?> VND</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="text-end mt-2"><strong>Tổng tiền: <?= number_format($data['total_amount']) ?>
                    VND</strong></div>
        </div>
        <div class="row">
            <h4>Địa chỉ giao hàng</h4>
            <div class="col-8">
                <div class="mb-3">
                    <label class="form-label">Họ tên</label>
                    <input type="text" name="name" class="form-control"
                           value="<?= isset($_SESSION['user']) ? $_SESSION['user']['username'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">SĐT nhận hàng</label>
                    <input type="text" name="phone" class="form-control"
                           value="<?= isset($_SESSION['user']) ? $_SESSION['user']['phone'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Địa chỉ giao hàng</label>
                    <textarea name="address" class="form-control"
                              required><?= isset($_SESSION['user']) ? $_SESSION['user']['address'] : '' ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Hoàn tất đặt hàng</button>
            </div>
            <div class="col-4 d-block">
                <img class="w-50 d-block" style="margin: auto" src="assets/images/qr.png" alt="">
                <div class="text-center">HHSTORE</div>
                <div class="text-center">190012345678</div>
            </div>
        </div>
    </form>
<?php endif; ?>
