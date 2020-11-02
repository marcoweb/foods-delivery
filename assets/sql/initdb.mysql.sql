INSERT INTO users(id, email, password) VALUES (1, 'admin@application.com', SHA2('admin', 256));
INSERT INTO users(id, email, password) VALUES (2, 'user@application.com', SHA2('user', 256));
INSERT INTO roles(id, name) VALUES (1, 'admin');
INSERT INTO roles(id, name) VALUES (2, 'user');
INSERT INTO users_has_roles(id_user, id_role) VALUES (1,1);
INSERT INTO users_has_roles(id_user, id_role) VALUES (1,2);
INSERT INTO users_has_roles(id_user, id_role) VALUES (2,2);

/* Foods Delivery */
INSERT INTO tipos_produto(id, nome, nome_pural) VALUES
    (1, 'Lanche', 'Lanches'),
    (2, 'Bebida', 'Bebidas'),
    (3, 'Porção', 'Porções');

INSERT INTO produtos (id, nome, preco, id_tipo_produto) VALUES
    (1, 'X-Tudo', '12.00', 1),
    (2, 'X-Bacon', '11.00', 1),
    (3, 'X-Salada', '10.00', 1),
    (4, 'Hot Dog', '10.00', 1),
    (5, 'Triplo X', '14.00', 1),
    (6, 'Big do Dia', '14.00', 1),
    (7, 'Coca-Cola - 600ml', '7.00', 2),
    (8, 'Guaraná Antartica - Lata', '5.00', 2),
    (9, 'Fanta Laranja - Lata', '5.00', 2);