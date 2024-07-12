<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Coordenador.php');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$nome = $reqbody->nome;
$email = $reqbody->email;
$senha = $reqbody->senha;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();
$m = new ModelCoordenador($banco);
$m->nome = $nome;
$m->email = $email;
$m->senha = $senha;
$retorno = $m->CadastroCoordenador();

echo json_encode($retorno);
?>