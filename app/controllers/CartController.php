<?php

class CartController extends Controller
{
    public function index()
    {
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        $productModel = $this->model('Product');
        $totalAmount = 0;
        $products = $productModel->getProductById(array_keys($_SESSION['cart']));
        foreach ($products as $product) {
            $totalAmount += $cart[$product['id']] * $product['price'];
        }

        $this->view('cart', ['cart' => $cart, 'products' => $products, 'total_amount' => $totalAmount, 'productIds' => []]);
    }

    public function add()
    {
        $id = $_GET['id'];
        if (!isset($_SESSION['cart']) || !isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = 1;
        } else {
            $_SESSION['cart'][$id]++;
        }
        header('Location: ?controller=cart&action=index');
    }

    public function checkout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy thông tin khách hàng từ form
            $name = $_POST['name'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            $productIds = $_POST['productIds'] ?? [];

            // Kiểm tra nếu có sản phẩm được chọn để thanh toán
            if (count($productIds)) {
                $total = 0;
                $productModel = $this->model('Product');
                $products = $productModel->getProductById($productIds);
                $orderDetails = [];
                // Lưu thông tin chi tiết đơn hàng
                foreach ($products as $product) {
                    if (isset($_SESSION['cart'][$product['id']])) {
                        $quantity = $_SESSION['cart'][$product['id']];
                        $amount = $product['price'] * $quantity;
                        $total += $amount;

                        $orderDetails[] = [
                            'product_id' => $product['id'],
                            'price' => $product['price'],
                            'quantity' => $quantity,
                            'amount' => $amount,
                            'name' => $product['name'],
                            'thumb_url' => $product['thumb_url'],
                        ];

                        if ($name && $phone && $address) {
                            unset($_SESSION['cart'][$product['id']]);
                        }
                    }
                }
                if ($name && $phone && $address) {
                    $orderModel = $this->model('Order');
                    $orderModel->createOrder($name, $phone, $address, $total, $orderDetails);
                    $_SESSION['toast'] = [
                        'message' => 'Tạo đơn hàng thành công!',
                        'bg_class' => 'bg-success'
                    ];
                    $this->view('checkout', [
                        'success' => true,
                    ]);
                }
                $this->view('checkout', [
                    'order_details' => $orderDetails,
                    'total_amount' => $total,
                ]);
            }
        } else {
            // Nếu không phải POST, chỉ hiển thị trang checkout
            $this->view('checkout');
        }
    }

    public function update()
    {
        $id = $_GET['id'];
        $change = $_POST['change'];
        var_dump($_SESSION);
        if (isset($_SESSION['cart'][$id])) {
            if ($change == 'increase') {
                $_SESSION['cart'][$id]++;
            } elseif ($change == 'decrease') {
                $_SESSION['cart'][$id]--;
                if ($_SESSION['cart'][$id] <= 0) {
                    unset($_SESSION['cart'][$id]); // Nếu giảm về 0 thì xoá
                }
            }
        }

        header('Location: ?controller=cart&action=index');
    }

    public function remove()
    {

        $id = $_GET['id'];
        unset($_SESSION['cart'][$id]);
        header('Location: ?controller=cart&action=index');
    }

    public function addAjax()
    {
        $id = $_POST['id'];

        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]++;
        } else {
            $_SESSION['cart'][$id] = 1;
        }

        // Prepare JSON response
        $items = [];
        foreach ($_SESSION['cart'] as $pid => $qty) {
            $items[] = ['id' => $pid, 'qty' => $qty];
        }

        $_SESSION['toast'] = [
            'bg_class' => 'bg-success',
            'message' => 'Thêm sản phẩm vào giỏ thành công',
        ];
        echo json_encode([
            'count' => array_sum($_SESSION['cart']),
            'items' => $items
        ]);
        exit; // Thêm exit để tránh PHP chạy tiếp
    }

    public function updateAjax()
    {
        $id = $_POST['id'];
        $change = $_POST['change'];

        if (isset($_SESSION['cart'][$id])) {
            if ($change == 'increase') {
                $_SESSION['cart'][$id]++;
            } elseif ($change == 'decrease') {
                $_SESSION['cart'][$id]--;
                if ($_SESSION['cart'][$id] <= 0) {
                    unset($_SESSION['cart'][$id]);
                    echo json_encode(['qty' => 0, 'total_count' => array_sum($_SESSION['cart'])]);
                    return;
                }
            }
        }

        echo json_encode([
            'qty' => $_SESSION['cart'][$id],
            'total_count' => array_sum($_SESSION['cart'])
        ]);
    }

    public function bulkRemove()
    {
        if (isset($_POST['remove_ids'])) {
            foreach ($_POST['remove_ids'] as $id) {
                unset($_SESSION['cart'][$id]);
            }
        }
        header('Location: index.php');
    }
}
