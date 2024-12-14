CREATE DATABASE IF NOT EXISTS buscador_articulos /* BASE DE DATOS */;

USE buscador_articulos;

/* TABLA DE CATEGORIAS */
CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(255) NOT NULL
);

/* TABLA DE ARTICULOS */
CREATE TABLE IF NOT EXISTS articulos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(255) NOT NULL,
    descripcion TEXT,
    fecha_publicacion DATE NOT NULL,
    precio DECIMAL (10,2) NOT NULL,
    id_categoria INT,
    FOREIGN KEY (id_categoria) REFERENCES categorias (id)
);