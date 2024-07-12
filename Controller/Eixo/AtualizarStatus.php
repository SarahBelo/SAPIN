<?php

require_once ('../../Configuracao/Conexao.php');
require_once('../../Model/Eixo.php');

$conexao = new Conexao();
$banco = $conexao->abrirConexao();
$id_eixo = $reqbody->idView;
$status_eixo = $reqBody ->status;

$m = new ModelEixo($banco);
$m->eixo_id = $id_eixo;
$m->statusEixo = $status_eixo;

$retorno = $m->atualizarStatus();

echo json_encode($retorno);

?>