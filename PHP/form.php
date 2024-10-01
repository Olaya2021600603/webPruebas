<?php
// Incluir el archivo de conexión
include 'conection.php';

// Obtener la conexión a la base de datos
$conn = getDbConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $telefono = $_POST['tel'];

    // Verificar si el campo nombre está vacío antes de continuar
    if (empty($nombre)) {
        echo "El campo nombre no puede estar vacío";
        exit; // Terminar el script si no se proporciona el nombre
    }

    // Preparar consulta SQL para insertar datos (proteger contra inyección SQL)
    $sql = "INSERT INTO newsletter (nombre, correo, telefono) VALUES (?, ?, ?)";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);

    // Vincular parámetros y ejecutar la consulta
    $stmt->bind_param("sss", $nombre, $email, $telefono);

    if ($stmt->execute()) {
        echo '
        <script>
            alert("Inscrito correctamente");
            window.history.back();
        </script>
    ';
    } else {
        echo '
        <script>
            alert("Error, intenta nuevamente");
            window.history.back();
        </script>
    ';
    }

    // Cerrar la declaración
    $stmt->close();
}