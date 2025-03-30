<h2 class="mb-4">Chi tiết đơn hàng</h2>

<?php if (empty($data['order'])): ?>
    <p class="text-muted">Không tìm thấy đơn hàng.</p>
<?php else: ?>
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
        <?php foreach ($data['order'] as $item): ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= number_format($item['price']) ?> VND</td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($item['price'] * $item['quantity']) ?> VND</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
