<?php

include_once '../Configuracao/connect.php';

if (isset($_POST['eixo_id'])) {
    $eixoID = $_POST['eixo_id'];

    try {
        // Fetch subcategories
        $stmt = $pdo->prepare("SELECT id, nome FROM curso WHERE id_eixo = :eixo_id");
        $stmt->bindParam(':eixo_id', $eixoID, PDO::PARAM_INT);
        $stmt->execute();

        echo "<option value=''>Selecione um Curso</option>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}