<?php
session_start();

// Verificar la sesión de PHP
$sessionActive = isset($_SESSION['user']);

// Verificar el archivo JSON
$filePath = '../JSON/data.json';
$data = json_decode(file_get_contents($filePath), true);
$jsonSessionActive = $data['isLoggedIn'];

$response = [
    'sessionActive' => $sessionActive && $jsonSessionActive
];

// Devolver la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
