DROP DATABASE IF EXISTS products_db;
CREATE DATABASE IF NOT EXISTS products_db;
USE products_db;

DROP TABLE IF EXISTS product;
CREATE TABLE product(
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    brand VARCHAR(255) NOT NULL,
    price DOUBLE NOT NULL,
    stock INT NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO product(name, brand, price, stock) VALUES('polo', 'polos', 1.0, 1);
INSERT INTO product(name, brand, price, stock) VALUES('zapatilla', 'zapatilla', 1.0, 1);
INSERT INTO product(name, brand, price, stock) VALUES('casaca', 'casaca', 1.0, 1);
INSERT INTO product(name, brand, price, stock) VALUES('zapato', 'zapato', 1.0, 1);