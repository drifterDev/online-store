/* Autor: Mateo Álvarez Murillo
 Fecha de creación: 2023
 Este código se proporciona bajo la Licencia MIT.
 Para más información, consulta el archivo LICENSE en la raíz del repositorio. */

CREATE DATABASE nombre_de_la_base_de_datos;

USE nombre_de_la_base_de_datos;

SET NAMES utf8mb4;

CREATE TABLE
    usuarios(
        id INT(255) NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(100) NOT NULL,
        apellidos VARCHAR(255),
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        rol VARCHAR(20),
        imagen VARCHAR(255),
        CONSTRAINT pk_usuarios PRIMARY KEY(id),
        CONSTRAINT uk_usuarios_email UNIQUE(email)
    ) Engine = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE
    categorias(
        id INT(255) NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(100) NOT NULL,
        CONSTRAINT pk_categorias PRIMARY KEY(id)
    ) Engine = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE
    productos(
        id INT(255) NOT NULL AUTO_INCREMENT,
        categoria_id INT(255) NOT NULL,
        nombre VARCHAR(100) NOT NULL,
        descripcion TEXT,
        precio FLOAT(100, 2) NOT NULL,
        stock INT(255) NOT NULL,
        oferta VARCHAR(2),
        fecha DATE NOT NULL,
        imagen VARCHAR(255),
        CONSTRAINT pk_productos PRIMARY KEY(id),
        CONSTRAINT fk_productos_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) Engine = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE
    pedidos(
        id INT(255) NOT NULL AUTO_INCREMENT,
        usuario_id INT(255) NOT NULL,
        departamento VARCHAR(255) NOT NULL,
        ciudad VARCHAR(255) NOT NULL,
        direccion VARCHAR(255) NOT NULL,
        coste FLOAT(200, 2) NOT NULL,
        estado VARCHAR(20) NOT NULL,
        fecha DATE NOT NULL,
        hora TIME NOT NULL,
        CONSTRAINT pk_pedidos PRIMARY KEY(id),
        CONSTRAINT fk_pedidos_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) Engine = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE
    pedidos_has_productos(
        id INT(255) NOT NULL AUTO_INCREMENT,
        pedido_id INT(255) NOT NULL,
        producto_id INT(255) NOT NULL,
        unidades INT(255) NOT NULL,
        CONSTRAINT pk_pedidos_has_productos PRIMARY KEY(id),
        CONSTRAINT fk_pedidos_has_productos_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT fk_pedidos_has_productos_producto FOREIGN KEY(producto_id) REFERENCES productos(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) Engine = InnoDB DEFAULT CHARSET = utf8mb4;

/* Despues de crear al primer usuario ejecutar el siguiente codigo para darle el rol de administrador */

UPDATE usuarios
SET rol = 'admin'
WHERE id = (
        SELECT id
        FROM usuarios
        LIMIT 1
    );