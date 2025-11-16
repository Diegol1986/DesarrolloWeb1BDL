CREATE DATABASE IF NOT EXISTS appdewebdl CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE appdewebdl;


CREATE TABLE IF NOT EXISTS USUARIOS (
id INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL,
apellido VARCHAR(100) DEFAULT '',
correo VARCHAR(255) NOT NULL UNIQUE,
estado ENUM('PENDIENTE','ACTIVO','INACTIVO') DEFAULT 'PENDIENTE',
fecha_de_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
perfil ENUM('ADMIN','USUARIO') DEFAULT 'USUARIO',
contrasena VARCHAR(255) NOT NULL
);


-- Usuario administrador por defecto (correo: admin@local, contraseña: Admin123! )
INSERT INTO USUARIOS (nombre, apellido, correo, estado, perfil, contrasena)
VALUES ('Admin','Sistema','admin@local','ACTIVO','ADMIN',
-- reemplazar hash por el generado en PHP o usar este placeholder y actualizar
'$2y$10$e0NRG9X1F5KqWq0wq2sI9uY3e9Df6qZBz3Mj3vE6uO/2fZkl8Q9qG' );