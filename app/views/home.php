<div class="row mb-4">
    <!-- Danh mục bên trái -->
    <div class="col-md-3">
        <div class="list-group">
            <?php foreach ($data['categories'] as $category): ?>
                <a href="?controller=product&action=search&category_id=<?= $category['id'] ?>"
                   class="list-group-item list-group-item-action d-flex align-items-center">
                    <!-- Icon -->
                    <i class="bi bi-laptop me-2"></i>
                    <?= $category['name'] ?>
                    <i class="bi bi-chevron-right ms-auto"></i>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Carousel bên phải -->
    <div class="col-md-9">
        <!-- Carousel code bạn đã có -->
        <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel"
             style="max-width: 747px; height: 350px; overflow: hidden;">
            <div class="carousel-inner">
                <?php foreach ($data['banners'] as $index => $banner): ?>
                    <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
                        <a href="<?= $banner['link'] ?>">
                            <img src="<?= $banner['image'] ?>" class="d-block w-100" alt="<?= $banner['title'] ?>"
                                 style="height: 350px; object-fit: cover;">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <img src="assets/images/subBanner1.png" alt="">
    </div>
    <div class="col-4">
        <img src="assets/images/subBanner2.png" alt="">
    </div>
    <div class="col-4">
        <img src="assets/images/subBanner3.png" alt="">
    </div>
</div>
<h2 class="mt-5 mb-3 text-uppercase">Sản phẩm bán chạy</h2>
<div class="row row-cols-2 row-cols-sm-3 row-cols-md-6 g-3">
    <?php foreach ($data['products'] as $product): ?>
        <div class="col">
            <div class="card h-100 product-card"
                 data-link="?controller=product&action=detail&id=<?= $product['id'] ?>">
                <img src="<?= $product['thumb_url'] ?>" class="card-img-top" alt="<?= $product['name'] ?>"
                     style="height: 180px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title"><?= $product['name'] ?></h6>
                    <p class="card-text text-danger fw-bold"><?= number_format($product['price']) ?> VND</p>
                    <div class="mt-auto d-flex justify-content-center">
                        <button type="button" class="btn btn-success btn-sm add-to-cart"
                                data-id="<?= $product['id'] ?>">Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<h2 class="mt-5 mb-3 text-uppercase">Sản phẩm mới về</h2>
<div class="row row-cols-2 row-cols-sm-3 row-cols-md-6 g-3">
    <?php foreach ($data['products'] as $product): ?>
        <div class="col">
            <div class="card h-100 product-card" style="cursor: pointer;"
                 data-link="?controller=product&action=detail&id=<?= $product['id'] ?>">
                <img src="<?= $product['thumb_url'] ?>" class="card-img-top" alt="<?= $product['name'] ?>"
                     style="height: 180px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title"><?= $product['name'] ?></h6>
                    <p class="card-text text-danger fw-bold"><?= number_format($product['price']) ?> VND</p>
                    <div class="mt-auto d-flex justify-content-center">
                        <button type="button" class="btn btn-success btn-sm add-to-cart"
                                data-id="<?= $product['id'] ?>">Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php foreach ($data['categoriesShowHome'] as $category): ?>
    <h2 class="mt-5 mb-3 text-uppercase"><?= $category['name'] ?></h2>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-6 g-3">
        <?php foreach ($category['products'] as $product): ?>
        <div class="col">
            <div class="card h-100 product-card" style="cursor: pointer;"
                 data-link="?controller=product&action=detail&id=<?= $product['id'] ?>">
                <img src="<?= $product['thumb_url'] ?>" class="card-img-top" alt="<?= $product['name'] ?>"
                     style="height: 180px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title"><?= $product['name'] ?></h6>
                    <p class="card-text text-danger fw-bold"><?= number_format($product['price']) ?> VND</p>
                    <div class="mt-auto d-flex justify-content-center">
                        <button type="button" class="btn btn-success btn-sm add-to-cart"
                                data-id="<?= $product['id'] ?>">Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>

<!--<h2 class="mt-5 mb-3 text-uppercase">Tin tức mới</h2>-->
<!--<div class="row">-->
<!--    --><?php //foreach ($data['news'] as $news): ?>
<!--        <div class="col-md-6 mb-4">-->
<!--            <div class="card">-->
<!--                <img src="--><?php //= $news['image'] ?><!--" class="card-img-top" height="200">-->
<!--                <div class="card-body">-->
<!--                    <h5 class="card-title">--><?php //= $news['title'] ?><!--</h5>-->
<!--                    <a href="?controller=news&action=detail&id=--><?php //= $news['id'] ?><!--" class="btn btn-outline-secondary">Xem-->
<!--                        chi tiết</a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    --><?php //endforeach; ?>
<!--</div>-->
<div class="row mt-5">
    <div class="col-4">
        <img src="assets/images/subBanner4.png" alt="">
    </div>
    <div class="col-4">
        <img src="assets/images/subBanner5.png" alt="">
    </div>
    <div class="col-4">
        <img src="assets/images/subBanner6.png" alt="">
    </div>
</div>
<script>
    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('click', function (e) {
            // Nếu click vào nút trong card (thêm giỏ hàng) thì không redirect
            if (e.target.closest('button') || e.target.closest('a')) return;
            window.location.href = this.dataset.link;
        });
    });
</script>
