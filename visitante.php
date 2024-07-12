<?php

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Projetos Integradores </title>
    <link rel="shortcut icon" href="Imagens/logo_sapin.png" type="sapin">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="CSS/bootstrap-grid.css">
    <link rel="stylesheet" href="CSS/bootstrap-grid.css.map">
    <link rel="stylesheet" href="CSS/bootstrap-grid.min.css">
    <link rel="stylesheet" href="CSS/bootstrap-grid.min.css.map">
    <link rel="stylesheet" href="CSS/bootstrap-reboot.css">
    <link rel="stylesheet" href="CSS/bootstrap-reboot.css.map">
    <link rel="stylesheet" href="CSS/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="CSS/bootstrap-reboot.min.css.map">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <link rel="stylesheet" href="CSS/bootstrap.css.map">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css.map">
    <link rel="stylesheet" href="CSS/cadastro.css">
    <link rel="stylesheet" href="CSS/tela-nave-curso.css">
    <link rel="stylesheet" href="CSS/tela-nave-eixo.css">
    <link rel="stylesheet" href="CSS/modal.css">
    <link rel="stylesheet" href="CSS/responsividade-mobile-adm.css">
    <link rel="stylesheet" href="CSS/cards-visitante.css">

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

            <a href=""><img src="Imagens/logo_sapin.png" width="110px" alt="logo sapin" id="logo-sapin" class="nav-imagem"></a> <!-- logo do SAPIN -->
            <ul class="nav justify-content-start">
                <li class="nav-item">
                    <a class="nav-link" href="">Projeto Integrador</a>
                </li>
            </ul>
            <ul class="nav justify-content-end">
                <li class="nav-button">
                    <a class="" href="Controller/Coordenador/Logout.php"><button class="nav-btn">Sair</button></a>
                </li>
            </ul>
            
            <div class="btn-mobile">
                <a href="Controller/Coordenador/Logout.php"><button class="nav-btn">Sair</button></a>
            </div>
        </div>
    </header>


    <div>
        <h2 for="filtroStatus">Mostrar Projetos:</h2>    
        <div class="select"  id="divEixos">
            <select id="filtroEixo" class="form-control">
                    <option value="">Selecione um Eixo...</option>
                    <?php
                    include 'Configuracao/ConexaoProjeto.php';
                    $result = $conn->query("SELECT id, nome FROM eixo WHERE status_eixo = 1");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                    }
                    ?>
                </select>
        </div>
        <div class="select" id="divCursos">
            <select id="filtroCurso" class="form-control">
                    <option value="">Selecione um Curso...</option>
                </select>
            </div>
        </div>
        <div class="select" id="divTurmas">
            <select id="filtroTurma" class="form-control">
                    <option value="">Selecione uma Turma...</option>
                </select>
        </div>
        <div class="select" id="divStatus">
        <select id="filtroStatus" class="form-control">
                    <option value="">Selecione o Status...</option>
                    <option value="1">Ativados</option>
                    <option value="0">Desativados</option>
                </select>
    
            </div>
        </div>



    <div id="cards-container">

        <div class="card">
            <div class="titulo"></div>
            <div class="participantes"></div>
            <div class="palavrasChaves">
                <span class="corA">Eixo:</span><span class="palavrachave"></span>
                <br>
                <span class="corA">Curso:</span><span class="palavrachave"></span>
                <br>
                <span class="corA">Turma:</span><span class="palavrachave"></span>
            </div>
            <div class="link">
                <a href=""><button>Arquivo</button></a>
                <a href=`saiba-mais.php?id=${id}`><button>Saiba Mais</button></a>
            </div>
        </div>

    </div>
    
    <div class="modal fade" id="modal-barras" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">

                <div class="modal-header">

                    <div class="botoes-modal ">
                        <a href=""> <h2 class="h2-modal-mobile"> MENU </h2> </a>
                    </div>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true" class="fechar-modal">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <a class="nav-link nav-item nav-modal-mobile" href="">Projeto Integrador</a>
                </div>

                <div class="modal-footer">
                </div>

            </div>
        </div>
    </div>

</body>
<script src="JS/jquery-3.6.0.min.js"></script>
<script src="JS/bootstrap.min.js"></script>
<script src="JS/sweetalert2.all.min.js"></script>

<script type="text/javascript">
   async function carregarCards() {
    try {
        const request = await fetch('Controller/Projeto/ListarTodos.php', { method: 'GET' });
        const response = await request.json();
 

        const cardsContainer = document.getElementById('cards-container');
        cardsContainer.innerHTML = ''; 

        response.dados.forEach(item => {
            const cardHTML = `
                <div class="card">
                    <div class="titulo">${item.titulo}</div>
                    <div class="participantes">${item.participantes}</div>
                    <div class="palavrasChaves">
                        <span class="corA">Eixo:</span><span class="palavrachave">${item.eixo}</span><br>
                        <span class="corA">Curso:</span><span class="palavrachave">${item.curso}</span><br>
                        <span class="corA">Turma:</span><span class="palavrachave">${item.turma}</span>        
                    </div>
                    <div class="link">
                        <a href="#"><button>Arquivo</button></a>
                        <a href="#"><button onclick="saibaMais(${item.id})" data-id="${item.id}">Saiba Mais</button></a>
                    </div>
                </div>`;
            cardsContainer.innerHTML += cardHTML;
        });
    } catch (error) {
        console.error('Erro ao carregar os cards:', error);
    }
}


  $(document).ready(function(){
    function carregarCursos(eixoId) {
        $.ajax({
            url: 'Controller/Projeto/CarregarCursos.php',
            type: 'GET',
            data: { eixo: eixoId },
            success: function(response){
                $('#filtroCurso').html(response);
                $('#filtroTurma').html('<option value="">Todos</option>');
                var filtros = {
                    eixo: eixoId,
                    status: $('#filtroStatus').val()
                };
                carregarCards(filtros);
            }
        });
    }

    function carregarTurmas(cursoId) {
        $.ajax({
            url: 'Controller/Projeto/CarregarTurmas.php',
            type: 'GET',
            data: { curso: cursoId },
            success: function(response){
                $('#filtroTurma').html(response);
                var filtros = {
                    eixo: $('#filtroEixo').val(),
                    curso: cursoId,
                    status: $('#filtroStatus').val()
                };
                carregarCards(filtros);
            }
        });
    }

    function carregarCards(filtros = {}) {
        if (filtros.status === "todos") {
            filtros.status = null;
        }
        $.ajax({
            url: 'Controller/Projeto/CarregarCards.php',
            type: 'GET',
            data: filtros,
            success: function(response){
                $('#cards-container').html(response);
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
        carregarCards(filtros);
    });

    $('#filtroStatus').on('change', function(){
        var filtros = {
            eixo: $('#filtroEixo').val(),
            curso: $('#filtroCurso').val(),
            turma: $('#filtroTurma').val(),
            status: $('#filtroStatus').val()
        };
        carregarCards(filtros);
    });

    $('#cards-container').on('click', '.btn-toggle-status', function(){
        var id = $(this).data('id');
        var status = $(this).data('status');
        var novoStatus = status ? 0 : 1;
        $.ajax({
            url: 'Controller/Projeto/CarregarCards.php',
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
                    carregarCards(filtros);
                } else {
                    alert('Erro ao alterar o status do projeto.');
                }
            }
        });
    });

});
$(document).ready(function () {
    carregarCards();
});
function saibaMais(id) {
    window.location.href = `tela-projeto.php?id=${id}`;
  }
</script>
</html>