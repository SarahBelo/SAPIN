<?php
// Database connection parameters
include_once '../Configuracao/connect.php';

// Set variables
$idprof = $_SESSION['user_id'];

try {
    // SQL query to fetch data
    $sql = "
        SELECT projeto.id AS projeto_id, projeto.titulo AS projeto_titulo, projeto.participantes AS projeto_participantes, 
        projeto.publico AS projeto_publico, eixo.nome AS eixo_nome, curso.nome AS curso_nome, turma.nomenclatura AS turma_nomenclatura
        FROM projeto
        JOIN eixo ON projeto.id_eixo = eixo.id
        JOIN curso ON projeto.id_curso = curso.id
        JOIN turma ON projeto.id_turma = turma.id
        WHERE status_projeto = 1 AND 
        id_professor = :idprof;
    ";

    // Prepare and execute the SQL query
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':idprof' => $idprof
    ]);
    // Fetch and display data
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["projeto_id"]) . "</td>"; // Display user ID
            echo "<td>" . htmlspecialchars($row["projeto_titulo"]) . "</td>"; // Display user name
            echo "<td>" . htmlspecialchars($row["projeto_participantes"]) . "</td>"; // Display order ID
            echo "<td>" . htmlspecialchars($row["projeto_publico"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["eixo_nome"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["curso_nome"]) . "</td>"; // Display product name
            echo "<td>" . htmlspecialchars($row["turma_nomenclatura"]) . "</td>"; // Display product price
            // Add an Actions column with an Edit button
            echo '<td><button id=btnEditar onclick="editarProjeto(' . htmlspecialchars($row["projeto_id"]) . ')">Editar</button></td>';
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No data found</td></tr>";
    }
} catch (PDOException $e) {
    // Display error message if connection fails
    echo '<tr><td colspan="6">Connection failed: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
}

