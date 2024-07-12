<?php

include '../../Configuracao/ConexaoProjeto.php';


$eixoId = isset($_GET['eixo_id']) ? $_GET['eixo_id'] : null;
$cursoId = isset($_GET['curso_id']) ? $_GET['curso_id'] : null;

$eixos = [];
$cursos = [];
$turmas = [];

if (!$eixoId && !$cursoId) {
    // Carregar todos os eixos, cursos e turmas
    $result = $conn->query("SELECT * FROM eixo");
    while ($row = $result->fetch_assoc()) {
        $eixos[] = $row;
    }

    $result = $conn->query("SELECT * FROM curso");
    while ($row = $result->fetch_assoc()) {
        $cursos[] = $row;
    }

    $result = $conn->query("SELECT * FROM turma");
    while ($row = $result->fetch_assoc()) {
        $turmas[] = $row;
    }
} elseif ($eixoId && !$cursoId) {
    // Carregar cursos e turmas com base no eixo selecionado
    $result = $conn->query("SELECT * FROM curso WHERE id_eixo = $eixoId");
    while ($row = $result->fetch_assoc()) {
        $cursos[] = $row;
    }

    $result = $conn->query("SELECT t.* FROM turma t JOIN curso c ON t.id_curso = c.id WHERE c.id_eixo = $eixoId");
    while ($row = $result->fetch_assoc()) {
        $turmas[] = $row;
    }
} elseif ($cursoId) {
    // Carregar turmas com base no curso selecionado
    $result = $conn->query("SELECT * FROM turma WHERE id_curso = $cursoId");
    while ($row = $result->fetch_assoc()) {
        $turmas[] = $row;
    }
}

echo json_encode(['eixos' => $eixos, 'cursos' => $cursos, 'turmas' => $turmas]);
?>
