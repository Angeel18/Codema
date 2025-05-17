<?php
$apiKey = "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";
$data = [
    "model" => "llama-3.3-70b-versatile",
    "messages" => [
        ["role" => "user", "content" => "Solo responde correcto si el siguiente codigo cumple los requisitos y no dara fallos al ejecutar o falso en caso contrario:
        ENUNCIADO->Crea un método que sume dos números
        CODIGO->int suma(int a, int b) { return a + b; }
        Lenguaje->Java
        "]
    ]
];

$ch = curl_init("https://api.groq.com/openai/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $apiKey"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
curl_close($ch);

$datos = json_decode($response, true); // true = lo convierte en array asociativo

echo "<pre>";
// print_r($datos);
// echo $response["content"];
echo "</pre>";
echo $datos["choices"][0]["message"]["content"];
?>
