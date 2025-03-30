<?php
class NewsController extends Controller {
    public function index() {

        if ($_SESSION['user']['role'] != 'admin') die('Bạn không có quyền!');
        $newsModel = $this->model('News');
        $news = $newsModel->getAllNews();
        $this->view('admin/news_list', ['news' => $news]);
    }

    public function add() {

        if ($_SESSION['user']['role'] != 'admin') die('Bạn không có quyền!');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];

            $target_dir = "public/assets/images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            $newsModel = $this->model('News');
            $newsModel->addNews($title, $content, $target_file);
            header('Location: ?controller=news&action=index');
        } else {
            $this->view('admin/news_add');
        }
    }

    public function edit() {

        if ($_SESSION['user']['role'] != 'admin') die('Bạn không có quyền!');
        $id = $_GET['id'];
        $newsModel = $this->model('News');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];

            if ($_FILES["image"]["name"] != '') {
                $target_dir = "public/assets/images/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            } else {
                $news = $newsModel->getNewsById($id);
                $target_file = $news['image'];
            }

            $newsModel->updateNews($id, $title, $content, $target_file);
            header('Location: ?controller=news&action=index');
        } else {
            $news = $newsModel->getNewsById($id);
            $this->view('admin/news_edit', ['news' => $news]);
        }
    }

    public function delete() {

        if ($_SESSION['user']['role'] != 'admin') die('Bạn không có quyền!');
        $id = $_GET['id'];
        $newsModel = $this->model('News');
        $newsModel->deleteNews($id);
        header('Location: ?controller=news&action=index');
    }

    public function detail() {
        $id = $_GET['id'];
        $newsModel = $this->model('News');
        $news = $newsModel->getNewsById($id);
        $this->view('news_detail', ['news' => $news]);
    }
}
