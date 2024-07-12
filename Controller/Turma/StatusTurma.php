<?php

require_once('../../Configuracao/Conexao.php');
require_once('../../Model/Turma.php');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$id = $reqbody->idView;
$status = $reqbody->status;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();

$modelTurma = new ModelTurma($banco);
$modelTurma->id_turma = $id;
$modelTurma->status = $status;

$retorno = $modelTurma->statusTurma();

echo json_encode($retorno);

?>