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
    <title>Cadastrar Projeto</title>
    <link rel="shortcut icon" href="../Imagens/logo_sapin.png" type="senac">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/cadastro.css">
    <link rel="stylesheet" href="../CSS/modal.css">
    <link rel="stylesheet" href="../CSS/tela-nave-curso.css">
    <link rel="stylesheet" href="../CSS/tela-nave-eixo.css">
    <link rel="stylesheet" href="../CSS/responsividade-mobile-adm.css">
    <link rel="stylesheet" href="../CSS/responsividade-mobile.css">
    <script src="../JS/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

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

            <a href=""><img src="../Imagens/logo_sapin.png" width="70px" alt="logo senac" id="logo-mobile"></a>
            <ul class="nav justify-content-start">
                <li class="nav-imagem">
                    <a href=""><img src="../Imagens/logo_sapin.png" width="70px" alt="logo senac" id="logo-senac"></a> <!-- logo do Senac -->
                </li>
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

    <div id="fundo">
        <form action="../CadastroPI.php" method="post" enctype="multipart/form-data">
            <div id="img">
                <img src="../Imagens/logo_sapin_transparente.png" width="250px" alt="logo senac" id="logo">
            </div>
            <br>
            <input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>">
            <label for="txtEixo">Eixo:</label>
            <br>
            <select name="txtEixo" id="txtEixo" require>
                <option value="">Selecione um eixo</option>
            </select>
            <br><br>
            <label for="txtCurso">Curso:</label>
            <br>
            <select name="txtCurso" id="txtCurso" require>
                <option value="">Selecione um Curso</option>
            </select>
            <br><br>
            <label for="txtTurma">Turma:</label>
            <br>
            <select name="txtTurma" id="txtTurma" require>
                <option value="">Selecione uma Turma</option>
            </select>
            <br><br>
            <label for="txtTitulo">Titulo:</label>
            <br>
            <input type="text" id="txtTitulo" name="txtTitulo" required>
            <br><label for="txtParticipante">Participante(s):</label>
            <div id="participantes">
                <div id="campoParticipante">
                    <label for="txtParticipante">Participante(s):</label>
                    <button type="button" onclick="adicionarCampoInput()" id="adcParticipante" class="btn-primary">+</button>
                    <button type="button" onclick="removerCampoInput()" id="remParticipante" class="btn-primary">-</button>
                    <br>
                    <input type="text" id="txtParticipante" name="txtParticipante[]" required>
                </div>
            </div>
            <label for="txtPublicoAlvo">Público alvo:</label>
            <br>
            <input type="text" id="txtPublicoAlvo" name="txtPublicoAlvo">
            <br>
            <label for="txtResumo">Introdução do projeto:</label>
            <br>
            <textarea name="txtResumo" id="txtResumo" cols="42" rows="8"></textarea>
            <br>
            <label for="txtDocumento">Arquivos do Projeto:</label>
            <br>
            <label for="txtDocumento">Imagens</label>
            <br>
            <input type="file" multiple="multiple" name="imgs[]" id="imgs">
            <br>
            <label for="txtDocumento">Documentação</label>
            <br>
            <input type="file" multiple="multiple" name="docs[]" id="docs">
            <br><br>
            <div id="buttons">
                <button class="btn btn-primary" type="button" id="btnCancelar">Cancelar</button>
                <button class="btn btn-primary" type="button" id="btnEditar">Editar</button>
            </div>
            <br>
        </form>
    </div>
</body>

<script>
        $(document).ready(function() {
            // Inicialize o DataTables
            $('#consulta').DataTable();

            // Fetch categories on page load
            $.ajax({
                url: '../Model/CarregEixo.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (!response.error) {
                        response.forEach(function(eixo) {
                            $('#txtEixo').append(
                                $('<option>', {
                                    value: eixo.id,
                                    text: eixo.nome
                                })
                            );
                        });
                    } else {
                        alert(response.error);
                    }
                }
            });

            $('#txtEixo').change(function() {
                var eixoID = $(this).val();

                $.ajax({
                    url: '../Model/CarregCurso.php',
                    type: 'POST',
                    data: { eixo_id: eixoID },
                    success: function(response) {
                        $('#txtCurso').html(response);
                    }
                });
            });

            $('#txtCurso').change(function() {
                var cursoID = $(this).val();
                console.log("ID DO CURSO:" + cursoID);

                $.ajax({
                    url: '../Model/CarregTurma.php',
                    type: 'POST',
                    data: { curso_id: cursoID },
                    success: function(response) {
                        $('#txtTurma').html(response);
                    }
                });
            });
        });

        async function carregarDadosProjeto(id){
            const config = {
                method: "POST",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({id: id})
            };
            const request = await fetch('../Controller/Projeto/ListarIDProjeto.php', config);

            const response = await request.json();
            const {dados} = response;

            $('#txtEixo').val(dados[0].id_eixo);
            $('#txtCurso').val(dados[0].id_curso);
            $('#txtTurma').val(dados[0].id_turma);
            $('#txtTitulo').val(dados[0].titulo);
            $('#txtPublicoAlvo').val(dados[0].publico);
            $('#txtResumo').val(dados[0].introducao);

            // Preenchendo os campos de participantes
            const participantes = dados[0].participantes.split(',');
            $('#participantes').html('');
            participantes.forEach(participante => {
                adicionarCampoInput(participante);
            });
        }

        async function editarProjeto(e){
            const txtEixo = $('#txtEixo').val();
            const txtCurso = $('#txtCurso').val();
            const txtTurma = $('#txtTurma').val();
            const txtTitulo = $('#txtTitulo').val();
            const txtParticipante = $('input[name="txtParticipante[]"]').map(function(){ return $(this).val(); }).get().join(',');
            const txtPublicoAlvo = $('#txtPublicoAlvo').val();
            const txtResumo = $('#txtResumo').val();
            const id = $('#id').val();
            const config = {
                method: "post",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    eixo: txtEixo,
                    curso: txtCurso,
                    turma: txtTurma,
                    titulo: txtTitulo,
                    participantes: txtParticipante,
                    publico: txtPublicoAlvo,
                    introducao: txtResumo,
                    id: id
                })
            };
            const request = await fetch('../Controller/Projeto/EditarProjeto.php', config);

            const resultado = await request.json();
            if(resultado.status === 1){
                alert('Dados alterados')
                window.location.href = `nav-projeto-professor.php?id=${id}`;
            } else{
                alert('Verifique os dados inseridos');
            }
        }

        function adicionarCampoInput(valor = '') {
            var novoInput = document.createElement("input");
            novoInput.type = "text";
            novoInput.name = "txtParticipante[]";
            novoInput.className = "campo-input";
            novoInput.value = valor;
            var novoDiv = document.createElement("div");
            novoDiv.className = "campo-participante";
            novoDiv.appendChild(novoInput);
            var container = document.getElementById("participantes");
            container.appendChild(novoDiv);
        }

        function removerCampoInput() {
            var container = document.getElementById("participantes");
            var camposDiv = container.getElementsByClassName("campo-participante");
            if (camposDiv.length > 0) {
                container.removeChild(camposDiv[camposDiv.length - 1]);
            } else {
                alert("Não é possível remover mais campos.");
            }
        }

        $(document).ready(async function (){
            const urlParams = new URLSearchParams(window.location.search);
            const id = urlParams.get('id');
            await carregarDadosProjeto(id);

            $('#btnEditar').on('click', async function (e) {
                await editarProjeto(e);
            });

            $('#btnCancelar').on('click', function () {
                window.location.href = `nav-projeto-professor.php?id=${id}`;
            });
        });
    </script>
</html>
