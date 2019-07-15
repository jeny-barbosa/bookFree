<?php

include_once('conexao.php');

$arquivo = 'Dados Gerais dos Emprestimos.xls';

$tabela  = '<table border="1">';
$tabela .= '<tr>';
$tabela .= '<td colspan="2">Relatorio Emprestimos</tr>';
$tabela .= '</tr>';
$tabela .= '<tr>';
$tabela .= '<td><b>ID</b></td>';
$tabela .= '<td><b>Usuario</b></td>';
$tabela .= '<td><b>Livro</b></td>';
$tabela .= '<td><b>Data Inicio</b></td>';
$tabela .= '<td><b>Data Fim</b></td>';
$tabela .= '</tr>';

$resultado = mysqli_query($conn, ""
  . "SELECT aluguel.id, livro.nome as livro, usuarios.nome as usuario, aluguel.data_inicio, aluguel.data_fim "
    . "FROM aluguel "
    . "INNER JOIN usuarios "
    . "ON usuarios.codigo = aluguel.idusuario "
    . "INNER JOIN livro "
    . "ON livro.codigo = aluguel.idlivro");

while ($dados = mysqli_fetch_array($resultado)) {
  $tabela .= '<tr>';
  $tabela .= '<td>' . $dados['id'] . '</td>';
  $tabela .= '<td>' . $dados['usuario'] . '</td>';
  $tabela .= '<td>' . $dados['livro'] . '</td>';
  $tabela .= '<td>' . $dados['data_inicio'] . '</td>';
  $tabela .= '<td>' . $dados['data_fim'] . '</td>';
  $tabela .= '</tr>';
}

$tabela .= '</table>';

header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type: application/x-msexcel');
header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
echo $tabela;
?>