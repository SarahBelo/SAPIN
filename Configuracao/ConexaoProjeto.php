<?php
$servidor = "localhost:3308";
$usuario = "root";
$senha = "";
$banco = "teste_banco";

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
