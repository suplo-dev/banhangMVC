<div class="row">
    <div class="col-md-12">
        <h2 class="mb-3"><?= $data['news']['title'] ?></h2>
        <img src="<?= $data['news']['image'] ?>" class="img-fluid mb-4" alt="<?= $data['news']['title'] ?>">
        <p><?= nl2br($data['news']['content']) ?></p>
        <a href="index.php" class="btn btn-secondary mt-3">Quay lại</a>
    </div>
</div>
