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
$id = isset($_GET['id']) ? $_GET['id'] : null

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil</title>
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
                    <a class="" href="cadastroP-I.php?id=<?php echo $_SESSION['user_id']; ?>"><button class="nav-btn">Cadastrar novo Projeto</button></a>
                </li>
            </ul>
            <div class="btn-mobile">
                <a href="nav-perfil-professor.php?id=<?php echo $_SESSION['user_id']; ?>"><button class="nav-btn">Perfil</button></a>
                <a href="../Controller/Coordenador/Logout.php"><button class="nav-btn">Sair</button></a>
            </div>
        </div>
    </header>
    <main>
        <div id="fundo">
            <div>
                <h1 style="text-align: center;">Perfil</h1>
                <input type="hidden" id="id" value="<?php echo $id; ?>" />
                <label for="Nome">Nome:</label>
                <br>
                <input type="text" id="txtNome">
                <br>
                <label for="Email">E-mail:</label>
                <br>
                <input type="email" id="txtEmail">
                <br>
                <label for="SenhaAntiga">Senha atual:</label>
                <br>
                <input type="password" id="txtSenha">
                <br>
                <label for="NovaSenha" id="novaSenha">Sua nova senha:</label>
                <br>
                <input type="password" id="novaSenhaInput">
                <br>
                <label for="ConfSenha">Confirme a senha:</label>
                <br>
                <input type="password" id="confirmeNovaSenha">
                <br>
                <div id="buttons">
                    <button class="btn btn-primary" type="button" id="btnCancelar">Cancelar</button>
                    <button class="btn btn-primary" type="button" id="btnEditar">Editar</button>
                </div>
            </div>
        </div>
    </main>
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
<script src="../JS/jquery-3.6.0.min.js"></script>
<script src="../JS/bootstrap.min.js"></script>
<script src="../JS/sweetalert2.all.min.js"></script>
<script type="text/javascript">
async function carregarDadosProfessor(id) {
    const config = {
        method: "POST",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: id })
    };

    try {
        const request = await fetch('../Controller/Perfil/ListarIDProfessor.php', config);
        const response = await request.json();

        if (response.status === 1) {
            const dados = response.dados[0];
            $('#txtNome').val(dados.nome);
            $('#txtEmail').val(dados.email);
            $('#txtSenha').val(dados.senha);
        } else {
            alert('Erro ao carregar os dados: ' + response.dados);
        }
    } catch (error) {
        console.error('Erro na requisição:', error);
        alert('Erro na requisição');
    }
}

async function editarProfessor(e) {
    const txtNome = $('#txtNome').val();
    const txtEmail = $('#txtEmail').val();
    const txtSenha = $('#txtSenha').val();
    const novaSenha = $('#novaSenhaInput').val();
    const confirmeNovaSenha = $('#confirmeNovaSenha').val();
    const id = $('#id').val();

    if (novaSenha !== confirmeNovaSenha) {
        alert('As senhas não coincidem.');
        return;
    }

    const config = {
        method: "POST",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            nome: txtNome,
            email: txtEmail,
            senha: novaSenha,
            id: id
        })
    };
    try {
        const request = await fetch('../Controller/Perfil/EditarProfessor.php', config);
        const resultado = await request.json();

        if (resultado.status === 1) {
            alert('Dados alterados com sucesso');
        } else {
            alert('Erro ao alterar os dados: ' + resultado.dados);
        }
    } catch (error) {
        console.error('Erro na requisição:', error);
        alert('Erro na requisição');
    }
}

$(document).ready(async function() {
    await carregarDadosProfessor(<?php echo $id; ?>);

    $('#btnEditar').on('click', async function(e) {
        await editarProfessor(e);
    });

    $('#btnCancelar').on('click', function() {
        window.location.href = `nav-perfil-Professor.php?id=${id}`;
    });
});
</script>
</html>
