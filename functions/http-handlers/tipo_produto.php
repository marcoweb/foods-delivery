<?php
function list_get() {
    authorize(['admin']);
    loadFunctions('core/database');
    $tipos_produto = simpleSelect('tipos_produto');
    return view(['tipos_produto' => $tipos_produto]);
}

function insert_get() {
    return view();
}

function insert_post($nome, $nome_plural) {
    authorize(['admin']);
    loadFunctions('core/database');
    if($nome != '' && $nome_plural != '') {
        simpleInsert('tipos_produto', ['nome' => $nome, 'nome_plural' => $nome_plural]);
    }
    redirectTo('/tipo_produto/list');
}

function update_get($id) {
    authorize(['admin']);
    loadFunctions('core/database');
    $tipo_produto = simpleSelect('tipos_produto', ['id' => ['=', $id]]);
    return view(['tipo_produto' => $tipo_produto[0]]);
}

function update_post($id, $nome, $nome_plural) {
    authorize(['admin']);
    loadFunctions('core/database');
    simpleUpdate('tipos_produto', ['nome' => $nome, 'nome_plural' => $nome_plural], ['id' => $id]);
    redirectTo('/tipo_produto/list');
}

function delete_get($id) {
    authorize(['admin']);
    loadFunctions('core/database');
    $tipo_produto = simpleSelect('tipos_produto', ['id' => ['=', $id]]);
    return view(['tipo_produto' => $tipo_produto[0]]);
}

function delete_post($id) {
    authorize(['admin']);
    loadFunctions('core/database');
    simpleDelete('tipos_produto', ['id' => $id]);
    redirectTo('/tipo_produto/list');
}