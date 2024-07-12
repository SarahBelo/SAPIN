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
  <title>Tabela de Professor</title>
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
  <a class="btn-table-container" href="cadastro-professor.php?id=<?php echo $_SESSION['user_id']; ?>">
    <button class="btn btn-primary" id="cadastrarProfessor">Cadastrar Professor</button>
</a>

<div class="table-container">
<table class="consulta" style="border-radius: 15px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th colspan="2">AÇÕES</th>
        </tr>
    </thead>
    <tbody id="bodyProfessor">
    </tbody>
</table>

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

<script type="text/javascript" charset="utf-8">
  async function carregarDadosProfessor(id) {
    const request = await fetch('../Controller/Professor/ListarProfessor.php', { method: 'GET' });
    const response = await request.json();
    const professor = document.getElementById('bodyProfessor');

    for (const item of response.dados) {
      let statusProfessor = item.status_professor != 0 ? 'Ativo' : 'Desativado';
      professor.innerHTML += `
            <tr>
                <td>${item.id}</td>
                <td>${item.nome}</td>
                <td>${item.email}</td>
                <td class="acoes">
                        <button class="btn btn-primary editarProfessor" onclick="editarProfessor(${item.id})" id="" data-id="${item.id}">Editar</button>
                    </td>
                    <td class="acoes">
                        <select name="status" id="status-${item.id}" onchange="statusProfessor(${item.id})">
                            <option value="select" select disabled>${statusProfessor}</option>
                            <option value="1" ${statusProfessor === 'Ativo' ? 'selected' : ''}>Ativo</option>
                            <option value="0" ${statusProfessor === 'Desativado' ? 'selected' : ''}>Desativado</option>
                        </select>
                    </td>
                </tr>`;
    }
  }
  $(document).ready(function () {
    carregarDadosProfessor();
  });

  function editarProfessor(id) {
    window.location.href = `editar-professor.php?id=${id}`;
  }

  async function statusProfessor(id) {
        const selectElement = document.getElementById(`status-${id}`);
        const status = parseInt(selectElement.value);
        const config = {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        body: JSON.stringify({
            id: id,
            statusProfessor: status
        })
    };

    try {
        const request = await fetch('../Controller/Professor/StatusProfessor.php', config);
        const response = await request.json();
        if (response.status === 1) {
            Swal.fire('Status atualizado com sucesso!', '', 'success');
        } else {
            Swal.fire('Erro ao atualizar status.', '', 'error');
        }
    } catch (error) {
        console.error('Request failed', error);
        Swal.fire('Erro ao atualizar status.', '', 'error');
    }
  }
</script>
</html>