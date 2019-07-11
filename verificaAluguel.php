<?php

require 'conexao.php';



$valida = true;

if ($_POST['user'] == '') {
  $retorno .= "Preencha o campo Nome <br />";
  $valida = false;
}

if ($_POST['email'] == '') {
  $retorno .= "Preencha o campo Autor<br />";
  $valida = false;
}

if ($_POST['data_inicio'] == '') {
  $retorno .= "Preencha o campo Edição <br />";
  $valida = false;
}

if ($_POST['data_fim'] == '') {
  $retorno .= "Preencha o campo Edição <br />";
  $valida = false;
}


if ($valida) {
  //   $codigo = $_POST['codigo'];
  $usuario = $_POST["user"];
  $email = $_POST["email"];
  $data_inicio = $_POST["data_inicio"];
  $data_fim = $_POST["data_fim"];

  mysqli_query($conn, "INSERT INTO aluguel(data_inicio, data_fim, usuario_nome, nome_livro) VALUES ('$data_inicio','$data_fim', '$usuario', '$email')");

  if (mysqli_affected_rows($conn) != -1) {
    $retorno = 'Dados inseridos com sucesso!';
  } else {
    $retorno = 'Erro ao inserir os dados';
  }
}

echo $retorno;
