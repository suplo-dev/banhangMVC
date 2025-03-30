<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HHStore</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            // Xử lý thêm vào giỏ hàng
            $('.add-to-cart').click(function () {
                let id = $(this).data('id');

                $.post("index.php?controller=cart&action=addAjax", {id: id}, function (response) {
                    let data = JSON.parse(response);
                    $('#cart-count').text(data.count);
                });
            });


            // Xử lý tăng/giảm số lượng
            $('#cart-dropdown').on('click', '.change-qty', function (e) {
                e.stopPropagation();
            });
            $('.change-qty').click(function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let action = $(this).data('action');

                $.post("index.php?controller=cart&action=updateAjax", {id: id, change: action}, function (response) {
                    let data = JSON.parse(response);
                    $('#qty-' + id).text(data.qty);
                    $('#cart-count').text(data.total_count);
                });
                handleToast();
            });
            handleToast();
        });

        function handleToast() {
            const toastElement = $('.toast')[0]
            if (toastElement) {
                const toast = new bootstrap.Toast(toastElement); // Bootstrap Toast yêu cầu DOM element
                toast.show();
                let progress = 0;
                let interval = setInterval(function () {
                    progress += 4; // Tăng tiến trình lên 4% mỗi lần
                    $('#toast-progress').css('width', progress + '%'); // Cập nhật độ rộng của progress bar

                    if (progress >= 100) {
                        <?php unset($_SESSION['toast']); ?>
                        clearInterval(interval); // Dừng tiến trình
                        setTimeout(function () {
                            toast.hide(); // Ẩn Toast sau khi hoàn tất
                        }, 500); // Chờ 0.5 giây trước khi ẩn Toast
                    }
                }, 100);
            }
        }
    </script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img width="80px" src="assets/images/logo.png" alt="">
        </a>
        <div class="row">
            <div class="col">
                <div class="collapse navbar-collapse">
                    <!-- Menu trái (admin links) -->
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item"><a class="nav-link" href="?controller=admin&action=index">Trang chủ</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="?controller=admin&action=orderList">Đơn
                                    hàng</a></li>
                            <li class="nav-item"><a class="nav-link" href="?controller=admin&action=productList">Sản
                                    phẩm</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="?controller=admin&action=categoryList">Danh
                                    mục</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="?controller=banner&action=index">Banner</a>
                            </li>
                            <!--                    <li class="nav-item"><a class="nav-link" href="?controller=news&action=index">Tin tức</a></li>-->
                            <li class="nav-item"><a class="nav-link" href="?controller=user&action=search">Thành
                                    viên</a></li>
                        </ul>
                    <?php else: ?>
                        <!-- Searchbox nằm trái -->
                        <form class="d-flex search-form" action="?controller=product&action=search" method="GET">
                            <input type="hidden" name="controller" value="product">
                            <input type="hidden" name="action" value="search">
                            <input class="form-control search-input" type="search" name="keyword"
                                   placeholder="Nhập tên sản phẩm cần tìm">
                            <button class="btn search-btn" type="submit"><i class="bi bi-search"></i></button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 mt-1">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav align-items-center">
                        <?php foreach ($_SESSION['categories'] as $category): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="?controller=product&action=search&category_id=<?= $category['id'] ?>"> <?= $category['name'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Menu phải -->
        <ul class="navbar-nav align-items-center w-50 text-end justify-content-end">
            <?php if (isset($_SESSION['user'])): ?>
                <li class="nav-item"><a class="nav-link" href="?controller=order&action=history">Lịch sử đơn
                        hàng</a></li>
            <?php endif; ?>
            <!-- Giỏ hàng -->
            <li class="nav-item dropdown me-2 position-relative">
                <a class="nav-link" href="?controller=cart&action=index" role="button">
                    <i class="bi bi-cart"></i>
                    <span id="cart-count"
                          class="badge bg-danger"><?= isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0 ?></span>
                </a>
            </li>

            <!-- User login -->
            <?php if (isset($_SESSION['user'])): ?>
                <li class="nav-item"><a class="nav-link"
                                        href="?controller=user&action=profile">Hi <?= $_SESSION['user']['username'] ?>
                        ,</a></li>
                <li class="nav-item"><a class="nav-link" href="?controller=user&action=logout">Đăng xuất</a>
                </li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="?controller=user&action=login">Đăng nhập</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="?controller=user&action=register">Đăng ký</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>


<div class="container">
    <?php require_once "../app/views/$view.php"; ?>
</div>
<?php !empty($_SESSION['toast']) && include_once "../app/views/partials/toast.php"; ?>
<footer class="mt-5 pt-4 pb-3 border-top bg-dark text-white">
    <div class="container">
        <?php if (!(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin')): ?>
            <div class="row border-bottom mb-3">
                <!-- Cột 1: Logo & giới thiệu -->
                <div class="col-md-3 mb-3">
                    <h5>HHStore</h5>
                    <p>Hệ thống bán lẻ Laptop & Linh kiện chính hãng. Chất lượng - Giá tốt - Hậu mãi vượt trội.</p>
                </div>

                <!-- Cột 2: Chính sách -->
                <div class="col-md-3 mb-3">
                    <h6>Chính sách</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">Chính sách bảo hành</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Chính sách đổi trả</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Hướng dẫn mua hàng</a></li>
                    </ul>
                </div>

                <!-- Cột 3: Chi nhánh -->
                <div class="col-md-4 mb-3">
                    <h6>Hệ thống cửa hàng</h6>
                    <p><strong>CS1:</strong> 125 Trần Đại Nghĩa, Hai Bà Trưng, HN</p>
                    <p><strong>CS2:</strong> 34 Hồ Tùng Mậu, Cầu Giấy, HN</p>
                    <p><strong>CS3:</strong> 63 Nguyễn Thiện Thuật, Q3, TP HCM</p>
                </div>

                <!-- Cột 4: Hotline -->
                <div class="col-md-2 mb-3">
                    <h6>Hotline</h6>
                    <p class="mb-1">19001900</p>
                </div>
            </div>
        <?php endif; ?>

        <div class="text-center">
            <small>&copy; <?= date('Y') ?> HHStore. All rights reserved.</small>
        </div>
    </div>
</footer>
</body>
</html>
