<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Curso.php');

//entrada
$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$id_curso = $reqbody->idcurso;
$nome_curso = $reqbody->nomecurso;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();

$m = new ModelCurso($banco);
$m->id_curso = $id_curso;
$m->curso = $nome_curso;

$retorno = $m->editarCurso();

//saida
echo json_encode($retorno);

?>
