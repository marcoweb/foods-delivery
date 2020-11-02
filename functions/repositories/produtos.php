<?php
loadFunctions('core/database');

function selectProdutos() {
    $command = getDbConnection()->prepare('SELECT p.id, p.nome, p.preco, p.id_tipo_produto, tp.nome AS tipo, tp.nome_plural AS tipo_plural FROM produtos AS p LEFT JOIN tipos_produto AS tp ON p.id_tipo_produto = tp.id ORDER BY p.id_tipo_produto');
    $command->execute();
    return $command->fetchAll(PDO::FETCH_ASSOC);
}