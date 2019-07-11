<?php

require 'conexao.php';

$valida = true;

if ($_POST['nome-add'] == '') {
    $retorno .= "Preencha o campo Nome <br />";
    $valida = false;
}

if ($_POST['email-add'] == '') {
    $retorno .= "Preencha o campo Autor<br />";
    $valida = false;
}

if ($_POST['senha-add'] == '') {
    $retorno .= "Preencha o campo Edição <br />";
    $valida = false;
}


if ($valida) {
    //   $codigo = $_POST['codigo'];
    $nome = $_POST['nome-add'];
    $email = $_POST['email-add'];
    $senha = md5($_POST['senha-add']);

    mysqli_query($conn, "INSERT INTO usuarios(nome, email, senha) VALUES ('$nome', '$email', '$senha')");

    if (mysqli_affected_rows($conn) != -1) {
        $retorno = 'Dados inseridos com sucesso!';
    } else {
        $retorno = 'Erro ao inserir os dados';
    }
}

echo $retorno;



