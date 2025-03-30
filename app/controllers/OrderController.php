<?php

class OrderController extends Controller
{
    public function update() {

    }

    public function history()
    {
        $userId = $_SESSION['user']['id'];  // Lấy ID người dùng từ session

        // Lấy danh sách đơn hàng của người dùng
        $orderModel = $this->model('Order');
        $orders = $orderModel->getOrdersByUserId($userId);

        // Gửi dữ liệu đến view
        $this->view('order/history', ['orders' => $orders]);
    }

    public function details()
    {
        $orderId = $_GET['id'];
        $orderModel = $this->model('Order');
        $order = $orderModel->getOrderDetails($orderId);
        $productModel = $this->model('Product');

        $this->view('order/details', ['order' => $order]);
    }
}
