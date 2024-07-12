<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Turma.php');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$id_eixo = $reqbody->idEixo;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();

$modelTurma = new ModelTurma($banco);
$modelTurma->id_eixo = $id_eixo;
$retorno = $modelTurma->carregarCursos();

echo json_encode($retorno);

?>