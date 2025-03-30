<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="bi bi-house"></i></li>
        <li class="breadcrumb-item active" aria-current="page">Quản lý đơn hàng</li>
    </ol>
</nav>
<h2 class="mb-4">Quản lý đơn hàng</h2>

<?php if (empty($data['orders'])): ?>
    <p class="text-muted">Hiện chưa có đơn hàng nào.</p>
<?php else: ?>
    <table class="table table-bordered">
        <thead>
        <tr class="text-center">
            <th>#</th>
            <th>Tên khách hàng</th>
            <th>SĐT</th>
            <th>Thời gian đặt hàng</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody class="text-center">
        <?php foreach ($data['orders'] as $order): ?>
            <tr>
                <td><?= $order['id'] ?></td>
                <td><?= $order['customer_name'] ?? 'N/A' ?></td>
                <td><?= $order['phone'] ?? 'N/A' ?></td>
                <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                <td><?= number_format($order['total_amount']) ?> VND</td>
                <td>
                        <span class="badge bg-<?= $order['status'] === 'Đang giao' ? 'warning' : ($order['status'] === 'Hoàn thành' ? 'success' : 'secondary') ?>">
                            <?= ucfirst($order['status']) ?>
                        </span>
                </td>
                <td>
                    <a href="?controller=admin&action=orderDetails&id=<?= $order['id'] ?>" class="btn btn-sm btn-primary">Xem chi tiết</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<nav class="d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <span class="me-2">Hiển thị</span>
        <select style="width: 80px; font-size: 0.875rem;" class="form-select form-select-sm" form="formFilter" aria-label="Số lượng sản phẩm mỗi trang" name="per_page">
            <option value="20" <?= ($_GET['per_page'] ?? 20) == 20 ? 'selected' : '' ?>>20</option>
            <option value="50" <?= ($_GET['per_page'] ?? 20) == 50 ? 'selected' : '' ?>>50</option>
            <option value="100" <?= ($_GET['per_page'] ?? 20) == 100 ? 'selected' : '' ?>>100</option>
            <option value="200" <?= ($_GET['per_page'] ?? 20) == 200 ? 'selected' : '' ?>>200</option>
        </select>
        <span class="ms-2">mỗi trang</span>
    </div>

    <ul class="pagination justify-content-end mb-0">
        <!-- Previous -->
        <?php if ($data['current_page'] > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?controller=admin&action=orderList&page=<?= $data['current_page'] - 1 ?>" aria-label="Previous">
                    &lt;
                </a>
            </li>
        <?php endif; ?>

        <!-- Page Numbers -->
        <?php for ($i = 1; $i <= $data['total_pages']; $i++): ?>
            <li class="page-item <?= ($i == $data['current_page']) ? 'active' : '' ?>">
                <a class="page-link" href="?controller=admin&action=orderList&page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <!-- Next -->
        <?php if ($data['current_page'] < $data['total_pages']): ?>
            <li class="page-item">
                <a class="page-link" href="?controller=admin&action=orderList&page=<?= $data['current_page'] + 1 ?>" aria-label="Next">
                    &gt;
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
