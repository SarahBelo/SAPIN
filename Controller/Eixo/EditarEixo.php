<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Eixo.php');

//entrada
$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$id_eixo = $reqbody->idView;
$nome_eixo = $reqbody->nome;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();

$m = new ModelEixo($banco);
$m->id_eixo = $id_eixo;
$m->eixo = $nome_eixo;

$retorno = $m->editarEixos();

//saida
echo json_encode($retorno);

?>
