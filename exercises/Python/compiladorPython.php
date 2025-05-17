<?php
header('Content-Type: text/plain; charset=utf-8');

$data = json_decode(file_get_contents('php://input'), true);
$codigo = trim($data['code'] ?? '');
$input = $data['input'] ?? '';

// Guardar el código en un archivo temporal
$archivo = "temp_script.py";
file_put_contents($archivo, $codigo);
chmod($archivo, 0644);

// Ejecutar el script Python
$descriptorspec = [
    0 => ["pipe", "r"],  // STDIN
    1 => ["pipe", "w"],  // STDOUT
    2 => ["pipe", "w"]   // STDERR
];

$process = proc_open("python3 $archivo", $descriptorspec, $pipes);

if (!is_resource($process)) {
    @unlink($archivo);
    die("Error: no se pudo iniciar Python");
}

fwrite($pipes[0], $input);
fclose($pipes[0]);

$output = stream_get_contents($pipes[1]);
$errors = stream_get_contents($pipes[2]);

fclose($pipes[1]);
fclose($pipes[2]);
proc_close($process);

@unlink($archivo);

echo $errors ? "Error:\n$errors" : $output;
?>
