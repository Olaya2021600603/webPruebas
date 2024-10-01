<?php

include 'conection.php';

$conection = getDbConnection();

// Obtener y sanitizar datos de entrada
$nombre_completo = filter_input(INPUT_POST, 'nombre_completo', FILTER_SANITIZE_STRING);
$correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$contrasena = $_POST['contrasena']; // No sanitizamos porque vamos a hashear

// Verificar si el correo ya está registrado
$query_check_email = "SELECT * FROM registros WHERE correo = ?";
$stmt_check_email = $conection->prepare($query_check_email);
$stmt_check_email->bind_param("s", $correo);
$stmt_check_email->execute();
$result_check_email = $stmt_check_email->get_result();

if ($result_check_email->num_rows > 0) {
    echo '
        <script>
            alert("Este correo ya está registrado");
            window.history.back();
        </script>
    ';
    $stmt_check_email->close();
    $conection->close();
    exit();
}

// Hash de la contraseña
$hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

// Preparar la consulta de inserción
$query_insert = "INSERT INTO registros (nombre, correo, usuario, contrasena) VALUES (?, ?, ?, ?)";
$stmt_insert = $conection->prepare($query_insert);
$stmt_insert->bind_param("ssss", $nombre_completo, $correo, $usuario, $hashed_password);

if ($stmt_insert->execute()) {
    echo '
        <script>
            alert("Usuario registrado correctamente");
            window.history.back();
        </script>
    ';
} else {
    echo '
        <script>
            alert("Intenta nuevamente");
            window.history.back();
        </script>
    ';
}

$stmt_insert->close();
$conection->close();

?>
