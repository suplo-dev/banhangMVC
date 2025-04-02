<h2 class="mb-4">Giỏ hàng</h2>
<form id="formCheckout" method="POST" action="?controller=cart&action=checkout">
    <table class="table table-bordered align-middle">
        <thead class="table-primary text-center">
        <tr>
            <th class="text-center">
                <!-- Checkbox Select All -->
                <input type="checkbox" id="selectAll" class="form-check-input">
            </th>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <form action=""></form>
        <?php foreach ($data['products'] as $product): ?>
            <tr>
                <!-- Checkbox chọn sản phẩm -->
                <td class="text-center">
                    <input type="checkbox" name="productIds[]" value="<?= $product['id'] ?>" class="productCheckbox form-check-input">
                </td>

                <!-- Ảnh thumbnail -->
                <td class="text-center">
                    <img src="<?= $product['thumb_url'] ?>" width="60" height="60" style="object-fit: cover;">
                </td>

                <td class="text-center"><?= $product['name'] ?></td>

                <!-- Cột số lượng căn giữa -->
                <td class="text-center">
                    <form id="updateCart<?= $product['id'] ?>" method="post" action="?controller=cart&action=update&id=<?= $product['id'] ?>"
                          class="d-flex justify-content-center align-items-center">
                        <button type="submit" name="change" value="decrease" class="btn btn-secondary btn-sm me-1" form="updateCart<?= $product['id'] ?>">-
                        </button>
                        <span class="mx-2"><?= $data['cart'][$product['id']] ?></span>
                        <button type="submit" name="change" value="increase" class="btn btn-secondary btn-sm ms-1" form="updateCart<?= $product['id'] ?>">+
                        </button>
                    </form>
                </td>

                <!-- Cột thành tiền căn phải -->
                <td class="text-end"><?= number_format($product['price'] * $data['cart'][$product['id']]) ?> VND</td>

                <td class="text-center">
                    <a href="?controller=cart&action=remove&id=<?= $product['id'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Tổng tiền căn phải -->
    <p class="text-end"><strong>Tổng tiền:</strong> <?= number_format($data['total_amount']) ?> VND</p>

    <div class="text-end">
        <button type="submit" id="checkoutButton" class="btn btn-primary" disabled>Thanh toán</button>
    </div>
</form>
<script>
    $(document).ready(function () {
        // Lắng nghe sự kiện click vào checkbox "Select All"
        $('#selectAll').click(function () {
            // Lấy trạng thái của checkbox "Select All"
            var isChecked = $(this).prop('checked');

            // Thiết lập trạng thái của tất cả checkbox sản phẩm
            $('.productCheckbox').prop('checked', isChecked);
        });

        // Lắng nghe sự kiện click vào bất kỳ checkbox sản phẩm
        $('.productCheckbox').click(function () {
            // Kiểm tra nếu tất cả checkbox sản phẩm đã được chọn, thì chọn "Select All"
            var allChecked = $('.productCheckbox:checked').length === $('.productCheckbox').length;

            // Cập nhật trạng thái "Select All" checkbox
            $('#selectAll').prop('checked', allChecked);
        });

        function toggleCheckoutButton() {
            let isAnyChecked = $('.productCheckbox:checked').length > 0;
            $('#checkoutButton').prop('disabled', !isAnyChecked);
        }

        // Lắng nghe sự kiện click vào checkbox "Select All"
        $('#selectAll').click(function () {
            let isChecked = $(this).prop('checked');
            $('.productCheckbox').prop('checked', isChecked);
            toggleCheckoutButton();
        });

        // Lắng nghe sự kiện click vào bất kỳ checkbox sản phẩm
        $('.productCheckbox').click(function () {
            let allChecked = $('.productCheckbox:checked').length === $('.productCheckbox').length;
            $('#selectAll').prop('checked', allChecked);
            toggleCheckoutButton();
        });

        // Kiểm tra trạng thái khi trang tải lại
        toggleCheckoutButton();
    });

</script>
