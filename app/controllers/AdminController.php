<?php

class AdminController extends Controller
{
    private array $toast;

    public function __construct()
    {
        $this->toast = [];
    }

    public function index()
    {
        $orderModel = $this->model('Order');
        $productModel = $this->model('Product');
        $userModel = $this->model('User');

        $data = [
            'totalProducts' => $productModel->countAll(),
            'totalOrders' => $orderModel->countAll(),
            'totalRevenue' => $orderModel->getTotalRevenue(),
            'totalUsers' => $userModel->countAll(),
            'pendingOrders' => $orderModel->countByStatus('Chờ xác nhận'),
            'deliveryOrders' => $orderModel->countByStatus('Đang giao'),
            'completedOrders' => $orderModel->countByStatus('Hoàn thành'),
            'canceledOrders' => $orderModel->countByStatus('Đã huỷ'),
        ];

        $this->view('admin/dashboard', $data);
    }

    public function productList()
    {
        $productModel = $this->model('Product');
        $page = $_GET['page'] ?? 1;
        $perPage = $_GET['perPage'] ?? 20;
        $products = $productModel->searchProduct([
            'category_id' => $_GET['category_id'] ?? 0,
            'keyword' => $_GET['keyword'] ?? '',
            'min_price' => $_GET['min_price'] ?? 0,
            'max_price' => $_GET['max_price'] ?? 0
        ], $perPage, $page - 1);
        $total = $productModel->countProduct([
            'category_id' => $_GET['category_id'] ?? 0,
            'keyword' => $_GET['keyword'] ?? '',
            'min_price' => $_GET['min_price'] ?? 0,
            'max_price' => $_GET['max_price'] ?? 0
        ]);
        $categoryModel = $this->model('Category');
        $categories = $categoryModel->getAllCategories();
        foreach ($products as &$product) {
            foreach ($categories as $category) {
                if ($category['id'] == $product['category_id']) {
                    $product['category'] = $category;
                }
            }
        }
        $this->view('admin/product_list', [
            'products' => $products,
            'categories' => $categories,
            'current_page' => $page,
            'total' => $total,
            'total_pages' => ceil($total / $perPage),
        ]);
    }

    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];

            // Xử lý upload thumbnail
            $thumbPath = '';
            if (isset($_FILES['thumb']) && $_FILES['thumb']['error'] == 0) {
                $thumbName = time() . '_' . basename($_FILES['thumb']['name']);
                $thumbPath = 'uploads/' . $thumbName;
                move_uploaded_file($_FILES['thumb']['tmp_name'], $thumbPath);
            }

            // Thêm sản phẩm vào DB
            $productModel = $this->model('Product');
            $productId = $productModel->addProduct($name, $thumbPath, $price, $description, $category_id);

            // Xử lý upload nhiều ảnh chi tiết
            if (isset($_FILES['files'])) {
                $fileModel = $this->model('File');
                foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
                    if ($tmpName) {
                        $fileName = time() . '_' . basename($_FILES['files']['name'][$key]);
                        $filePath = 'uploads/' . $fileName;
                        move_uploaded_file($tmpName, $filePath);
                        $fileModel->addProductFile($productId, $filePath);
                    }
                }
            }

            header('Location: ?controller=admin&action=productList');
        } else {
            $categoryModel = $this->model('Category');
            $categories = $categoryModel->getAllCategories();
            $this->view('admin/product_add', ['categories' => $categories]);
        }
    }

    public function editProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            // Lấy dữ liệu từ form
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];

            // Lấy sản phẩm hiện tại từ cơ sở dữ liệu
            $productModel = $this->model('Product');
            $product = $productModel->getProductById($id);

            // Xử lý upload thumbnail (nếu có thay đổi)
            $thumbPath = $product['thumb_url']; // Giữ lại thumbnail cũ nếu không có thay đổi
            if (isset($_FILES['thumb']) && $_FILES['thumb']['error'] == 0) {
                $thumbName = time() . '_' . basename($_FILES['thumb']['name']);
                $thumbPath = 'uploads/' . $thumbName;
                move_uploaded_file($_FILES['thumb']['tmp_name'], $thumbPath);
            }

            // Cập nhật sản phẩm vào DB
            $productModel->updateProduct($id, $name, $thumbPath, $price, $description, $category_id);

            // Xử lý upload nhiều ảnh chi tiết
            if (isset($_FILES['files'])) {
                $fileModel = $this->model('File');
                foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
                    if ($tmpName) {
                        $fileName = time() . '_' . basename($_FILES['files']['name'][$key]);
                        $filePath = 'uploads/' . $fileName;
                        move_uploaded_file($tmpName, $filePath);
                        $fileModel->addProductFile($id, $filePath);
                    }
                }
            }

            // Chuyển hướng về danh sách sản phẩm
            header('Location: ?controller=admin&action=productList');
        } else {
            $id = $_GET['id'] ?? 1;
            // Lấy thông tin sản phẩm và danh mục
            $categoryModel = $this->model('Category');
            $categories = $categoryModel->getAllCategories();

            // Lấy thông tin sản phẩm cần chỉnh sửa
            $productModel = $this->model('Product');
            $product = $productModel->getProductById($id);
            $fileModel = $this->model('File');
            $product['files'] = $fileModel->getProductFiles($product['id']);

            // Hiển thị form chỉnh sửa với dữ liệu sản phẩm
            $this->view('admin/product_edit', ['categories' => $categories, 'product' => $product]);
        }
    }

    public function deleteProduct()
    {
        $id = intval($_POST['id']) ?? 0;
        $fileModel = $this->model('File');
        $fileModel->deleteProductFile($id);

        $productModel = $this->model('Product');
        $productModel->delete($id);

        header('Location: ?controller=admin&action=productList');
    }

    public function orderList()
    {
        $keyword = $_GET['keyword'] ?? '';
        $page = $_GET['page'] ?? 1;
        $perPage = $_GET['perPage'] ?? 20;
        $orderModel = $this->model('Order');
        $orders = $orderModel->searchOrder($keyword, $perPage, $page - 1);
        $total = $orderModel->countOrder($keyword);
        $page = $_GET['page'] ?? 1;
        $perPage = $_GET['perPage'] ?? 20;
        $this->view('admin/order/index', [
            'orders' => $orders,
            'current_page' => $page,
            'total' => $total,
            'total_pages' => ceil($total / $perPage),
            'toast' => $this->toast
        ]);
    }

    // Hiển thị danh sách các danh mục
    public function categoryList()
    {
        $categoryModel = $this->model('Category');
        $page = $_GET['page'] ?? 1;
        $perPage = $_GET['perPage'] ?? 20;
        $categories = $categoryModel->searchCategory([
            'keyword' => $_GET['keyword'] ?? '',
            'show_home' => $_GET['show_home'] ?? 0,
        ], $perPage, $page - 1);
        $total = $categoryModel->countCategory([
            'keyword' => $_GET['keyword'] ?? '',
            'show_home' => $_GET['show_home'] ?? 0,
        ]);
        $this->view('admin/category_list', [
            'categories' => $categories,
            'current_page' => $page,
            'total' => $total,
            'total_pages' => ceil($total / $perPage),
        ]);

        // Truyền dữ liệu cho view
        $this->view('admin/category_list', ['categories' => $categories]);
    }


    // Thêm mới danh mục
    public function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $showHome = isset($_POST['show_home']) ? 1 : 0;  // Cập nhật trạng thái hiển thị

            $categoryModel = $this->model('Category');
            $categoryModel->addCategory($name, $showHome);

            // Chuyển hướng về danh sách danh mục
            header('Location: ?controller=admin&action=categoryList');
        } else {
            // Hiển thị form thêm mới
            $this->view('admin/category_add');
        }
    }

    // Chỉnh sửa danh mục
    public function editCategory()
    {
        $categoryModel = $this->model('Category');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $showHome = $_POST['show_home'];
            $categoryModel->updateCategory($id, $name, $showHome);
            header('Location: ?controller=admin&action=categoryList');
        } else {
            $id = $_GET['id'];
            $category = $categoryModel->getCategoryById($id);
            $this->view('admin/category_edit', ['category' => $category]);
        }
    }

    // Xóa danh mục
    public function deleteCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];

            $categoryModel = $this->model('Category');
            $categoryModel->deleteCategory($id);

            // Chuyển hướng về danh sách danh mục
            header('Location: ?controller=admin&action=categoryList');
        }
    }

    public function orderDetails()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $orderModel = $this->model('Order');
            $orderModel->updateOrder([
                'id' => $_POST['id'],
                'customer_name' => $_POST['customer_name'],
                'address' => $_POST['address'],
                'phone' => $_POST['phone'],
                'status' => $_POST['status'],
            ]);
            $_SESSION['toast'] = [
                'bg_class' => 'bg-success',
                'message' => 'Cập nhật đơn hàng thành công'
            ];
            header('Location: ?controller=admin&action=orderList');
            exit;
        }
        $orderId = $_GET['id'];
        $orderModel = $this->model('Order');
        $orderDetails = $orderModel->getOrderDetails($orderId);
        $order = $orderModel->getOrderById($orderId);
        $this->view('admin/order/details', ['order' => $order, 'order_details' => $orderDetails]);
    }
}
