<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Turma.php');

$conexao = new Conexao();
$banco = $conexao->abrirConexao();

$m = new ModelTurma($banco);
$retorno = $m->carregarEixos();

echo json_encode($retorno);

?>