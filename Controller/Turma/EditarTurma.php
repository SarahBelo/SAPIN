<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Turma.php');

// entrada
$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$id_turma = $reqbody->id;
$nome_turma = $reqbody->nomenclatura;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();

$m = new ModelTurma($banco);
$m->id_turma = $id_turma;
$m->turma = $nome_turma;

$retorno = $m->editarTurma();

// saida
echo json_encode($retorno);

?>
