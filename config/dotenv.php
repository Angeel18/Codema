<?php
// Cargador simple de archivos .env para PHP sin Composer.
class Dotenv {
/**
 * Carga y parsea un archivo .env al entorno de PHP.
 * @throws Exception si el archivo no se encuentra o no se puede leer.
 */
private string $path = "/srv/website/.env";

public static function load(string $path): void{
// Comprueba si el archivo es legible
if (!is_readable($path)) {
    throw new Exception("Dotenv: No se puede leer el archivo .env en {$path}");
}

// Lee todas las líneas del archivo .env, ignorando líneas vacías
$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    // Elimina el BOM y los espacios en blanco al principio y final de la línea
    $line = trim($line, "\xEF\xBB\xBF \t");

    // Omite los comentarios o líneas vacías
    if ($line === '' || $line[0] === '#' || $line[0] === ';') {
        continue;
    }

    // Si la línea empieza por "export ", lo elimina (es opcional)
    if (strpos($line, 'export ') === 0) {
        $line = substr($line, 7);
    }

    // Comprueba que la línea tenga un '=' para separar clave y valor
    if (!strpos($line, '=')) {
        continue;
    }

    // Separa el nombre de la variable y su valor
    list($name, $value) = explode('=', $line, 2);
    $name = trim($name);
    $value = trim($value);

    // Si el valor está entre comillas, las elimina
    if (
        (strlen($value) >= 2)
        && (
            ($value[0] === '"' && $value[-1] === '"')
            || ($value[0] === "'" && $value[-1] === "'")
        )
    ) {
        $quote = $value[0];
        $value = substr($value, 1, -1);
        if ($quote === '"') {
            // Si es una cadena con comillas dobles, interpreta secuencias de escape comunes
            $value = strtr($value, [
                '\n' => "\n",
                '\r' => "\r",
                '\t' => "\t",
                '\\"' => '"',
                '\\\'' => "'",
                '\\\\' => '\\',
            ]);
        }
    }
    // Establece la variable de entorno para PHP
    putenv("{$name}={$value}");
    $_ENV[$name] = $value;
    $_SERVER[$name] = $value;
}}}
