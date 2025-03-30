<?php
class HomeController extends Controller
{
    public function index()
    {
        $productModel = $this->model('Product');
        $products = $productModel->getAllProducts();
        $bannerModel = $this->model('Banner');
        $banners = $bannerModel->getAllBanners();
        $newsModel = $this->model('News');
        $news = $newsModel->getAllNews();
        $categoryModel = $this->model('Category');
        $categories = $categoryModel->getAllCategories();
        $_SESSION['categories'] = $categories;
        $categoriesShowHome = array_filter($categories, fn ($item) => (bool) $item['show_home']);
        foreach($categoriesShowHome as &$category){
            $category['products'] = $productModel->getProductsByCategoryId($category['id'], 12);
        }
        $this->view('home', [
            'products' => $products,
            'banners' => $banners,
            'news' => $news,
            'categories' => $categories,
            'categoriesShowHome' => $categoriesShowHome,
        ]);
    }
}


