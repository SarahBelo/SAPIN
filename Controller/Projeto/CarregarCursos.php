<?php
include '../../Configuracao/ConexaoProjeto.php';

$eixoId = isset($_GET['eixo']) ? intval($_GET['eixo']) : 0;

if ($eixoId) {
    $query = "SELECT id, nome FROM curso WHERE id_eixo = $eixoId AND status_curso = 1";
    $result = $conn->query($query);

    echo '<option value="">Todos</option>';
    while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['id']}'>{$row['nome']}</option>";
    }
} else {
    echo '<option value="">Todos</option>';
}
?>
