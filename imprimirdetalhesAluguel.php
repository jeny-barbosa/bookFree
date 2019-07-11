<?php

include_once("conexao.php");
$html = '<table border=1 align="center"';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>ID</th>';
$html .= '<th>Nome do Livro</th>';
$html .= '<th>Usuario</th>';
$html .= '<th>Data Inicio</th>';
$html .= '<th>Data Fim</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$result_transacoes = "SELECT aluguel.id, livro.nome as livro, usuarios.nome as usuario, aluguel.data_inicio, aluguel.data_fim FROM aluguel INNER JOIN usuarios ON usuarios.codigo = aluguel.idusuario INNER JOIN livro ON livro.codigo = aluguel.idlivro WHERE id = '" . $_GET['id'] . "'"
;
$resultado_trasacoes = mysqli_query($conn, $result_transacoes);
while ($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)) {
  $html .= '<tr><td>' . $row_transacoes['id'] . "</td>";
  $html .= '<td>' . $row_transacoes['livro'] . "</td>";
  $html .= '<td>' . $row_transacoes['usuario'] . "</td>";
  $html .= '<td>' . date('d/m/Y', strtotime($row_transacoes['data_inicio'])) . "</td>";
  $html .= '<td>' . date('d/m/Y', strtotime($row_transacoes['data_fim'])) . "</td></tr>";
}

$html .= '</tbody>';
$html .= '</table';

use Dompdf\Dompdf;

require_once("dompdf/autoload.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html('<h1 style="text-align: center;">BookFree - Detalhes do Aluguel</h1>' . $html . '');
$dompdf->render();
$dompdf->stream(
  "relatorioEdicao", array(
  "Attachment" => false //Para realizar o download somente alterar para true
  )
);
?>