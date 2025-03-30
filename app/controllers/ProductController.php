<?php
class ProductController extends Controller {
    public function index() {
        $categoryId = isset($_GET['category']) ? (int)$_GET['category'] : 0;
        $minPrice = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
        $maxPrice = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 0;

        $productModel = $this->model('Product');
        $categoryModel = $this->model('Category');

        $products = $productModel->filterProducts($categoryId, $minPrice, $maxPrice);
        $categories = $categoryModel->getAllCategories();

        $this->view('product_list', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $categoryId,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice
        ]);
    }

    public function detail() {
        $id = $_GET['id'] ?? 0;
        $productModel = $this->model('Product');
        $product = $productModel->getProductById($id);
        if ($product) {
            $fileModel = $this->model('File');
            $files = $fileModel->getProductFiles($product['id']);
            $this->view('product_detail', ['product' => $product, 'files' => $files]);
        }
        $this->view('404');
    }

    public function search() {
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
        $this->view('product_list', [
            'products' => $products,
            'categories' => $categories,
            'current_page' => $page,
            'total' => $total,
            'total_pages' => ceil($total / $perPage),
        ]);
    }
}
