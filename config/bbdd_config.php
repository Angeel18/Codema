<?php
/**
 * config_db.php
 *
 * Database configuration and helper functions
 */

require_once "config.php";
/**
 * createConnection
 *
 * Establishes a new PDO constants.
 *

 */
function createConnection()
{

    try {
        $pdo = new PDO("mysql:host=" . getenv("DB_HOST") . ";dbname=" . getenv("DB_NAME"), getenv("DB_USER"), getenv("DB_PASSWORD"));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Error de conexión a la base de datos: " . $e->getMessage();
        exit;
    }
    return $pdo;
}

/**
 * checkConnection
 *
 * Checks connection and stops execution on error.
 *
 * @return bool True if connection is OK (no error).
 */
function checkConnection($pdo)
{
    try {
        $pdo->query('SELECT 1');
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
    return true;
}
