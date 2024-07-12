<?php

include '../../Configuracao/ConexaoProjeto.php';

$cursoId = isset($_GET['curso']) ? intval($_GET['curso']) : 0;


if ($cursoId) {
    $query = "SELECT id, nomenclatura FROM turma WHERE id_curso = $cursoId AND status_turma = 1";
    $result = $conn->query($query);

    echo '<option value="">Todos</option>';
    while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['id']}'>{$row['nomenclatura']}</option>";
    }
} else {
    echo '<option value="">Todos</option>';
}
?>
