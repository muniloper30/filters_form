<?php
require('includes/conexion.php');
require('includes/funciones.php');

$mostrar_articulos = false;


// Verificar si el botón "Mostrar todos" fue presionado
if (isset($_POST['mostrar_todos'])) {
    $mostrar_articulos = true; // Activamos la bandera para mostrar los artículos
}

// Verificar si el botón "Limpiar" fue presionado
if (isset($_POST['limpiar'])) {
    $mostrar_articulos = false; // Desactivamos la bandera para limpiar la lista
}
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de artículos</title>
    <!-- Bootswatch Theme (Darkly) -->
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/darkly/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">
    <header class="bg-primary text-white text-center py-4">
        <h1><a class="text-white text-decoration-none" href="index.php">Buscador de Artículos</a></h1>
    </header>
    
    <main id="container-main" class="container my-5">
        <h3 class="text-light">Buscador</h3>

        <form method="POST" class="card p-4 shadow-lg bg-dark text-white">
            <!-- Búsqueda por nombre (palabra clave) -->
            <div class="mb-3">
                <label for="nombre" class="form-label text-white">Buscar por nombre</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" id="nombre" name="nombre" placeholder="Escribe un nombre">
            </div>

            <!-- Filtro por categoría -->
            <div class="mb-3">
                <label for="categoria" class="form-label text-white">Categoría</label>
                <select name="categoria" id="categoria" class="form-select bg-dark text-white border-secondary">
                    <option value="0">Selecciona una categoría</option>
                    <option value="Laptops">Laptops</option>
                    <option value="Smartphones">Smartphones</option>
                    <option value="Tablets">Tablets</option>
                    <option value="Accesorios">Accesorios</option>
                    <option value="Cámaras">Cámaras</option>
                    <option value="Audio">Audio</option>
                    <option value="Monitores">Monitores</option>
                    <option value="Impresoras">Impresoras</option>
                    <option value="Componentes">Componentes</option>
                    <option value="Electrodomésticos">Electrodomésticos</option>
                </select>
            </div>

            <!-- Filtro por precio -->
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="precioDesde" class="form-label text-white">Precio desde:</label>
                    <input type="number" id="precioDesde" name="precioDesde" class="form-control bg-dark text-white border-secondary" min="0" step="0.01" placeholder="Introduce una cantidad">
                </div>
                <div class="col-md-6">
                    <label for="precioHasta" class="form-label text-white">Precio hasta:</label>
                    <input type="number" id="precioHasta" name="precioHasta" class="form-control bg-dark text-white border-secondary" min="0" step="0.01" placeholder="Introduce una cantidad">
                </div>
            </div>

            <!-- Filtro por fecha -->
            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <label for="fechaDesde" class="form-label text-white">Fecha desde:</label>
                    <input type="date" id="fechaDesde" name="fechaDesde" class="form-control bg-dark text-white border-secondary">
                </div>
                <div class="col-md-6">
                    <label for="fechaHasta" class="form-label text-white">Fecha hasta:</label>
                    <input type="date" id="fechaHasta" name="fechaHasta" class="form-control bg-dark text-white border-secondary">
                </div>
            </div>


            <!-- Botones de búsqueda -->
            <div class="d-flex justify-content-between mt-4">
                <button type="submit" name="buscar" id="btnBuscar" class="btn btn-success">Buscar</button>
                <button type="submit" name="limpiar" id="btnLimpiar" class="btn btn-warning">Limpiar</button>
                <button type="submit" name="mostrar_todos" class="btn btn-primary">Mostrar todos</button>
            </div>
        </form>

        <h3 class="text-light mt-4">Resultados</h3>
        <div id="resultados" class="bg-dark p-4 border rounded shadow-lg">
            <?php
            if ($mostrar_articulos === true) {
                mostrarArticulos($conexion); // Mostrar todos los articulos
            } elseif (isset($_POST['buscar'])) {
                buscarArticulosConFiltros($conexion);
            }
            ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
