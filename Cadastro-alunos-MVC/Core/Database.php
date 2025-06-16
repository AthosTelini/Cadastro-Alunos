<?php
// Core/Database.php

class Database {
    private static $pdo = null;

    /**
     *
     *
     * @return PDO 
     */
    public static function getInstance() {
        if (self::$pdo === null) {
            require_once __DIR__ . '/../config.php';

            try {
                $dsn = 'pgsql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME;
                
                self::$pdo = new PDO($dsn, DB_USER, DB_PASSWORD, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
                ]);

            } catch (PDOException $e) {
                die("Erro fatal na conexão com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}