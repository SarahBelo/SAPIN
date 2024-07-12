<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Curso.php');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$id_eixo = $reqbody->idEixo;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();

$m = new ModelCurso($banco);
$m->id_eixo = $id_eixo;
$retorno = $m->carregarCursos();

echo json_encode($retorno);

?>