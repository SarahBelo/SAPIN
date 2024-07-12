<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login-professor.html');
    exit;
}

// IDs permitidos
$allowed_ids = [1, 2, 3];
if (!in_array($_SESSION['user_id'], $allowed_ids)) {
    header('Location: ../acesso-negado.html');
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Projetos Integradores </title>
    <link rel="shortcut icon" href="../Imagens/logo_sapin_transparente.png" type="sapin">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../CSS/bootstrap-grid.css">
    <link rel="stylesheet" href="../CSS/bootstrap-grid.css.map">
    <link rel="stylesheet" href="../CSS/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../CSS/bootstrap-grid.min.css.map">
    <link rel="stylesheet" href="../CSS/bootstrap-reboot.css">
    <link rel="stylesheet" href="../CSS/bootstrap-reboot.css.map">
    <link rel="stylesheet" href="../CSS/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../CSS/bootstrap-reboot.min.css.map">
    <link rel="stylesheet" href="../CSS/bootstrap.css">
    <link rel="stylesheet" href="../CSS/bootstrap.css.map">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css.map">
    <link rel="stylesheet" href="../CSS/cadastro.css">
    <link rel="stylesheet" href="../CSS/tela-nave-curso.css">
    <link rel="stylesheet" href="../CSS/tela-nave-eixo.css">
    <link rel="stylesheet" href="../CSS/modal.css">
    <link rel="stylesheet" href="../CSS/responsividade-mobile-adm.css">

</head>

<body>
    <header>
        <div class="navegar">
            <div id="opcoes">
                <a data-toggle="modal" data-target="#modal-barras">
                    <div class="barra"></div>
                    <div class="barra"></div>
                    <div class="barra"></div>
                </a>
            </div>

            <a href=""><img src="../Imagens/logo_sapin.png" width="110px" alt="logo sapin" id="logo-sapin" class="nav-imagem"></a> <!-- logo do SAPIN -->
            <ul class="nav justify-content-start">
                <li class="nav-item">
                    <a class="nav-link" href="nav-projeto-professor.php?id=<?php echo $_SESSION['user_id']; ?>">Projeto Integrador</a>
                </li>
            </ul>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="" href="nav-perfil-professor.php?id=<?php echo $_SESSION['user_id']; ?>"><button class="nav-btn">Perfil</button></a>
                </li>
                <li class="nav-item">
                    <a class="" href="../Controller/Coordenador/Logout.php"><button class="nav-btn">Sair</button></a>
                </li>
                <li class="nav-item">
                    <a class="" href="CadastroP-I.php?<?php echo $_SESSION['user_id']; ?>"><button class="nav-btn">Cadastrar novo Projeto</button></a>
                </li>
            </ul>
            <div class="btn-mobile">
                <a href="nav-perfil-professor.php?id=<?php echo $_SESSION['user_id']; ?>"><button class="nav-btn">Perfil</button></a>
                <a href="../Controller/Coordenador/Logout.php"><button class="nav-btn">Sair</button></a>
            </div>
        </div>
    </header>

    <div id="containerProjetos">
        <div class="table-container">
            <table class="consulta" id="consulta">
                <thead>
                    <tr>
                        <th>ID</th> 
                        <th>Título</th>
                        <th>Participantes</th>
                        <th>Público</th>
                        <th>Eixo</th>
                        <th>Curso</th>
                        <th>Turma</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody id="teste">
                    <!-- Aqui serão inseridas as linhas da tabela -->
                    <?php 

                    include '../Model/CarregProjects.php'; 
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-barras" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <div class="botoes-modal "><a href="">
                            <h2 class="h2-modal-mobile"> MENU </h2>
                        </a>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true" class="fechar-modal">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <a class="nav-link nav-item nav-modal-mobile" href="nav-projeto-professor.php?id=<?php echo $_SESSION['user_id']; ?>">Projeto Integrador</a>
                        </div>
                <div class="modal-footer">
                        <a class="" href="CadastroP-I.php?<?php echo $_SESSION['user_id']; ?>"><button class="nav-btn">Cadastrar novo Projeto</button></a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../DataTables/datatables.css" />
<script src="../JS/jquery-3.6.0.min.js"></script>
<script src="../JS/bootstrap.min.js"></script>
<script src="../JS/sweetalert2.all.min.js"></script>
    
    <script src="../DataTables/datatables.js"></script>
    

    <script>
        $(document).ready( function () {
            $('#consulta').DataTable();
        } );
        function editarProjeto(id) {
    window.location.href = `editar-projeto.php?id=${id}`;
  }
    </script>
</html>
