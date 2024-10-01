<?php
session_start();
include 'conection.php';

// Obtener y sanitizar datos de entrada
$correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
$contrasena = $_POST['contrasena'];

// Preparar la consulta
$query = "SELECT * FROM registros WHERE correo = ?";
$stmt = $conection->prepare($query);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verificar la contraseña
    if (password_verify($contrasena, $row['contrasena'])) {
        // Contraseña correcta, establecer la sesión
        $_SESSION['user'] = [
            'id' => $row['id'],
            'usuario' => $row['usuario'],
            'nombre' => $row['nombre'],
            'correo' => $row['correo']
        ];

        // Actualizar el archivo JSON
        $filePath = '../JSON/data.json';  // Ajusta la ruta según tu estructura de archivos
        $data = [
            'isLoggedIn' => true,
            'user' => $row['usuario'], // Opcional: puedes almacenar el nombre de usuario
            'name' => $row['nombre'],
            'email' => $row['correo']
        ];

        file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));
        echo '
        <script>
            alert("Sesión iniciada correctamente");
            window.history.back();
        </script>
        ';
        exit;
    } else {
        // Contraseña incorrecta
        echo '
            <script>
                alert("Contraseña incorrecta");
                window.history.back();
            </script>
        ';
        exit;
    }
} else {
    // Usuario no encontrado
    echo '
        <script>
            alert("Usuario no encontrado");
            window.history.back();
        </script>
    ';
    exit;
}
?>
