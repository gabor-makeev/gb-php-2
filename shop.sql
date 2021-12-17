# Структура базы данных
DROP DATABASE IF EXISTS shop;
CREATE DATABASE shop;

use shop;

DROP TABLE IF EXISTS products;
CREATE TABLE products (
    id SERIAL PRIMARY KEY,
    name VARCHAR(150) NOT NULL UNIQUE,
    price INT UNSIGNED NOT NULL
) character set utf8;