<?php

require('includes/conexion.php');
//Función para mostrar todos los artículos
function mostrarArticulos($conexion)
{
    //Consulta para obtener todos los artículos de la base de datos
    $sql = "SELECT 
    a.id AS articulo_id, 
    a.nombre AS articulo_nombre, 
    a.descripcion, 
    a.fecha_publicacion, 
    a.precio, 
    c.id AS categoria_id, 
    c.nombre AS categoria_nombre 
FROM articulos a
JOIN categorias c ON a.id_categoria = c.id";


    $resultado = $conexion->query($sql);

    //VERIFICACIÓN DE RESULTADOS

    if ($resultado->num_rows > 0) {

        //CONVERTIR LOS RESULTADOS EN UN ARRAY COMPLETO
        $articulos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $articulos[] = $fila;
        }

        //Crear una tabla para mostrar los resultados

        echo "<table border='1' cellspacing='0' cellpadding='10'";
        echo "<tr>
                <th>ID</th>
                <th>Nombre</th> 
                <th>Descripción</th> 
                <th>Categoría</th>
                <th>Fecha de publicación</th> 
                <th>Precio</th>      
                </tr>";


        //Recorrer los resultados y mostrarlos en la tabla
        foreach ($articulos as $articulo) {
            echo "<tr>
                <td>" . $articulo['articulo_id'] . "</td>
                <td>" . $articulo['articulo_nombre'] . "</td>
                <td>" . $articulo['descripcion'] . "</td>
                <td>" . $articulo['categoria_nombre'] . "</td>
                <td>" . $articulo['fecha_publicacion'] . "</td>
                <td>" . $articulo['precio'] . "</td>
            
            </tr>";
        }

        echo "</table>";
    } else {
        //si no hay resultados
        echo "No se encontraron artículos"; //SI no se encuentras filas en la query realizada , mandará el siguiente mensaje
    }
}

// Función para obtener los artículos según los filtros seleccionados(se pueden usar todos los filtros o seleccionar solo los que se deseen.)
function buscarArticulosConFiltros($conexion)
{

    // Obtener los valores del formulario
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
    $precioDesde = isset($_POST['precioDesde']) ? $_POST['precioDesde'] : '';
    $precioHasta = isset($_POST['precioHasta']) ? $_POST['precioHasta'] : '';
    $fechaDesde = isset($_POST['fechaDesde']) ? $_POST['fechaDesde'] : '';
    $fechaHasta = isset($_POST['fechaHasta']) ? $_POST['fechaHasta'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';

    
// Verificar si no hay filtros vacios
if (empty($categoria) && empty($precioDesde) && empty($precioHasta) && empty($fechaDesde) && empty($fechaHasta) && empty($nombre)) {
    echo "<p class='text-danger'>Por favor, ingrese al menos un campo para realizar la búsqueda.</p>";
    return;
}

    // Iniciar la consulta SQL
    $sql = "SELECT 
        a.id AS articulo_id,
        a.nombre AS articulo_nombre,
        a.descripcion,
        a.fecha_publicacion,
        a.precio,
        c.id AS categoria_id,
        c.nombre AS categoria_nombre
            FROM articulos a
            JOIN categorias c ON a.id_categoria = c.id";

    // Agregar condiciones a la consulta para establecer filtros en la búsqueda deseados
    if ($nombre != '') {
        // Si hay un valor en el campo 'nombre', buscar por nombre (con LIKE para búsqueda parcial)
        $nombre = $conexion->real_escape_string($nombre); // Prevenir inyecciones SQL
        $sql .= " AND a.nombre LIKE '%$nombre%'";
    }

    if ($categoria != '' && $categoria != '0') {
        $sql .= " AND c.nombre = '$categoria'"; //Búsqueda por categoría
    }
    if ($precioDesde != '') {
        $sql .= " AND a.precio >= '$precioDesde'"; //Búsqueda por rango de precio mínimo
    }
    if ($precioHasta != '') {
        $sql .= " AND a.precio <= '$precioHasta'"; //Búsqueda por rango de precio máximo
    }
    if ($fechaDesde != '') {
        $sql .= " AND a.fecha_publicacion >= '$fechaDesde'"; //Búsqueda por rango de fecha desde
    }
    if ($fechaHasta != '') {
        $sql .= " AND a.fecha_publicacion <= '$fechaHasta'"; //Búsqueda por rango de fecha hasta
    }

    // Ejecutar la consulta
    $resultado = $conexion->query($sql);

    // Comprobar si se han encontrado resultados
    if ($resultado && $resultado->num_rows > 0) {
        // Mostrar resultados
        echo "<table border='1' cellspacing='0' cellpadding='10'>";
        echo "<tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Categoria</th>
              <th>Fecha de publicación</th>
              <th>Precio</th></tr>";
              //Recuperar y colocar los resultados según los filtros
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>
            <td>" . $row['articulo_id'] . "</td>
            <td>" . $row['articulo_nombre'] . "</td>
            <td>" . $row['descripcion'] . "</td>
            <td>" . $row['categoria_nombre'] . "</td>
            <td>" . $row['fecha_publicacion'] . "</td>
            <td>" . $row['precio'] . "</td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='text-warning'>No se encontraron artículos con los filtros seleccionados</p>";
    }
}
