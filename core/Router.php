<?php
class Router {
    public function route() {
        $controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        $controllerName = ucfirst($controller) . 'Controller';
        $controllerFile = '../app/controllers/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerObj = new $controllerName();
            if (method_exists($controllerObj, $action)) {
                $controllerObj->$action();
            } else {
                $view = '404';
                $data = [];
                require_once '../app/views/layouts/main.php';
            }
        } else {
            $view = '404';
            $data = [];
            require_once '../app/views/layouts/main.php';
        }
    }
}
