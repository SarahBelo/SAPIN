<?php

require_once('../../Configuracao/Conexao.php');
require_once('../../Model/Perfil.php');

header('Content-Type: application/json');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$nome = $reqbody->nome;
$email = $reqbody->email;
$senha = $reqbody->senha;
$id = $reqbody->id;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();
$m = new ModelPerfil($banco);
$m->nome = $nome;
$m->email = $email;
$m->senha = $senha;
$m->id = $id;
$retorno = $m->editarCoordenador();

echo json_encode($retorno);

?>
