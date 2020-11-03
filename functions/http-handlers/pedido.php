<?php
const TO_EMAIL = 'xxxxx@xxxx.com';
function view_get() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $itens_pedido = (isset($_SESSION['itens_pedido'])) ? $_SESSION['itens_pedido'] : [];
    return view(['itens_pedido' => $itens_pedido]);
}

function additem_get($id) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    loadFunctions('core/database');
    $produto = simpleSelect('produtos', ['id' => ['=', $id]]);
    $produto[0]['quantidade'] = 1;
    $_SESSION['itens_pedido'][] = $produto[0];
    redirectTo('/pedido/view');
}

function removeitem_get($id_item_pedido) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    array_splice($_SESSION['itens_pedido'], $id_item_pedido, 1);
    redirectTo('/pedido/view');
}

function update_post() {
    global $_requestInfo;
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    foreach($_requestInfo['params'] as $n => $v) {
        $name_segments = explode('__', $n);
        if($name_segments[0] == 'prod_qtd') {
            $_SESSION['itens_pedido'][$name_segments[1]]['quantidade'] = $v;
        }
    }
    redirectTo('/pedido/view');
}

function fechar_get() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $msg_pedido = '';
    $toral = 0;
    foreach($_SESSION['itens_pedido'] as $i) {
        $msg_pedido .= str_pad($i['quantidade'], 4, '0', STR_PAD_LEFT) . ' ';
        $msg_pedido .= str_pad(substr($i['nome'], 0, 39), 39, ' ', STR_PAD_RIGHT) . ' ';
        $msg_pedido .= 'R$ ' . str_pad(number_format($i['preco'], 2, ',', '.'), 7, ' ', STR_PAD_LEFT) . ' ';
        $subtotal = $i['quantidade'] * $i['preco'];
        $toral += $subtotal;
        $msg_pedido .= 'R$ ' . str_pad(number_format($subtotal, 2, ',', '.'), 11, ' ', STR_PAD_LEFT);
        $msg_pedido .="\n";
    }
    return view(['pedido' => $msg_pedido]);
}

function enviar_post($cliente, $email, $endereco, $telefone, $pedido, $observacoes) {
    $msg = "[ Cliente ]\n";
    $msg .= 'Nome: ' . $cliente . "\n";
    $msg .= 'E-Mail: ' . $email . "\n";
    $msg .= 'Telefone: ' . $telefone . "\n";
    $msg .= 'Endereço: ' . $endereco . "\n\n";
    $msg .= "[ Pedido ]\n";
    $msg .= $pedido;
    $msg .= "\n[ Informações Adicionais ]\n";
    $msg .= $observacoes;
    mail(TO_EMAIL, 'Pedido - ' . $cliente, $msg);
    return view(['msg' => $msg]);
}