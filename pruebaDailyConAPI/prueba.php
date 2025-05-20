<?php
$apiKey = "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";
$data = json_decode(file_get_contents('php://input'), true);  // Usar 'php://input' para obtener el body del request

$code = $data['code'] ?? '';
$description = $data['description'] ?? '';
$Language = $data['Language'] ?? '';

$dataToSend = [
    "model" => "llama-3.3-70b-versatile",
    "messages" => [
        ["role" => "user", "content" => "You can only say RIGHT or WRONG, nothing else, be completely restrictive, say RIGHT if the exercise is right or WRONG if it is not, take into account the description of the exercise and the Language it has to be coded in\nDescription-> $description\nLanguage-> $Language\nCode-> $code"]
    ]
];

$ch = curl_init("https://api.groq.com/openai/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $apiKey"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataToSend));

$response = curl_exec($ch);
curl_close($ch);

if (!$response) {
    echo json_encode(["error" => "Request to API failed."]);
    exit();
}

$datos = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(["error" => "Error decoding API response"]);
    exit();
}

// Asumir que la respuesta de la API tiene el formato esperado
$check = $datos["choices"][0]["message"]["content"];

header('Content-Type: application/json');  // Asegurarse de que la respuesta esté en formato JSON
echo json_encode($check);
?>
