<?php

require_once('../../Configuracao/Conexao.php');
require_once('../../Model/ProjetoProfessor.php');

header('Content-Type: application/json');

$conexao = new Conexao();
$banco = $conexao->abrirConexao();
$m = new ModelProjetoProfessor($banco);
$retorno = $m->listarTodos();
echo json_encode($retorno);

?>
