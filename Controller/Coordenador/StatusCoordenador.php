<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Coordenador.php');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$id = $reqbody->id;
$statusCoordenador = $reqbody->statusCoordenador;

$conexao = new Conexao();
$db = $conexao->abrirConexao();
$m = new ModelCoordenador($db);
$m->id = $id;
$m->statusCoordenador = $statusCoordenador;
$retorno = $m->statusCoordenador();

echo json_encode($retorno);
?>