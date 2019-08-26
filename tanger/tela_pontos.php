<?php
require 'conexao.php';
require 'funcoes.php';
require 'estilos.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>TangDesk</title>
  </head>
  <body>
    <?php require 'menu.php'; ?>
    <br>
    <form action="processa.php" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
      <div class="container-fluid">
        <div class="row">
          <div class="col" >
            <h3>Importar Excel Tangerino</h3>
            <div class="input-group mb-3">
              <div class="custom-file">
                <label class="custom-file-label-hover" for="file">
                  <input type="file" name="tangerino" id="tangerino" accept=".xls,.xlsx" class="form-control-file " >
                </label>
              </div>
            </div>
          </div>
          <div class="col">
            <h3>Importar Excel MoviDesk</h3>
            <div class="input-group mb-3">
              <div class="custom-file-hover">
                <label class="custom-file-label-hover" for="file">
                  <input type="file" name="movidesk" id="movidesk" accept=".xls,.xlsx"  class="form-control-file ">
                </label>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <h3>Selecione o colaborador:</h3>
              <?php
              $sQuery       = mysqli_query($conn, "
              SELECT ID, NOME
               FROM COLABORADOR
               ORDER BY NOME
              ");
              ?>
              <select id="func_nome_incluir" name="func_nome_incluir" class="form-control" >
                <option >Selecione...</option>
                <?php while ($aColaborador = mysqli_fetch_array($sQuery)) { ?>
                  <option value="<?php echo $aColaborador['ID'] ?>" name="idFunc"><?php echo $aColaborador['NOME'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col">
            <br>
            <button type="submit" id="submit" name="import" class="btn btn-success btn-lg">Importar <i class="fas fa-file-import"></i></button>
            <button type="reset" class="btn btn-outline-danger btn-lg" value="Limpar">Limpar <i class="fas fa-broom"></i></button>
          </div>
        </div>
      </diV>
    </form>

    <!--Tabela para exbir o colaborador -->
    <div style="float:left" width="50%">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Colaborador</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($aColaborador = mysqli_fetch_array($sListColaborador)) {
            ?>
            <tr>
              <td>
                <?php
                echo '<a href="">' . $aColaborador['NOME'] . '</a>';
              }
              ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--Tabela para exibir os pontos do Tangerino -->
    <div style="float:left">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Total de Hora/Ponto Tangerino</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td value="">teste</td>
          </tr>
          <tr>
            <td value="">teste</td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--Tabela para exibir as horas do Movidesk -->
    <div style="float:left">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Total de Horas Apontadas</th>
            <th>Total de Horas Trabalhadas</th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td>
              <?php
              while ($aHoraApontada = mysqli_fetch_array($sListHoraApontada)) {
                echo $aHoraApontada['TOTAL_HORAS'];
              }
              ?>
            </td>
            <td>
              <?php
              while ($aHoraTrabalhada = mysqli_fetch_array($sListHoraTrabalhada)) {
                echo $aHoraTrabalhada['TOTAL_HORAS'];
              }
              ?>
            </td>
          </tr>
          <tr>
            <td value=""> teste</td>
            <td value=""> teste</td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--Tabela para exibir os pontos do Tangerino -->
    <div style="float:left">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Inatividade</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <?php
              $sDiferencaHoras = "
                        SELECT TIMEDIFF(
                          $aHoraApontada,
                          $aHoraTrabalhada
                        ) AS DIFERENCA
                         FROM MOVIDESK;";
              $sDiferenca = mysqli_query($conn, $sDiferencaHoras);

              while ($aHoraDiferenca = mysqli_fetch_array($sDiferenca)) {
                echo $aHoraDiferenca['DIFERENCA'];
              }
              ?>

            </td>
          </tr>
          <tr>
            <td value="" name="">Teste</td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>

