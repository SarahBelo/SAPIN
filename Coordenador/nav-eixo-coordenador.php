<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login-coordenador.html');
    exit;
}

// IDs permitidos
$allowed_ids = [1, 2, 3];
if (!in_array($_SESSION['user_id'], $allowed_ids)) {
    header('Location: acesso-negado.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabela de Eixo</title>
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
                <li class="nav-item">
                    <a class="" href="nav-perfil-coordenador.php?id=<?php echo $_SESSION['user_id']; ?>"><button class="nav-btn">Perfil</button></a>
                </li>
                <li class="nav-item">
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
        <div class="btn-table-container">
            <button class="btn btn-primary" id="abrirModalCadastroEixo">Cadastrar Eixo</button>

            <!-- Estrutura do Modal (Cadastrar Eixo) -->
            <div id="modalCadastrarEixo" class="modal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content border-0">
                        <div class="modal-header conteudoModal">
                            <h2>Cadastrar Eixo</h2>
                            <span class="close">&times;</span>
                        </div>
                        <br>
                        <div class="modal-body conteudoModal">
                            <h1 class="modal-title">Insira o nome do novo Eixo:</h1>
                            <input type="text" id="txtEixo" placeholder="">
                            <br>
                            <div class="conteudoModal">
                                <button class="btnModal btn btn-primary" id="btnCadastrarEixo">Cadastrar Eixo</button>
                            </div>
                        </div>
                        <div class="modal-footer"> <!-- parte de baixo da DIV MODAL-CONTENT -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-container">
            <table class="consulta" style="border-radius: 15px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th colspan="2">AÇÕES</th>
                    </tr>
                </thead>
                <tbody id="bodyEixo">
                </tbody>
            </table>
            <!-- Estrutura do Modal (Editar eixo) -->
            <div id="modalEditarEixo" class="modal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content border-0">
                        <div class="modal-header conteudoModal">
                            <h2>Editar Eixo</h2>
                            <span class="close">&times;</span>
                        </div>
                        <br>
                        <div class="modal-body conteudoModal">
                            <input type="text" id="txtEditarEixo">
                        </div>
                        <br>
                        <div class="conteudoModal">
                            <button type="button" class="btnModal btn btn-primary" id="btnSalvar">Editar Eixo</button>
                        </div>
                        <div class="modal-footer"> <!-- parte de baixo da DIV MODAL-CONTENT -->
                        </div>
                    </div>
                </div>
            </div>
    </main>
        <!---                                                          MODAL NAVEGAR                                                    -->
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
</body>
<script src="../JS/jquery-3.6.0.min.js"></script>
<script src="../JS/bootstrap.min.js"></script>
<script src="../JS/sweetalert2.all.min.js"></script>
<script type="text/javascript" charset="UTF-8">
    // Seleciona os modais
    var modalCadastrar = document.getElementById("modalCadastrarEixo");
    var modalEditar = document.getElementById("modalEditarEixo");

    // Seleciona os botões que abrem os modais
    var btnCadastrar = document.getElementById("abrirModalCadastroEixo");
    var btnEditar = document.getElementById("btnEditarCadastro");

    // Seleciona todos os elementos <span> que fecham os modais
    var spans = document.getElementsByClassName("close");

    // Quando o usuário clicar nos botões, abre os respectivos modais
    btnCadastrar.onclick = function () {
        modalCadastrar.style.display = "block";
    }
    // Quando o usuário clicar em <span> (x), fecha os modais
    for (var span of spans) {
        span.onclick = function () {
            modalCadastrar.style.display = "none";
            modalEditar.style.display = "none";
        }
    }

    // Quando o usuário clica fora dos modais, fecha os modais
    window.onclick = function (event) {
        if (event.target == modalCadastrar) {
            modalCadastrar.style.display = "none";
        }
        if (event.target == modalEditar) {
            modalEditar.style.display = "none";
        }
    }

    async function cadastrarEixo() {
    try {
        const config = {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                eixo: $('#txtEixo').val(),
            })
        };

        const response = await fetch('../Controller/Eixo/CadastrarEixo.php', config);
        const result = await response.json();

        if (result.status === 1) {
            Swal.fire('Eixo cadastrado com sucesso!', '', 'success')
            .then(() => {
                modalCadastrar.style.display = "none"; // Fecha o modal de cadastro
                carregarEixosCriados(); // Recarrega a tabela de eixos
            });
        } else {
            Swal.fire('Verifique as informações.', '', 'error');
        }
    } catch {
        Swal.fire('Verifique as informações.', '', 'error');
    }
}


