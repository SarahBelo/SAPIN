<?php

include_once '../Configuracao/connect.php';

if (isset($_POST['curso_id'])) {
    $cursoID = $_POST['curso_id'];

    try {
        // Fetch subcategories
        $stmt = $pdo->prepare("SELECT id, nomenclatura FROM turma WHERE id_curso = :curso_id");
        $stmt->bindParam(':curso_id', $cursoID, PDO::PARAM_INT);
        $stmt->execute();


        echo "<option value=''>Selecione uma Turma</option>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $row['id'] . "'>" . $row['nomenclatura'] . "</option>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}