<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Professor.php');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$id = $reqbody->id;
$statusProfessor = $reqbody->statusProfessor;

$conexao = new Conexao();
$db = $conexao->abrirConexao();
$m = new ModelProfessor($db);
$m->id = $id;
$m->statusProfessor = $statusProfessor;
$retorno = $m->statusProfessor();

echo json_encode($retorno);
?>