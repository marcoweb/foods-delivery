CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(322) NOT NULL UNIQUE,
    password VARCHAR(255)
);

CREATE TABLE roles(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE users_has_roles(
    id_user INT NOT NULL,
    id_role INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (id_role) REFERENCES roles(id) ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_role)
);

CREATE TABLE tokens(
    id INT AUTO_INCREMENT PRIMARY KEY,
    token TEXT NOT NULL,
    id_user INT NOT NULL,
    generation_date DATETIME NOT NULL,
    expiration_date DATETIME NOT NULL,
    revoked BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE
);

/* Foods Delivery */

CREATE TABLE tipos_produto(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE,
    nome_plural VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE produtos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    id_tipo_produto INT NOT NULL,
    FOREIGN KEY (id_tipo_produto) REFERENCES tipos_produto(id) ON DELETE CASCADE
);