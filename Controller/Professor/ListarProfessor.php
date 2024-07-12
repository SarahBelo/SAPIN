<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Professor.php');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);

$conexao = new Conexao();
$db = $conexao->abrirConexao();
$m = new ModelProfessor($db);
$retorno = $m->listarProfessor();

echo json_encode($retorno);
?>