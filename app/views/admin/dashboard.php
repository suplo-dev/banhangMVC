<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="bi bi-house"></i></li>
        <li class="breadcrumb-item active" aria-current="page">Trang chủ</li>
    </ol>
</nav>
<h2 class="mb-4">Bảng điều khiển quản trị</h2>

<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card bg-primary shadow">
            <div class="card-body text-white">
                <h5 class="card-title">Sản phẩm</h5>
                <p class="card-text fs-4"><?= $data['totalProducts'] ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-success shadow">
            <div class="card-body text-white">
                <h5 class="card-title">Đơn hàng</h5>
                <p class="card-text fs-4"><?= $data['totalOrders'] ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-warning shadow">
            <div class="card-body text-white">
                <h5 class="card-title">Doanh thu</h5>
                <p class="card-text fs-4"><?= number_format($data['totalRevenue']) ?> VND</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-dark shadow">
            <div class="card-body text-white">
                <h5 class="card-title">Khách hàng</h5>
                <p class="card-text fs-4"><?= $data['totalUsers'] ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Biểu đồ trạng thái đơn hàng nếu cần -->
<div class="mt-5">
    <h4>Trạng thái đơn hàng</h4>
    <ul class="list-group col-md-6">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Chờ xử lý
            <span class="badge bg-secondary"><?= $data['pendingOrders'] ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Đã hoàn tất
            <span class="badge bg-success"><?= $data['completedOrders'] ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Đã huỷ
            <span class="badge bg-danger"><?= $data['canceledOrders'] ?></span>
        </li>
    </ul>
</div>
