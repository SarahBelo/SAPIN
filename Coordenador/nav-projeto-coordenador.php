<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login-coordenador.html');
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
    <link rel="shortcut icon" href="../Imagens/logo_sapin_transparente.png" type="sapin">
    <title>Tabela de Projetos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  
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
                    <a class="nav-link" href="nav-eixo-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Eixo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="nav-curso-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Curso</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="nav-turma-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Turma</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="nav-professor-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Professor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="nav-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Coordenador</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="nav-projeto-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Projeto Integrador</a>
                </li>
            </ul>
            <ul class="nav justify-content-end">
                <li class="nav-button">
                    <a class="" href="nav-perfil-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>"><button class="nav-btn">Perfil</button></a>
                </li>
                <li class="nav-button">
                    <a class="" href="../Controller/Coordenador/Logout.php"><button class="nav-btn">Sair</button></a>
                </li>
            </ul>
            <div class="btn-mobile">
                <a href="nav-perfil-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>"><button class="nav-btn">Perfil</button></a>
                <a href="../Controller/Coordenador/Logout.php"><button class="nav-btn">Sair</button></a>
            </div>
        </div>
    </header>
    <main>
    <div class="modal fade" id="modal-barras" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-header"> <!-- parte de cima da DIV MODAL-CONTENT -->
                    <div class="botoes-modal "><a href="">
                            <h2 class="h2-modal-mobile"> MENU </h2>
                        </a>
                    </div>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true" class="fechar-modal">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <a class="nav-link nav-item nav-modal-mobile" href="nav-eixo-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Eixo</a>
                        <a class="nav-link nav-item nav-modal-mobile" href="nav-curso-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Curso</a>
                        <a class="nav-link nav-item nav-modal-mobile" href="nav-turma-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Turma</a>
                        <a class="nav-link nav-item nav-modal-mobile" href="nav-professor-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Professor</a>
                        <a class="nav-link nav-item nav-modal-mobile" href="nav-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Coordenador</a>
                        <a class="nav-link nav-item nav-modal-mobile" href="nav-projeto-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Projeto Integrador</a>
                        </div>
                <div class="modal-footer"> <!-- parte de baixo da DIV MODAL-CONTENT -->
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h2 class="mt-4">Tabela de Projetos</h2>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="filtroEixo">Eixo</label>
                <select id="filtroEixo" class="form-control">
                    <option value="">Todos</option>
                    <?php
                    include '../Configuracao/ConexaoProjeto.php';
                    $result = $conn->query("SELECT id, nome FROM eixo WHERE status_eixo = 1");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="filtroCurso">Curso</label>
                <select id="filtroCurso" class="form-control">
                    <option value="">Todos</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="filtroTurma">Turma</label>
                <select id="filtroTurma" class="form-control">
                    <option value="">Todos</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="filtroStatus">Status</label>
                <select id="filtroStatus" class="form-control">
                    <option value="">Todos</option>
                    <option value="1">Ativados</option>
                    <option value="0">Desativados</option>
                </select>
            </div>
        </div>

    </div>
        <div id="containerProjetos" class="table-container">
            <!-- Tabela será carregada aqui -->
        </div>
<script>
    $(document).ready(function(){
    function carregarCursos(eixoId) {
        $.ajax({
            url: '../Controller/Projeto/CarregarCursos.php',
            type: 'GET',
            data: { eixo: eixoId },
            success: function(response){
                $('#filtroCurso').html(response);
                $('#filtroTurma').html('<option value="">Todos</option>');
                var filtros = {
                    eixo: eixoId,
                    status: $('#filtroStatus').val()
                };
                carregarProjetos(filtros);
            }
        });
    }

    function carregarTurmas(cursoId) {
        $.ajax({
            url: '../Controller/Projeto/CarregarTurmas.php',
            type: 'GET',
            data: { curso: cursoId },
            success: function(response){
                $('#filtroTurma').html(response);
                var filtros = {
                    eixo: $('#filtroEixo').val(),
                    curso: cursoId,
                    status: $('#filtroStatus').val()
                };
                carregarProjetos(filtros);
            }
        });
    }

    function carregarProjetos(filtros = {}) {
        if (filtros.status === "todos") {
            filtros.status = null;
        }
        $.ajax({
            url: '../Controller/Projeto/CarregarProjetos.php',
            type: 'GET',
            data: filtros,
            success: function(response){
                $('#containerProjetos').html(response);
            }
        });
    }

    $('#filtroEixo').on('change', function(){
        var eixoId = $(this).val();
        carregarCursos(eixoId);
    });

    $('#filtroCurso').on('change', function(){
        var cursoId = $(this).val();
        carregarTurmas(cursoId);
    });

    $('#filtroTurma').on('change', function(){
        var turmaId = $(this).val();
        var filtros = {
            eixo: $('#filtroEixo').val(),
            curso: $('#filtroCurso').val(),
            turma: turmaId,
            status: $('#filtroStatus').val()
        };
        carregarProjetos(filtros);
    });

    $('#filtroStatus').on('change', function(){
        var filtros = {
            eixo: $('#filtroEixo').val(),
            curso: $('#filtroCurso').val(),
            turma: $('#filtroTurma').val(),
            status: $('#filtroStatus').val()
        };
        carregarProjetos(filtros);
    });

    $('#containerProjetos').on('click', '.btn-toggle-status', function(){
        var id = $(this).data('id');
        var status = $(this).data('status');
        var novoStatus = status ? 0 : 1;
        $.ajax({
            url: '../Controller/Projeto/CarregarProjetos.php',
            type: 'POST',
            data: {
                acao: 'alterarStatus',
                id: id,
                status: novoStatus
            },
            success: function(response){
                if(response === 'sucesso') {
                    var filtros = {
                        eixo: $('#filtroEixo').val(),
                        curso: $('#filtroCurso').val(),
                        turma: $('#filtroTurma').val(),
                        status: $('#filtroStatus').val()
                    };
                    carregarProjetos(filtros);
                } else {
                    alert('Erro ao alterar o status do projeto.');
                }
            }
        });
    });

    // Carregar os projetos inicialmente
    carregarProjetos();
});

</script>
    </body>
    <script src="../JS/jquery-3.6.0.min.js"></script>
    <script src="../JS/bootstrap.min.js"></script>
    <script src="../JS/sweetalert2.all.min.js"></script>
    </html>