Tienes que ejecutar esta sentencia para crear la tabla en la base de datos y que funcione

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    rol VARCHAR(50) NOT NULL,
    fecha_alta DATE NOT NULL,
    avatar VARCHAR(255) DEFAULT NULL
);
