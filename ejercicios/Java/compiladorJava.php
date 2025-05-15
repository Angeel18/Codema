<?php
header('Content-Type: text/plain; charset=utf-8');

$data = json_decode(file_get_contents('php://input'), true);
$codigo = trim($data['code'] ?? '');
$input = $data['input'] ?? '';

// Extraer nombre de clase principal pública
if (!preg_match('/public\s+class\s+(\w+)/', $codigo, $matches)) {
    die("Error: El código debe contener una clase pública con nombre válido");
}

$className = $matches[1];
$javaFile = "$className.java";
$classFile = "$className.class";

// Guardar el archivo Java
file_put_contents($javaFile, $codigo);
chmod($javaFile, 0644);

// Compilar el archivo
$compilacion = shell_exec("javac -encoding UTF-8 $javaFile 2>&1");

if ($compilacion) {
    @unlink($javaFile);
    die("Errores de compilación:\n" . $compilacion);
}

// Ejecutar el programa Java con entrada del usuario
$descriptorspec = [
    0 => ["pipe", "r"],  // STDIN
    1 => ["pipe", "w"],  // STDOUT
    2 => ["pipe", "w"]   // STDERR
];

$process = proc_open("java -cp . $className", $descriptorspec, $pipes);

if (!is_resource($process)) {
    @unlink($javaFile);
    @unlink($classFile);
    die("Error: No se pudo iniciar la JVM");
}

// Enviar entrada del usuario al programa
fwrite($pipes[0], $input);
fclose($pipes[0]);

// Capturar salida y errores
$output = stream_get_contents($pipes[1]);
$errors = stream_get_contents($pipes[2]);

fclose($pipes[1]);
fclose($pipes[2]);
proc_close($process);

// Eliminar archivos generados
if (file_exists($javaFile)) @unlink($javaFile);
if (file_exists($classFile)) @unlink($classFile);

echo $errors ? "Error:\n$errors" : $output;
?>
