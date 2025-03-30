<?php
const DB_HOST = 'localhost';
const DB_NAME = 'hhstore';
const DB_USER = 'root';
const DB_PASS = '';

const MAIL_PASS = 'lsbl ropi vykk vysn';

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

