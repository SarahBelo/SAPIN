<?php

$id = isset($_GET['id']) ? $_GET['id'] : null
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saiba Mais</title>
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
    <link rel="stylesheet" href="CSS/tela-projeto.css">

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
                    <a class="nav-link" href="visitante.php">Projeto Integrador</a>
                </li>
            </ul>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="" href="Controller/Coordenador/Logout.php"><button class="nav-btn">Sair</button></a>
                </li>
            </ul>


            <div class="btn-mobile">
                <a href="Controller/Coordenador/Logout.php"><button class="nav-btn">Sair</button></a>
            </div>
        </div>
    </header>

    <input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>">
    <div class="titulo" id="txtTitulo"> <!-- TÍTULO DO PROJETO --> 
    </div>
    <div class="intro">
        <span class="tituloIntroducao" > Introdução </span>
        <br>
        <span class="Introducao" id="txtResumo">  </span>
    </div>
    <div class="publico">
        <span class="tituloPublico">Público Alvo</span>
        <br>
        <span class="publico-alvo" id="txtPublicoAlvo">  </span>
    </div>
    <div class="Imagens">
        <img class="imagem" src="">
    </div>

    <div class="divisoes">
        <span class="palavrasChaves">Eixo:</span> <span class="spanColorido" id="txtEixo">  </span>
        <br>
        <span class="palavrasChaves">Curso:</span> <span class="spanColorido" id="txtCurso">  </span>
        <br>
        <span class="palavrasChaves">Turma:</span> <span class="spanColorido" id="txtTurma">  </span>
    </div>

    <div class="Participantes">
        <span class="titulo-integrantes"> Integrantes do Grupo </span>
        <br>
        <span class="integrantes" id="txtParticipante">  </span>
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
                    <a class="nav-link nav-item nav-modal-mobile" href="visitante.php">Projeto Integrador</a>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    
</body>
<script src="JS/jquery-3.6.0.min.js"></script>
<script src="JS/bootstrap.min.js"></script>
<script src="JS/sweetalert2.all.min.js"></script>
<script>
async function carregarTabelaProjeto(id){
    const config = {
        method: "POST",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({id: id})
    }; 
    const request = await fetch('Controller/Projeto/VisualizarProjetos.php', config);
    const response = await request.json();
    const {dados} = response;
    if (dados && dados.length > 0) {
        document.getElementById('txtEixo').innerText = dados[0].eixo;
        document.getElementById('txtCurso').innerText = dados[0].curso;
        document.getElementById('txtTurma').innerText = dados[0].turma;
        document.getElementById('txtTitulo').innerText = dados[0].titulo;
        document.getElementById('txtPublicoAlvo').innerText = dados[0].publico;
        document.getElementById('txtParticipante').innerText = dados[0].participantes;
        document.getElementById('txtResumo').innerText = dados[0].introducao;            
    } else {
        console.error('Erro ao carregar o projeto:', response.dados);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const id = document.getElementById('id').value;
    carregarTabelaProjeto(id);
});
    </script>
</html>