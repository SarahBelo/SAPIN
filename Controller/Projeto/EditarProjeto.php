<?php

require_once('../../Configuracao/Conexao.php');
require_once('../../Model/ProjetoProfessor.php');

header('Content-Type: application/json');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$eixo = $reqbody->eixo;
$curso = $reqbody->curso;
$turma = $reqbody->turma;
$titulo = $reqbody->titulo;
$participantes = $reqbody->participantes;
$publico = $reqbody->publico;
$introducao = $reqbody->introducao;
$id = $reqbody->id;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();
$m = new ModelProjetoProfessor($banco);
$m->eixo = $eixo;
$m->curso = $curso;
$m->turma = $turma;
$m->titulo = $titulo;
$m->participantes = $participantes;
$m->publico = $publico;
$m->introducao = $introducao;
$m->id = $id;
$retorno = $m->editarProjeto();

echo json_encode($retorno);

?>