async function carregarEixosCriados() {
    const request = await fetch('../Controller/Eixo/CarregarEixosCriados.php', { method: 'GET' });
    const response = await request.json();
    const tabelaEixo = document.getElementById('bodyEixo');
    
    // Limpa o conteúdo atual da tabela
    tabelaEixo.innerHTML = '';

    for (const item of response.dados) {
        let statusdoeixo = item.status_eixo != 0 ? 'Ativo' : 'Desativado';
        tabelaEixo.innerHTML += `
            <tr>
                <td class="txtIdEixo">${item.id}</td>
                <td class="txtNomeEixo">${item.nome}</td>
                <td class="acoes">
                    <button class="btn btn-primary btnEditarCadastro" data-id="${item.id}">Editar</button>
                </td>
                <td class="acoes">
                    <select name="status" id="status-${item.id}" onchange="statusEixo(${item.id})">
                        <option value="select" disabled ${statusdoeixo === 'Ativo' ? '' : 'selected'}>${statusdoeixo}</option>
                        <option value="1" ${statusdoeixo === 'Ativo' ? 'selected' : ''}>Ativo</option>
                        <option value="0" ${statusdoeixo === 'Desativado' ? 'selected' : ''}>Desativado</option>
                    </select>
                </td>
            </tr>`;
    }
}

    async function editarEixo(id) {
    const config = {
        method: "post",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            idView: id, // Passando o ID do eixo como parâmetro
            nome: $('#txtEditarEixo').val(), // Obtendo o nome editado do eixo
        })
    };

    const request = await fetch('../Controller/Eixo/EditarEixo.php', config);
    const resultado = await request.json();
    if (resultado.status === 1) {
        Swal.fire('Eixo editado com sucesso!', '', 'success')
        .then(() => {
            modalEditar.style.display = "none"; // Fecha o modal de edição
            carregarEixosCriados(); // Recarrega a tabela de eixos
        });
    } else {
        Swal.fire('Verifique as informações.', '', 'error');
    }
}


    async function statusEixo(id) {
        const selectElement = document.getElementById(`status-${id}`);
        const status = parseInt(selectElement.value);

        const config = {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                idView: id,
                status: status,
            })
        };

        try {
            const response = await fetch('../Controller/Eixo/StatusEixo.php', config);
            const resultado = await response.json();

            if (resultado.status === 1) {
                Swal.fire('Status atualizado com sucesso!', '', 'success')
            } else {
                Swal.fire('Erro ao atualizar status.', '', 'error');
            }
        } catch (error) {
            Swal.fire('Erro ao atualizar status.', '', 'error');
        }
    }


    $(document).on('click', '.btnEditarCadastro', function () {
        modalEditar.style.display = "block";
        var idEixo = $(this).data('id'); // Obtendo o ID do eixo a ser editado
        var nomeEixo = $(this).closest('tr').find('.txtNomeEixo').text(); // Obtendo o nome do eixo a ser editado
        $('#txtEditarEixo').val(nomeEixo); // Preenchendo o campo de edição com o nome atual do eixo
        $('#btnSalvar').off('click').on('click', async function () {
            await editarEixo(idEixo); // Passando o ID do eixo para a função editarEixo
        });
    });
    $(document).ready(function () {
        carregarEixosCriados();

        $('#btnCadastrarEixo').on('click', async function (e) {
            await cadastrarEixo();
        });
    });
</script>



</html>