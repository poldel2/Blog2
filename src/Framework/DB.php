<?php

namespace Laravel\Blog\Framework;
use Exception;
use PDO;

class DB
{
    public static function getConnection()
    {
        $dbHost = '127.0.0.1';
        $dbName = 'blog';
        $dbUser = 'root';
        $dbPass = '';

        $dsn = "mysql:host=$dbHost;dbname=$dbName";
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        try {
            return new PDO($dsn, $dbUser, $dbPass, $options);
        } catch (Exception $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }
}