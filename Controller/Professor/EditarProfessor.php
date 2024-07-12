<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Professor.php');

header('Content-Type: application/json');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$nome = $reqbody->nome;
$email = $reqbody->email;
$id = $reqbody->id;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();
$m = new ModelProfessor($banco);
$m->nome = $nome;
$m->email = $email;
$m->id = $id;
$retorno = $m->editarProfessor();

echo json_encode([
    'status' => $retorno['status'],
    'id' => $id,
    'dados' => $retorno['dados']
]);
?>
