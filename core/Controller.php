<?php

// core/Controller.php
class Controller
{
    public function model($model)
    {
        require_once "../app/models/" . $model . ".php";
        return new $model();
    }

    public function view($view, $data = [])
    {
        require_once "../app/views/layouts/main.php";
    }

    public function debug($data) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}
