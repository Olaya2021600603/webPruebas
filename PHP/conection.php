<?php

function getDbConnection() {
    $servername = "bndd8c9fxucrhuvnnpxy-mysql.services.clever-cloud.com";
    $username = "u9ins6pqpla87i9w";
    $password = "an9jWnmzEbucBiymgvUH";
    $dbname = "bndd8c9fxucrhuvnnpxy";

    // Crear conexión
    $conection = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conection->connect_error) {
        die("Connection failed: " . $conection->connect_error);
    }

    return $conection;
}

// Uso de la función para obtener una conexión
$conection = getDbConnection();

/*
if($conection){
    echo 'Conectado a la BD';
}else{
    echo 'No se ha conectado a la BD';
}*/
?>
