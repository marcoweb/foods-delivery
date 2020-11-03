<?php

// function view_get() {
//     if (session_status() == PHP_SESSION_NONE) {
//         session_start();
//     }
//     $itens_pedido = (isset($_SESSION['itens_pedido'])) ? $_SESSION['itens_pedido'] : [];
//     return view(['itens_pedido' => $itens_pedido]);
// }

function additem_get($id) {
    loadFunctions('core/database');
    $produto = simpleSelect('produtos', ['id' => ['=', $id]]);
    return view(['produto', $produto]);
}