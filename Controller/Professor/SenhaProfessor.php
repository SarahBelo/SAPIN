<?php
require_once ('../../Model/Senha.php');
require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Professor.php');

$fazSenha = new Senha();

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$email = $reqbody->email;
$primeiro_acesso = $fazSenha->password;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();
$m = new ModelProfessor($banco);
$m->email = $email;
$m->primeiro_acesso = $primeiro_acesso;
$retorno = $m->SenhaEsquecidaProfessor();

echo json_encode($retorno);
?>