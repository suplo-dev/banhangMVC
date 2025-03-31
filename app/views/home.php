<div class="row mb-4">
    <!-- Carousel bên phải -->
    <div class="col-12">
        <!-- Carousel code bạn đã có -->
        <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000"
             style="overflow: hidden;">
            <div class="carousel-inner">
                <?php foreach ($data['banners'] as $index => $banner): ?>
                    <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
                        <a href="<?= $banner['link'] ?>">
                            <img src="<?= $banner['image'] ?>" class="d-block w-100" alt="<?= $banner['title'] ?>"
                                 style="object-fit: cover;">
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
    <div id="carouselProductImages" class="carousel-container w-100">
        <button class="carousel-control-prev" type="button">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <div class="carousel-track-wrapper">
            <div class="carousel-track">
                <?php foreach ($data['products'] as $product): ?>
                    <div class="carousel-item-custom">
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
        </div>
        <button class="carousel-control-next" type="button">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>

<?php foreach ($data['categoriesShowHome'] as $category): ?>
    <h2 class="mt-5 mb-3 text-uppercase"><?= $category['name'] ?></h2>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-6 g-3">
        <div id="carouselProductImages" class="carousel-container w-100">
            <button class="carousel-control-prev" type="button">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <div class="carousel-track-wrapper">
                <div class="carousel-track">
                    <?php foreach ($category['products'] as $product): ?>
                        <div class="carousel-item-custom">
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
            </div>
            <button class="carousel-control-next" type="button">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
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
<style>
    .carousel-container {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
    }

    .carousel-track-wrapper {
        overflow: hidden;
        width: 100%;
    }

    .carousel-track {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .carousel-item-custom {
        flex: 0 0 20%; /* Hiển thị 4 ảnh mỗi lần */
        padding: 5px;
        text-align: center;
    }

    .carousel-item-custom img {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .carousel-control-prev, .carousel-control-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.6);
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }

    .carousel-control-prev { left: 10px; }
    .carousel-control-next { right: 10px; }

    .carousel-control-prev-icon, .carousel-control-next-icon {
        width: 20px;
        height: 20px;
        background-color: white;
        -webkit-mask-image: url('data:image/svg+xml;charset=UTF-8,%3Csvg viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"%3E%3Cpath fill-rule="evenodd" d="M11.854 1.146a.5.5 0 0 1 0 .708L5.707 8l6.147 6.146a.5.5 0 0 1-.708.708l-6.5-6.5a.5.5 0 0 1 0-.708l6.5-6.5a.5.5 0 0 1 .708 0z"%3E%3C/path%3E%3C/svg%3E');
        mask-image: url('data:image/svg+xml;charset=UTF-8,%3Csvg viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"%3E%3Cpath fill-rule="evenodd" d="M11.854 1.146a.5.5 0 0 1 0 .708L5.707 8l6.147 6.146a.5.5 0 0 1-.708.708l-6.5-6.5a.5.5 0 0 1 0-.708l6.5-6.5a.5.5 0 0 1 .708 0z"%3E%3C/path%3E%3C/svg%3E');
    }

    .carousel-control-next-icon {
        transform: rotate(180deg);
    }

    .main-thumbnail {
        width: 75%; /* Giữ kích thước cố định */
        height: auto;
        max-height: 400px; /* Giới hạn chiều cao */
        object-fit: cover; /* Đảm bảo ảnh không bị méo */
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".carousel-container").forEach(carouselContainer => {
            const track = carouselContainer.querySelector(".carousel-track");
            const prevBtn = carouselContainer.querySelector(".carousel-control-prev");
            const nextBtn = carouselContainer.querySelector(".carousel-control-next");
            const items = carouselContainer.querySelectorAll(".carousel-item-custom");

            let index = 0;

            function updateCarousel() {
                const offset = -index * 100 / 5; // 5 là số ảnh hiển thị
                track.style.transform = `translateX(${offset}%)`;
            }

            nextBtn.addEventListener("click", function () {
                if (index < items.length - 5) {
                    index++;
                    updateCarousel();
                }
            });

            prevBtn.addEventListener("click", function () {
                if (index > 0) {
                    index--;
                    updateCarousel();
                }
            });
        });
    });
</script>

