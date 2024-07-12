<?php

session_start();
require_once('../../Configuracao/Conexao.php');
require_once('../../Model/Professor.php');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$login = $reqbody->login;
$senha = $reqbody->senha;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();
$m = new ModelProfessor($banco);
$m->email = $login;
$m->senha = $senha;
$retorno = $m->logar();

if ($retorno['status'] == 1) {
    $_SESSION['user_id'] = $retorno['dados']['id'];
    $response = [
        'status' => 1,
        'id' => $retorno['dados']['id'],
        'message' => 'Usuário logado'
    ];
} else {
    $response = [
        'status' => 0,
        'message' => 'Login invalido'
    ];

}

echo json_encode($response);


?>
