<?php

require_once('../../Configuracao/Conexao.php');
require_once('../../Model/ProjetoProfessor.php');

header('Content-Type: application/json');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$id = $reqbody->id;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();
$m = new ModelProjetoProfessor($banco);
$m->id = $id;
$retorno = $m->visualizarProjetos();

echo json_encode($retorno);

?>
