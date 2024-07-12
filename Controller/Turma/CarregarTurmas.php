<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Turma.php');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$id_curso = $reqbody->idCurso;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();

$modelTurma = new ModelTurma($banco);
$modelTurma->id_curso = $id_curso;
$retorno = $modelTurma->carregarTurmas();

echo json_encode($retorno);

?>