<h3 class="mb-4">Kết quả tìm kiếm cho: <strong><?= htmlspecialchars($data['keyword']) ?></strong></h3>

<?php if (empty($data['products'])): ?>
    <p class="text-muted">Không tìm thấy sản phẩm nào phù hợp.</p>
<?php else: ?>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-6 g-3">
        <?php foreach($data['products'] as $product): ?>
            <div class="col">
                <div class="card h-100 product-card" style="cursor: pointer;" data-link="?controller=product&action=detail&id=<?= $product['id'] ?>">
                    <img src="<?= $product['thumb_url'] ?>" class="card-img-top" alt="<?= $product['name'] ?>" style="height: 180px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title text-center"><?= $product['name'] ?></h6>
                        <p class="card-text text-danger fw-bold text-center"><?= number_format($product['price']) ?> VND</p>
                        <div class="mt-auto d-flex justify-content-center">
                            <button type="button" class="btn btn-success btn-sm add-to-cart" data-id="<?= $product['id'] ?>">Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <nav>
        <ul class="pagination justify-content-end mt-4">

            <!-- Previous -->
            <?php if ($data['current_page'] > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?controller=product&action=search&page=<?= $data['current_page'] - 1 ?>"><</a>
                </li>
            <?php endif; ?>

            <!-- Page Numbers -->
            <?php for ($i = 1; $i <= $data['total_pages']; $i++): ?>
                <li class="page-item <?= ($i == $data['current_page']) ? 'active' : '' ?>">
                    <a class="page-link" href="?controller=product&action=search&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <!-- Next -->
            <?php if ($data['current_page'] < $data['total_pages']): ?>
                <li class="page-item">
                    <a class="page-link" href="?controller=product&action=search&page=<?= $data['current_page'] + 1 ?>">></a>
                </li>
            <?php endif; ?>

        </ul>
    </nav>


<?php endif; ?>
<script>
    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.closest('button')) return;
            window.location.href = this.dataset.link;
        });
    });
</script>
