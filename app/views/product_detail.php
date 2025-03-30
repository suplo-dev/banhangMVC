<div class="row">
    <div class="col-md-6">
        <!-- Thumbnail -->
        <img class="main-thumbnail m-2 mt-5" src="<?= $data['product']['thumb_url'] ?>" class="img-fluid mb-4" alt="<?= $data['product']['name'] ?>">

        <!-- Ảnh chi tiết -->
        <?php if (!empty($data['files'])): ?>
            <div id="carouselProductImages" class="carousel-container">
                <button class="carousel-control-prev" type="button">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <div class="carousel-track-wrapper">
                    <div class="carousel-track">
                        <div class="carousel-item-custom">
                            <img src="<?= $data['product']['thumb_url'] ?>" class="img-thumbnail" alt="Ảnh chi tiết">
                        </div>
                        <?php foreach ($data['files'] as $file): ?>
                            <div class="carousel-item-custom">
                                <img src="<?= $file['file_url'] ?>" class="img-thumbnail" alt="Ảnh chi tiết">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <button class="carousel-control-next" type="button">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-6">
        <h2 class="mt-5"><?= $data['product']['name'] ?></h2>
        <div><?= $data['product']['description'] ?></div>
        <h5 class="text-danger" style="font-weight: bold"><?= number_format($data['product']['price']) ?> VND</h5>
        <a href="?controller=cart&action=add&id=<?= $data['product']['id'] ?>" class="btn btn-success">Thêm vào giỏ hàng</a>
    </div>
</div>
<div class="row border-top mt-3 pt-3">

</div>
<style>
    .carousel-container {
        position: relative;
        max-width: 500px;
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
        const track = document.querySelector(".carousel-track");
        const prevBtn = document.querySelector(".carousel-control-prev");
        const nextBtn = document.querySelector(".carousel-control-next");
        const items = document.querySelectorAll(".carousel-item-custom img");
        const mainImage = document.querySelector(".main-thumbnail"); // Ảnh chính
        let index = 0;

        // Lưu ảnh đầu tiên
        const firstImageSrc = items[0].src;
        mainImage.src = firstImageSrc;

        function updateCarousel() {
            const offset = -index * 100 / 5; // Trượt từng ảnh
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

        items.forEach(img => {
            img.addEventListener("mouseenter", function () {
                mainImage.src = img.src;
            });

            img.addEventListener("mouseleave", function () {
                mainImage.src = firstImageSrc; // Quay về ảnh đầu tiên khi rời chuột
            });
        });
    });

</script>
