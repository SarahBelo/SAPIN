<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Professor.php');

header('Content-Type: application/json');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$id = $reqbody->id;

$conexao = new Conexao();
$db = $conexao->abrirConexao();
$m = new ModelProfessor($db);
$m->id = $id;
$retorno = $m->listarIDProfessor();

echo json_encode($retorno);
?>