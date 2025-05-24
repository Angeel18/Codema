<?php
// Incluye el archivo de la clase Dotenv, que se encarga de cargar las variables de entorno
require_once 'dotenv.php';
// Carga el archivo .env desde la ruta absoluta utilizando __DIR__ (directorio actual)
// Esto garantiza que siempre se use la ubicación correcta, sin importar desde dónde se ejecute el script
Dotenv::load(__DIR__ . '/../.env');
?>
