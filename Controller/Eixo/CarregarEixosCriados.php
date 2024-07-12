<?php

require_once ('../../Configuracao/Conexao.php');
require_once('../../Model/Eixo.php');

$conexao = new Conexao();
$banco = $conexao->abrirConexao();

$m = new ModelEixo($banco);
$retorno = $m->carregarEixos();

echo json_encode($retorno);

?>
