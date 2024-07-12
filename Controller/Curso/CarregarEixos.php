<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Curso.php');

$conexao = new Conexao();
$banco = $conexao->abrirConexao();

$m = new ModelCurso($banco);
$retorno = $m->carregarEixos();

echo json_encode($retorno);

?>