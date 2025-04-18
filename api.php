<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$authHeader = "Authorization: Bearer ciisa";
$url = "";

if (!isset($_GET['endpoint'])) {
    http_response_code(400);
    echo json_encode(["error" => "No se especificó endpoint"]);
    exit;
}

if ($_GET['endpoint'] === 'services') {
    $url = "https://ciisa.coningenio.cl/v1/services/";
} elseif ($_GET['endpoint'] === 'about-us') {
    $url = "https://ciisa.coningenio.cl/v1/about-us/";
} else {
    http_response_code(400);
    echo json_encode(["error" => "Endpoint no válido"]);
    exit;
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [$authHeader]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // por si hay problema con SSL

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    echo json_encode([
        "error" => "Error en CURL",
        "message" => curl_error($ch)
    ]);
    curl_close($ch);
    exit;
}

curl_close($ch);

http_response_code($httpcode);
echo $response;
