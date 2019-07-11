<?php

include_once("conexao.php");
$html = '<table border=1 ';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>ID</th>';
$html .= '<th>Usuario</th>';
$html .= '<th>Livro</th>';
$html .= '<th>Data Inicio</th>';
$html .= '<th>Data Fim</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$result_transacoes = "SELECT aluguel.id, livro.nome as livro, usuarios.nome as usuario, aluguel.data_inicio, aluguel.data_fim FROM aluguel INNER JOIN usuarios ON usuarios.codigo = aluguel.idusuario INNER JOIN livro ON livro.codigo = aluguel.idlivro order by data_inicio";
$resultado_trasacoes = mysqli_query($conn, $result_transacoes);
while ($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)) {
  $html .= '<tr><td>' . $row_transacoes['id'] . "</td>";
  $html .= '<td>' . $row_transacoes['usuario'] . "</td>";
  $html .= '<td>' . $row_transacoes['livro'] . "</td>";
  $html .= '<td>' . date('d/m/Y', strtotime($row_transacoes['data_inicio'])) . "</td>";
  $html .= '<td>' . date('d/m/Y', strtotime($row_transacoes['data_fim'])) . "</td></tr>";
}
$html .= '</tbody>';
$html .= '</table';
$html .= "------ <p style='color:black; font-size:16pt;'>Foram alugados " . mysqli_num_rows($resultado_trasacoes) . " Livros!</p> <br>";

use Dompdf\Dompdf;

require_once("dompdf/autoload.inc.php");

$dompdf = new DOMPDF();

$dompdf->load_html('<h1 style="text-align: center;">BookFree - Relatório Geral dos Empréstimos</h1> ' . $html . '');

$dompdf->render();

$dompdf->stream(
  "Relatório de Emprestimos.pdf", array(
  "Attachment" => false //Para realizar o download somente alterar para true
  )
);
?>