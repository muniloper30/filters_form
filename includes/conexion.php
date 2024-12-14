<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "buscador_articulos";
$archivoSQL = __DIR__ . "/../sql/esquema.sql"; // Ruta relativa desde 'conexion.php'

// Crear conexión
$conexion = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error); // Terminar la ejecución del script
}

// Leer el contenido del archivo SQL
if (file_exists($archivoSQL)) {
    $sql = file_get_contents($archivoSQL);
    if ($sql === false) {
        die("Error al leer el archivo $archivoSQL"); // Terminar la ejecución del script
    }
} else {
    die("El archivo $archivoSQL no existe"); // Terminar la ejecución del script
}

// Ejecutar las sentencias SQL
//if ($conexion->multi_query($sql) === TRUE) {
   // echo "Base de datos y tablas creadas correctamente";
//} else {
 //   echo "Error al ejecutar las sentencias SQL: " . $conexion->error;
// }



?>
