<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Eixo.php');

// Entrada
$json = file_get_contents('php://input');
$reqBody = json_decode($json);
$eixo = $reqBody->eixo;

// Cria uma nova conexão com o banco de dados
$conexao = new Conexao();
$banco = $conexao->abrirConexao();

// Cria uma instância do modelo de usuário
$m = new ModelEixo($banco);
$m->eixo = $eixo;

// Tenta cadastrar o eixo
$retorno = $m->cadastrarEixo();

// Saída
echo json_encode($retorno);

?>