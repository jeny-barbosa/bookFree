<?php

require 'conexao.php';

$aArquivoTangerino = isset($_FILES['tangerino']) ? $_FILES['tangerino'] : FALSE;
$aArquivoMovidesk  = isset($_FILES['movidesk']) ? $_FILES['movidesk'] : FALSE;

$sIdFuncionario    = $_POST['func_nome_incluir'];
$sQuery            = mysqli_query($conn, "SELECT nome from colaborador where id='$sIdFuncionario'");
$sResult           = mysqli_fetch_array($sQuery);
$sNomeFuncionario = $sResult[0];

if (!empty($_FILES['tangerino'])) {
  require_once './PHPExcel/Classes/PHPExcel.php';
  $sArquivoTang  = $_FILES['tangerino']['tmp_name'];
  $inputFileType = PHPExcel_IOFactory::identify($sArquivoTang);
  $objReader     = PHPExcel_IOFactory::createReader($inputFileType);
  $objPHPExcel   = $objReader->load($sArquivoTang);
  $sheet         = $objPHPExcel->getSheet(0);
  $highestRow    = $sheet->getHighestRow();
  $highestColumn = $sheet->getHighestColumn();

  $aArquivoTangerino = $_FILES['tangerino'];

  for ($row = 1; $row <= $highestRow; $row++) {
    $sDataPonto = $sheet->getCell("A" . $row)->getValue();
    $sHoraPonto = $sheet->getCell("B" . $row)->getValue();
    $sSqlInsert   = "
      INSERT INTO TANGERINO (
        DATA_PONTO,
        HORA_PONTO,
        COLABORADOR
       ) VALUES(
          '$sDataPonto',
          '$sHoraPonto',
          '$sNomeFuncionario'
      )";

   mysqli_query($conn, $sSqlInsert);

   $sSqlUpdate = "
      UPDATE TANGERINO
       SET
        HORA_PONTO = CONVERT(HORA_PONTO, TIME)
    ";

    mysqli_query($conn, $sSqlUpdate);
  }
}
if (!empty($_FILES['movidesk'])) {
  require_once './PHPExcel/Classes/PHPExcel.php';
  $sArquivoMovi  = $_FILES['movidesk']['tmp_name'];
  $inputFileType = PHPExcel_IOFactory::identify($sArquivoMovi);
  $objReader     = PHPExcel_IOFactory::createReader($inputFileType);
  $objPHPExcel   = $objReader->load($sArquivoMovi);
  $sheet         = $objPHPExcel->getSheet(0);
  $highestRow    = $sheet->getHighestRow();
  $highestColumn = $sheet->getHighestColumn();

  $aArquivoMovidesk = $_FILES['movidesk'];

  for ($row = 2; $row <= $highestRow; $row++) {
    $sData            = $sheet->getCell("N" . $row)->getValue();
    $sHoraInicio     = $sheet->getCell("O" . $row)->getValue();
    $sHoraFim        = $sheet->getCell("P" . $row)->getValue();
    $sHoraApontada   = $sheet->getCell("Q" . $row)->getValue();
    $sHoraTrabalhada = $sheet->getCell("R" . $row)->getValue();
    $sSqlMovi        = "
      INSERT INTO movidesk (
        DATA_PONTO,
        HORA_INICIO,
        HORA_FIM,
        HORA_APONTADA,
        HORA_TRABALHADA,
        COLABORADOR
      ) VALUES (
        '$sData',
        '$sHoraInicio',
        '$sHoraFim',
        '$sHoraApontada',
        '$sHoraTrabalhada',
        '$sNomeFuncionario'
      )";

    mysqli_query($conn, $sSqlMovi);
  }
}
echo "<script>
  window.location = './principal.php';
  </script>
  ";



