<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Eixo.php');

//entrada
$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$id_status = $reqbody-> idView;
$status = $reqbody-> status;

$conexao = new Conexao();
$banco = $conexao -> abrirConexao();

$m = new ModelEixo($banco);
$m -> statusEixo = $status;
$m -> eixo_id = $id_status;

$retorno = $m -> statusEixo();

echo json_encode($retorno);

?>
