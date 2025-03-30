<?php
class BannerController extends Controller {
    public function index() {
        if ($_SESSION['user']['role'] != 'admin') die('Bạn không có quyền!');
        $bannerModel = $this->model('Banner');
        $banners = $bannerModel->getAllBanners();
        $this->view('admin/banner_list', ['banners' => $banners]);
    }

    public function add() {
        if ($_SESSION['user']['role'] != 'admin') die('Bạn không có quyền!');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $link = $_POST['link'];

            $target_dir = "assets/images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            $bannerModel = $this->model('Banner');
            $bannerModel->addBanner($title, $target_file, $link);
            header('Location: ?controller=banner&action=index');
        } else {
            $this->view('admin/banner/add');
        }
    }

    public function edit() {

        if ($_SESSION['user']['role'] != 'admin') die('Bạn không có quyền!');
        $id = $_GET['id'];
        $bannerModel = $this->model('Banner');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $link = $_POST['link'];

            if ($_FILES["image"]["name"] != '') {
                $target_dir = "assets/images/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            } else {
                $banner = $bannerModel->getBannerById($id);
                $target_file = $banner['image'];
            }

            $bannerModel->updateBanner($id, $title, $target_file, $link);
            header('Location: ?controller=banner&action=index');
        } else {
            $banner = $bannerModel->getBannerById($id);
            $this->view('admin/banner/edit', ['banner' => $banner]);
        }
    }

    public function delete() {

        if ($_SESSION['user']['role'] != 'admin') die('Bạn không có quyền!');
        $id = $_GET['id'];
        $bannerModel = $this->model('Banner');
        $bannerModel->deleteBanner($id);
        header('Location: ?controller=banner&action=index');
    }
}
