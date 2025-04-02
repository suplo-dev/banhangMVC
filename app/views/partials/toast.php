<div class="position-fixed top-0 end-0 p-3" style="z-index: 1055; margin-top: 60px;"> <!-- Đưa Toast lên phía trên -->
    <div class="toast toast-custom align-items-center text-white <?= isset($_SESSION['toast']['bg_class']) ? $_SESSION['toast']['bg_class'] : 'bg-info' ?> border-0" role="alert"
         aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <?= isset($_SESSION['toast']['message']) ? $_SESSION['toast']['message'] : 'Thông báo hệ thống' ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
        </div>
        <div class="progress" style="height: 5px;">
            <div id="toast-progress" class="progress-bar progress-bar-animated <?= isset($_SESSION['toast']['bg_class']) ? $_SESSION['toast']['bg_class'] : 'bg-info' ?>" style="width: 0%;"></div>
        </div>
    </div>
</div>
