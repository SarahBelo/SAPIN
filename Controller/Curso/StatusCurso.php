<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Curso.php');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$id = $reqbody->idView;
$status = $reqbody->status;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();

$m = new ModelCurso($banco);
$m->id_curso = $id;
$m->status = $status;

$retorno = $m->statusCurso();

echo json_encode($retorno);

?>