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
  <title>Tabela de Turmas</title>
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
        <div>
            <div class="select">
                <select name="selecionar-eixo" id="selecionar-eixo" onchange="carregarCursos()">
                    <option class="eixo-selecionado" value="select" selected disabled>Selecione um eixo...</option>
                </select>
            </div>
            <div class="select">
                <select name="selecionar-curso" id="selecionar-curso" onchange="carregarTurmasCriadas()">
                    <option class="curso-selecionado" value="select" selected disabled>Selecione um curso...</option>
                </select>
            </div>

            <div class="btn-table-container">
                <button class="btn btn-primary" id="abrirModalCadastroTurma">Cadastrar Turma</button>

                <!-- Estrutura do Modal (Cadastrar Turma) -->
                <div id="modalCadastrarTurma" class="modal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border-0">
                            <div class="modal-header conteudoModal">
                                <h2>Cadastrar Turma</h2>
                                <span class="close">&times;</span>
                            </div>
                            <br>
                            <div class="modal-body conteudoModal">
                                <h1 class="modal-title">Insira o nome da nova turma:</h1>
                                <input type="text" id="txtTurma" placeholder="">
                                <br>
                                <div class="conteudoModal">
                                    <button class="btnModal btn btn-primary" id="btnCadastrarTurma">Cadastrar Turma</button>
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
                    <tbody id="bodyEixos">
                    </tbody>
                </table>
                <!-- Estrutura do Modal (Editar Curso) -->
                <div id="modalEditarTurma" class="modal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border-0">
                            <div class="modal-header conteudoModal">
                                <h2>Editar Turma</h2>
                                <span class="close">&times;</span>
                            </div>
                            <br>
                            <div class="modal-body conteudoModal">
                                <input type="text" id="txtEditarTurma">
                            </div>
                            <br>
                            <div class="conteudoModal">
                                <button type="button" class="btnModal btn btn-primary" id="btnSalvar">Editar Curso</button>
                            </div>
                            <div class="modal-footer"> <!-- parte de baixo da DIV MODAL-CONTENT -->
                            </div>
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
    var modalCadastrar = document.getElementById("modalCadastrarTurma");
    var modalEditar = document.getElementById("modalEditarTurma");

    // Seleciona os botões que abrem os modais
    var btnCadastrar = document.getElementById("abrirModalCadastroTurma");
    var btnEditar = document.getElementById("btnEditarTurma");

    // Seleciona todos os elementos <span> que fecham os modais
    var spans = document.getElementsByClassName("close");

    // Quando o usuário clicar nos botões, abre os respectivos modais
    btnCadastrar.onclick = function() {
        modalCadastrar.style.display = "block";
    }




    // Quando o usuário clicar em <span> (x), fecha os modais
