<?php

if (isset($_POST["id"])) {
  $output  = '';
  $connect = mysqli_connect("localhost", "root", "", "projetobd");
  $query   = "SELECT aluguel.id, livro.nome as livro, usuarios.nome as usuario, aluguel.data_inicio, aluguel.data_fim FROM aluguel INNER JOIN usuarios ON usuarios.codigo = aluguel.idusuario INNER JOIN livro ON livro.codigo = aluguel.idlivro WHERE id = '" . $_POST['id'] . "'";
  $result  = mysqli_query($connect, $query);
  $output  .= '
      <div class="table-responsive">
           <table class="table table-bordered">';
  while ($row     = mysqli_fetch_array($result)) {
    $output .= '
                 <tr>
                     <td width="10%"><label>Id</label></td>
                     <td width="30%">' . $row['id'] . '</td>
                </tr>
                <tr>
                     <td width="10%"><label>Nome do Livro</label></td>
                     <td width="30%">' . $row['livro'] . '</td>
                </tr>
                <tr>
                     <td width="10%"><label>Usuario</label></td>
                     <td width="30%">' . $row['usuario'] . '</td>
                </tr>
                <tr>
                     <td width="10%"><label>Data Inicio</label></td>
                     <td width="30%">' . date('d/m/Y', strtotime($row['data_inicio'])) . '</td>
                </tr>
                <tr>
                     <td width="10%"><label>Data Fim</label></td>
                     <td width="30%">' . date('d/m/Y', strtotime($row['data_fim'])) . '</td>
                </tr>

                <tr>
                    <td class="col-md-1"><a class="btn btn-danger" href="imprimirdetalhesAluguel.php?id=' . $row['id'] . '" target="_blank" role="button">Imprimir</a></td>
                </tr>

           ';
  }
  $output .= '
           </table>
      </div>
      ';
  echo $output;
}
?>
