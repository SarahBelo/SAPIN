<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Curso.php');

// Entrada
$reqBody = json_decode(file_get_contents('php://input'), true);
$curso = $reqBody['curso'] ?? null;
$idEixo = $reqBody['id_eixo'] ?? null;

// Cria uma nova conexão com o banco de dados
$conexao = new Conexao();
$banco = $conexao->abrirConexao();

// Cria uma instância do modelo de curso
$modelCurso = new ModelCurso($banco);
$modelCurso->curso = $curso;
$modelCurso->id_eixo = $idEixo;
$retorno = $modelCurso->cadastrarCurso();

echo json_encode($retorno);
?>