for (var span of spans) {
    span.onclick = function () {
        modalCadastrar.style.display = "none";
        modalEditar.style.display = "none";
        $('.modal-backdrop').remove(); // Remove o backdrop após fechar o modal
    }
}


    // Quando o usuário clica fora dos modais, fecha os modais
    window.onclick = function(event) {
        if (event.target == modalCadastrar) {
            modalCadastrar.style.display = "none";
        }
        if (event.target == modalEditar) {
            modalEditar.style.display = "none";
        }
    }

    $(document).ready(function() {
        carregarEixos();

        $('#selecionar-eixo').change(function() {
            carregarCursos();
        });

        $('#selecionar-curso').change(function() {
            carregarTurmasCriadas();
        });

        $(document).on('click', '.btnEditarCadastro', function() {
            modalEditar.style.display = "block";
            var idTurma = $(this).data('id');
            var nomenclatura = $(this).closest('tr').find('.txtNomeTurma').text();
            $('#txtEditarTurma').val(nomenclatura);
            $('#btnSalvar').off('click').on('click', async function() {
                await editarTurma(idTurma);
            });
        });

        $('#btnCadastrarTurma').on('click', async function(e) {
            await cadastrarTurma();
        });
    });

    async function carregarEixos() {
        const request = await fetch('../Controller/Turma/CarregarEixos.php', {
            method: 'GET'
        });
        const response = await request.json();
        const selectEixo = document.getElementById('selecionar-eixo');

        for (const item of response.dados) {
            selectEixo.innerHTML += `<option value="${item.id}" class="selecionado">${item.nome}</option>`;
        }
    }

    async function carregarCursos() {
        var selecionar = $('#selecionar-eixo').val();
        const config = {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                idEixo: selecionar
            })
        };
        const request = await fetch('../Controller/Turma/CarregarCursos.php', config);
        const response = await request.json();

        const selectCurso = document.getElementById('selecionar-curso');
        selectCurso.innerHTML = '';

        // Adiciona a opção "Selecione um curso..." ao início
        selectCurso.innerHTML += `<option value="select" selected disabled>Selecione um curso...</option>`;

        // Adiciona os cursos disponíveis após a opção inicial
        for (const item of response.dados) {
            selectCurso.innerHTML += `<option value="${item.id}" class="selecionado">${item.nome}</option>`;
        }
    }


    async function cadastrarTurma() {
    try {
        const nomeTurma = $('#txtTurma').val();
        const idEixo = $('#selecionar-eixo').val();
        const idCurso = $('#selecionar-curso').val();

        // Verifica se todos os campos necessários foram preenchidos
        if (!idEixo || idEixo === 'select') {
            Swal.fire('Por favor, selecione um eixo.', '', 'warning');
            return;
        }

        if (!idCurso || idCurso === 'select') {
            Swal.fire('Por favor, selecione um curso.', '', 'warning');
            return;
        }

        if (!nomeTurma) {
            Swal.fire('Por favor, insira o nome da turma.', '', 'warning');
            return;
        }

        // Caso todos os campos estejam preenchidos, prossegue com o cadastro
        const config = {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                turma: nomeTurma, // Usar nomeTurma em vez de turma
                id_eixo: idEixo,
                id_curso: idCurso
            })
        };

        const response = await fetch('../Controller/Turma/CadastrarTurma.php', config);
        const resultado = await response.json();

        if (resultado.status !== 0) {
            Swal.fire('Turma cadastrada com sucesso!', '', 'success')
                .then(() => {
                    $('#modalCadastrarTurma').modal('hide'); // Fecha o modal de cadastro
                    carregarTurmasCriadas(); // Recarrega a lista de turmas
                });
        } else {
            Swal.fire('Verifique as informações.', '', 'error');
        }
    } catch (error) {
        console.error('Erro ao cadastrar turma:', error);
        Swal.fire('Erro ao cadastrar turma.', '', 'error');
    }
}



    async function carregarTurmasCriadas() {
        const selecionarCurso = $('#selecionar-curso').val();
        const config = {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                idCurso: selecionarCurso
            })
        };
        const request = await fetch('../Controller/Turma/CarregarTurmas.php', config);
        const response = await request.json();

        const tabelaTurma = document.getElementById('bodyEixos');
        tabelaTurma.innerHTML = '';

        for (const item of response.dados) {
            let statusDaTurma = item.status_turma != 0 ? 'Ativo' : 'Desativado';
            tabelaTurma.innerHTML += `
                    <tr>
                        <td class="txtIdTurma">${item.id}</td>
                        <td class="txtNomeTurma">${item.nomenclatura}</td>
                        <td class="acoes">
                            <button class="btn btn-primary btnEditarCadastro" data-id="${item.id}">Editar</button>
                        </td>
                        <td class="acoes">
                            <select name="status" id="status-${item.id}" onchange="statusTurma(${item.id})">
                                <option value="select" select disabled>${statusDaTurma}</option>
                                <option value="1" ${statusDaTurma === 'Ativo' ? 'selected' : ''}>Ativo</option>
                                <option value="0" ${statusDaTurma === 'Desativado' ? 'selected' : ''}>Desativado</option>
                            </select>
                        </td>
                    </tr>
                `;
        }
    }

    // Evento de mudança no select de eixo
    $('#selecionar-eixo').change(function() {
        carregarCursos();
    });

    // Evento de mudança no select de curso
    $('#selecionar-curso').change(function() {
        carregarTurmasCriadas();
    });

    async function statusTurma(id) {
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
            const response = await fetch('../Controller/Turma/StatusTurma.php', config);
            const resultado = await response.json();

            if (resultado.status === 1) {
                Swal.fire('Status atualizado com sucesso!', '', 'success')
            } else {
                Swal.fire('Erro ao atualizar status.', '', 'error');
            }
        } catch {
            Swal.fire('Erro ao atualizar status.', '', 'error');
        }
    }

    $(document).on('click', '.btnEditarCadastro', function () {
    var idTurma = $(this).data('id');
    var nomenclatura = $(this).closest('tr').find('.txtNomeTurma').text();
    $('#txtEditarTurma').val(nomenclatura);
    $('#btnSalvar').off('click').on('click', async function () {
        await editarTurma(idTurma);
    });
    $('#modalEditarTurma').modal('show'); // Abre o modal de edição
});

async function editarTurma(idTurma) {
    const config = {
        method: "POST",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id: idTurma,
            nomenclatura: $('#txtEditarTurma').val(),
        })
    };
    const response = await fetch('../Controller/Turma/EditarTurma.php', config);
    const resultado = await response.json();

    if (resultado.status === 1) {
        Swal.fire('Turma editada com sucesso!', '', 'success')
            .then(() => {
                $('#modalEditarTurma').modal('hide'); // Fecha o modal de edição
                carregarTurmasCriadas(); // Recarrega a lista de turmas
            });
    } else {
        Swal.fire('Verifique as informações.', '', 'error');
    }
}

</script>

</html>