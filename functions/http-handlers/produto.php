<?php
function list_get() {
    authorize(['admin']);
    loadFunctions('repositories/produtos');
    $produtos = selectProdutos();
    return view(['produtos' => $produtos]);
}

function insert_get() {
    authorize(['admin']);
    loadFunctions('core/database');
    $tipos_produto = simpleSelect('tipos_produto');
    return view(['tipos_produto' => $tipos_produto]);
}

function insert_post($nome, $preco, $id_tipo_produto) {
    authorize(['admin']);
    loadFunctions('core/database');
    if($nome != '' && $preco != '' && $id_tipo_produto != '') {
        simpleInsert('produtos', ['nome' => $nome, 'preco' => $preco,  'id_tipo_produto' => $id_tipo_produto]);
    }
    redirectTo('/produto/list');
}

function update_get($id) {
    authorize(['admin']);
    loadFunctions('core/database');
    $produto = simpleSelect('produtos', ['id' =>['=', $id]]);
    $tipos_produto = simpleSelect('tipos_produto');
    return view(['produto' => $produto[0], 'tipos_produto' => $tipos_produto]);
}

function update_post($id, $nome, $preco, $id_tipo_produto) {
    authorize(['admin']);
    loadFunctions('core/database');
    simpleUpdate('produtos', ['nome' => $nome, 'preco' => $preco, 'id_tipo_produto' => $id_tipo_produto], ['id' => $id]);
    redirectTo('/produto/list');
}

function delete_get($id) {
    authorize(['admin']);
    loadFunctions('core/database');
    $produto = simpleSelect('produtos', ['id' =>['=', $id]]);
    return view(['produto' => $produto[0]]);
}

function delete_post($id) {
    authorize(['admin']);
    loadFunctions('core/database');
    simpleDelete('produtos', ['id' => $id]);
    redirectTo('/produto/list');
}