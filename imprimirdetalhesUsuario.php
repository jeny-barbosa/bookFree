<?php

include_once('conexao.php');
$html = '<table border=1 align="center"';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>Codigo</th>';
$html .= '<th>Usuario</th>';
$html .= '<th>Email</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$result_transacoes   = ""
  . "SELECT codigo, nome, email "
    . "FROM usuarios "
  . "WHERE codigo = '" . $_GET['codigo'] . "'";

$resultado_trasacoes = mysqli_query($conn, $result_transacoes);

while ($row_transacoes      = mysqli_fetch_assoc($resultado_trasacoes)) {
  $html .= '<tr><td>' . $row_transacoes['codigo'] . "</td>";
  $html .= '<td>' . $row_transacoes['nome'] . "</td>";
  $html .= '<td>' . $row_transacoes['email'] . "</td></tr>";
}

$html .= '</tbody>';
$html .= '</table';

use Dompdf\Dompdf;

require_once('dompdf/autoload.inc.php');
$dompdf = new DOMPDF();
$dompdf->load_html('
          <h1 style="text-align: center;">BookFree - Detalhes do Usuario</h1>
          ' . $html . '
                  ');
$dompdf->render();
$dompdf->stream(
  "relatorioEdicao", array(
  "Attachment" => false //Para realizar o download somente alterar para true
  )
);
?>