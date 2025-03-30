<?php
const DB_HOST = 'localhost';
const DB_NAME = 'hhstore';
const DB_USER = 'root';
const DB_PASS = '';
class Model {

    protected $db;

    public function __construct() {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        $this->db = require_once "../config/config.php";
        $this->db = $pdo;
    }
}
