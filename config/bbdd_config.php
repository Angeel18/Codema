<?php
/**
 * config_db.php
 *
 * Configuración de la base de datos y funciones auxiliares
 */

require_once "config.php"; // Incluye el archivo de configuración general (por ejemplo, para cargar variables de entorno)

/**
 * createConnection
 *
 * Establece una nueva conexión PDO utilizando constantes.
 */
function createConnection()
{
    try {
        // Crea una nueva instancia de PDO usando las variables de entorno para host, base de datos, usuario y contraseña
        $pdo = new PDO(
            "mysql:host=" . getenv("DB_HOST") . ";dbname=" . getenv("DB_NAME"),
            getenv("DB_USER"),
            getenv("DB_PASSWORD")
        );
        // Configura PDO para que lance excepciones en caso de error
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Si hay un error de conexión, devuelve un error 500 y muestra un mensaje
        http_response_code(500);
        echo "Error de conexión a la base de datos: " . $e->getMessage();
        exit;
    }
    // Devuelve el objeto PDO listo para usarse
    return $pdo;
}

/**
 * checkConnection
 *
 * Comprueba la conexión y detiene la ejecución si hay un error.
 *
 * @return bool True si la conexión es correcta (sin errores).
 */
function checkConnection($pdo)
{
    try {
        // Realiza una consulta simple para verificar que la conexión funciona
        $pdo->query('SELECT 1');
    } catch (PDOException $e) {
        // Si falla, termina el script y muestra el mensaje de error
        die("Error de conexión a la base de datos: " . $e->getMessage());
    }
    // Si no hay error, devuelve true
    return true;
}
