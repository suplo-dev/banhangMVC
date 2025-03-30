<h2 class="mb-4">Lịch sử đơn hàng</h2>

<?php if (empty($data['orders'])): ?>
    <p class="text-muted">Bạn chưa có đơn hàng nào.</p>
<?php else: ?>
    <table class="table table-bordered">
        <thead>
        <tr class="text-center">
            <th>Mã đơn hàng</th>
            <th>Ngày mua</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Chi tiết</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['orders'] as $order): ?>
            <tr class="text-center">
                <td class="text-center"><?= $order['id'] ?></td>
                <td><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
                <td><?= number_format($order['total_amount']) ?> VND</td>
                <td><?= $order['status'] ?></td>
                <td>
                    <a href="?controller=order&action=details&id=<?= $order['id'] ?>" class="btn btn-primary">Xem chi tiết</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
