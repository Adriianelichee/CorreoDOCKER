-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS correos;

-- Usar la base de datos
USE correos;

-- Crear la tabla users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE
);

-- Insertar datos en la tabla users
INSERT INTO users (email) VALUES
('usuario1@example.com'),
('usuario2@example.com'),
('usuario3@example.com'),
('usuario4@example.com'),
('usuario5@example.com');
