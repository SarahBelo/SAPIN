<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: Professor/login-professor.html');
    exit;
}

$allowed_ids = [1, 2, 3];
if (!in_array($_SESSION['user_id'], $allowed_ids)) {
    header('Location: ../acesso-negado.html');
    exit;
}

// Database connection details
$host = 'localhost:3308';
$dbname = 'teste_banco';
$username = 'root';
$password = '';

// Connecting to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

// Saving text inputs into PHP Variables
$eixo = $_POST['txtEixo'] ?? null;
$curso = $_POST['txtCurso'] ?? null;
$turma = $_POST['txtTurma'] ?? null;
$titulo = $_POST['txtTitulo'] ?? null;
$participantes = array_filter($_POST['txtParticipante'] ?? []);
$intro = $_POST['txtResumo'] ?? null;
$publico = $_POST['txtPublicoAlvo'] ?? null;
$id_professor = $_SESSION['user_id'] ?? null;
$status_projeto = 1;
$arq_ativo = 1;

// Condition variables for the upload
$uploadimgOK = 1;
$uploaddocOK = 1;
$uploadCancel = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dirIMG = 'uploads/imgs/';
    $target_dirDOC = 'uploads/docs/';
    $allowTypesIMG = ['jpg', 'png', 'jpeg', 'gif'];
    $allowTypesDOC = ['docx', 'pdf', 'doc'];

    $imagens = array_filter($_FILES['imgs']['name'] ?? []);
    $docs = array_filter($_FILES['docs']['name'] ?? []);

    if (count($docs) > 1) {
        $uploadCancel = 1;
    } else {
        $uploadCancel = 0;
    }

    if ($uploadCancel == 0) {
        try {
            // Uploading text fields into the table
            $stmt = $pdo->prepare('INSERT INTO projeto (titulo, introducao, participantes, publico, id_eixo, id_curso, id_turma, id_professor, status_projeto) 
                                   VALUES (:titulo, :introducao, :participantes, :publico, :eixo, :curso, :turma, :id_professor, :status_projeto)');
            $stmt->execute([
                ':titulo' => $titulo,
                ':participantes' => implode(', ', $participantes),
                ':introducao' => $intro,
                ':publico' => $publico,
                ':eixo' => $eixo,
                ':curso' => $curso,
                ':turma' => $turma,
                ':id_professor' => $id_professor,
                ':status_projeto' => $status_projeto
            ]);

            $id = $pdo->lastInsertId();

            if (!is_dir($target_dirIMG) || !is_writable($target_dirIMG)) {
                echo "Target directory is not writable: $target_dirIMG";
                exit();
            }

            if (!empty($imagens)) {
                foreach ($imagens as $key => $value) {
                    $fileType = pathinfo($_FILES['imgs']['name'][$key], PATHINFO_EXTENSION);
                    if (in_array($fileType, $allowTypesIMG)) {
                        $uploadimgOK = 1;
                        $newFileName = uniqid() . '_' . date('Ymd_His') . '.' . $fileType;
                        $targetFilePath = $target_dirIMG . $newFileName;

                        $stmt = $pdo->prepare('INSERT INTO imagens(id_projeto, camArquivo, arq_ativo) VALUES (:id, :arquivo, :arq_ativo)');
                        $stmt->execute([':id' => $id, ':arquivo' => $targetFilePath, ':arq_ativo' => $arq_ativo]);

                        move_uploaded_file($_FILES['imgs']['tmp_name'][$key], $targetFilePath);
                    } else {
                        echo 'Arquivo de imagem não suportado';
                        $uploadimgOK = 0;
                    }

                    if ($_FILES['imgs']['error'][$key] != UPLOAD_ERR_OK) {
                        echo "Upload error: " . $_FILES['imgs']['error'][$key];
                    }
                }
            }

            if (!empty($docs)) {
                foreach ($docs as $key => $value) {
                    $fileType = pathinfo($_FILES['docs']['name'][$key], PATHINFO_EXTENSION);
                    if (in_array($fileType, $allowTypesDOC)) {
                        $uploaddocOK = 1;
                        $newFileName = uniqid() . '_' . date('Ymd_His') . '.' . $fileType;
                        $targetFilePath = $target_dirDOC . $newFileName;

                        $stmt = $pdo->prepare('INSERT INTO docs(id_projeto, camArquivo, arq_ativo) VALUES (:id, :arquivo, :arq_ativo)');
                        $stmt->execute([':id' => $id, ':arquivo' => $targetFilePath, ':arq_ativo' => $arq_ativo]);

                        move_uploaded_file($_FILES['docs']['tmp_name'][$key], $targetFilePath);
                    } else {
                        echo 'Arquivo de documento não suportado';
                        $uploaddocOK = 0;
                    }

                    if ($_FILES['docs']['error'][$key] != UPLOAD_ERR_OK) {
                        echo "Upload error: " . $_FILES['docs']['error'][$key];
                    }
                }
            }

            if ($uploadimgOK && $uploaddocOK) {
                header('Location: testesucesso.html');
                exit();
            } else {
                echo 'Erro ao fazer upload dos arquivos.';
            }
        } catch (PDOException $e) {
            echo 'Erro ao salvar os dados: ' . $e->getMessage();
        }
    } else {
        echo 'Erro no Upload: Mais de 1 Arquivo de Documento';
    }
} else {
    echo 'Erro ao fazer o Upload';
}
?>
