<?php

require 'conexao.php';

$idusuario   = $_POST['idusuario'];
$idlivro     = $_POST['idlivro'];
$data_inicio = $_POST['data_inicio'];
$data_fim    = $_POST['data_fim'];

$procurar  = "SELECT idusuario, idlivro, data_inicio, data_fim FROM `aluguel` "
  . "WHERE idlivro = $idlivro "
  . "AND (data_inicio BETWEEN '$data_inicio' and '$data_fim' "
  . "OR data_fim BETWEEN '$data_inicio' and '$data_fim')";
$verificar = mysqli_query($conn, $procurar);

if (mysqli_num_rows($verificar) > 0) {
  $retorno = 'O livro já está alugado pra esse período';
} else {

  $sSql         = "INSERT INTO aluguel(idusuario, idlivro, data_inicio, data_fim) VALUES ($idusuario, $idlivro,'$data_inicio', '$data_fim')";
  $mysqli_query = mysqli_query($conn, $sSql);

  if (mysqli_affected_rows($conn) != -1) {
    $retorno = 'Dados inseridos com sucesso! Recarregue a página';
  } else {
    $retorno = 'Erro ao inserir os dados';
  }
}

echo $retorno;
