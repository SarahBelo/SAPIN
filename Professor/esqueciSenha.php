<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci Senha</title>
    <link rel="shortcut icon" href="../Imagens/logo_sapin.png" type="sapin">

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
    <div id="fundo" class="principal">
        <form action="#">
            <div id="img">
                <a href=""><img src="../Imagens/logo_sapin_transparente.png" width="110px" alt="logo sapin" id="logo-sapin" class="nav-imagem"></a> <!-- logo do SAPIN -->
            </div>
            <h1 style="text-align: center;">Coloque seu email</h1>
            <br>
            <h3>Email:</h3>
            <input type="text" id="txtEmail">
            <br>
            <div id="buttons">
                <button type="button" class="btn btn-primary btn-fundo" id="bntRedefinir">Redefinir</button>
            </div>
            <br>
        </form>
    </div>
</body>
<script src="../JS/jquery-3.6.0.min.js"></script>
<script src="../JS/bootstrap.min.js"></script>
<script src="../JS/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    var reenv = document.querySelector('#bntRedefinir');
    reenv.addEventListener('click', async function () {
        
        const config = {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: document.querySelector('#txtEmail').value
            })
        };

        const request = await fetch('../Controller/Professor/SenhaProfessor.php', config);
        const response = await request.json();
 
        if (response.status == 1) {

            alert('Uma nova senha foi enviada para o seu e-mail');
            window.location.href = "login-professor.html";
        } else {

            alert('e-mail incorreto');
        }
    });


</script>


</script>

</html>