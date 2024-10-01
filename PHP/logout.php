<?php
session_start();

// Destruir la sesión de PHP
session_unset();
session_destroy();

// Ruta del archivo JSON
$filePath = '../JSON/data.json';

// Leer el contenido del archivo JSON
$data = json_decode(file_get_contents($filePath), true);

// Actualizar el estado de sesión en el archivo JSON
$data['isLoggedIn'] = false;
$data['user'] = '';
$data['name'] = '';
$data['email'] = '';

// Guardar los cambios en el archivo JSON
file_put_contents($filePath, json_encode($data));

// Enviar respuesta de éxito
echo json_encode(['success' => true]);
?>
