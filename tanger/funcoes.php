<?php

require 'conexao.php';

//COLABORADOR
$sQueryColaborador = "
      SELECT ID, NOME
        FROM COLABORADOR
        ORDER BY NOME
      ";
$sListColaborador  = mysqli_query($conn, $sQueryColaborador);

//HORAS APONTADAS
$sSomaHoraApontada = "
      SELECT COLABORADOR, SEC_TO_TIME(
        SUM(
         TIME_TO_SEC(HORA_APONTADA)
        )
      ) AS TOTAL_HORAS
       FROM MOVIDESK;";

$sListHoraApontada = mysqli_query($conn, $sSomaHoraApontada);

//$sHoraApontada = $aHoraApontada['TOTAL_HORAS'];


//HORAS TRABALHADAS
$sSomaHoraTrabalhada = "
      SELECT COLABORADOR, SEC_TO_TIME(
        SUM(
         TIME_TO_SEC(HORA_TRABALHADA)
        )
      ) AS TOTAL_HORAS
       FROM MOVIDESK;";
$sListHoraTrabalhada = mysqli_query($conn, $sSomaHoraTrabalhada);
//$sHoraTrabalhada = $aHoraTrabalhada['TOTAL_HORAS'];

//DIFERENÇA ENTRE HORAS



/*$sDiferencaHoras = "
  SELECT TIMEDIFF(
    $sListHoraApontada,
    $sListHoraTrabalhada
  )
   FROM MOVIDESK;";

$sDiferenca = mysqli_query($conn, $sDiferencaHoras);*/
//$sListaHora = $sListHoraTrabalhada;

 /*while ($aHoraApontada = mysqli_fetch_array($sListHoraApontada)) {

  if($sListColaborador == ){
 echo '<a href="">' . $aHoraApontada['TOTALHORAS'] . '</a>';
}
*/