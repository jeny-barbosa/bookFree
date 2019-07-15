<?php

require 'conexao.php';

$id = $_POST["id"];

$sql = ""
  . "DELETE "
  . "FROM aluguel "
  . "WHERE id = '" . $id . "'";

$result = $conn->query($sql);

echo json_encode([$id]);
?>