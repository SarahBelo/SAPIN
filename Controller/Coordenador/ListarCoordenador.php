<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Coordenador.php');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);

$conexao = new Conexao();
$db = $conexao->abrirConexao();
$m = new ModelCoordenador($db);
$retorno = $m->listarCoordenador();

echo json_encode($retorno);
?>