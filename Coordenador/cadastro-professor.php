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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Professor</title>
    <link rel="shortcut icon" href="../Imagens/logo_sapin_transparente.png" type="sapin">

    <link rel="preconnect" href="https://fonts.googleapis.com">
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
    <link rel="stylesheet" href="../CSS/perfil.css">
    <link rel="stylesheet" href="../CSS/tela-nave-eixo.css">
    <link rel="stylesheet" href="../CSS/modal.css">
    <link rel="stylesheet" href="../CSS/responsividade-mobile.css">
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
                    <a class="nav-link"
                        href="nav-curso-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Curso</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="nav-turma-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Turma</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="nav-professor-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Professor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="nav-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Coordenador</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="nav-projeto-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>">Projeto Integrador</a>
                </li>
            </ul>
            <ul class="nav justify-content-end">
                <li class="nav-button">
                    <a class="" href="nav-perfil-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>"><button class="nav-btn">Perfil</button></a>
                </li>
                <li class="nav-button>
                    <a class="" href="../Controller/Coordenador/Logout.php"><button class="nav-btn">Sair</button></a>
                </li>
            </ul>
            <div class="btn-mobile">
                <a href="nav-perfil-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>"><button class="nav-btn">Perfil</button></a>
                <a href="../Controller/Coordenador/Logout.php"><button class="nav-btn">Sair</button></a>
            </div>
        </div>
    </header>

    <body>
        <div id="fundo">
            <form>
                <h1>
                    <p> Cadastrar <br> Professor </p>
                </h1>
                <br>
                <label for="txtNome">Nome completo:</label>
                <br>
                <input type="text" id="txtNome" required>
                <br>
                <label for="txtEmail">E-mail:</label>
                <br>
                <input type="email" id="txtEmail" required>
                <br>
                <label for="txtConfEmail">Confirme o E-mail:</label>
                <br>
                <input type="email" id="txtConfEmail" required>
                <br>
                <div id="buttons">
                    <button class="btn btn-primary" type="button" id="btnCancelar">Cancelar</button>
                    <button class="btn btn-primary" type="button" id="btnCadastrar">Cadastrar</button>
                </div>
                <br>
            </form>
        </div>

                <!---                                                          MODAL NAVEGAR                                                    -->

        <div class="modal fade" id="modal-barras" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
    </body>
    
    <script src="../JS/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../JS/bootstrap.min.js" type="text/javascript"></script>

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function(){
        $('#btnCadastrar').on('click', async function(e){
        e.preventDefault();

        var nome = $('#txtNome').val();
        var email = $('#txtEmail').val();
        var confEmail = $('#txtConfEmail').val();

        if (email !== confEmail) {
            alert('Os emails não coincidem.');
            return;
        }
        const config = {
            method: "post",
            headers:{
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nome: nome,
                email: email
            })
        };
        try {
            const response = await fetch('../Controller/Professor/CadastroProfessor.php', config);
            const data = await response.json();

            if(data.status == 1){
                alert('Professor cadastrado com sucesso');
                window.location.href = `nav-professor-coordenador.php?id=${data.id}`;
            } else {
                alert('Erro ao cadastrar professor. Verifique as informações.');
            }
        } catch (error) {
            console.error('Erro ao realizar requisição:', error);
            alert('Ocorreu um erro ao cadastrar o professor.');
        }
    });
});


    </script>
</html>