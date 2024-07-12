<?php

require_once ('../../Configuracao/Conexao.php');
require_once ('../../Model/Turma.php');

// Entrada
$reqBody = json_decode(file_get_contents('php://input'), true);
$turma = $reqBody['turma'] ?? null;
$idCurso = $reqBody['id_curso'] ?? null;

// Cria uma nova conexão com o banco de dados
$conexao = new Conexao();
$banco = $conexao->abrirConexao();

// Cria uma instância do modelo de curso
$modelTurma = new ModelTurma($banco);
$modelTurma->turma = $turma;
$modelTurma->id_curso = $idCurso;
$retorno = $modelTurma->cadastrarTurma();

echo json_encode($retorno);
?>