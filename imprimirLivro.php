<?php

//biblioteca fpdf
require 'fpdf/fpdf.php';
require 'conexao.php';

//conectar ao banco
//mysql_query($con, "SET NAMES 'utf8'");
//funcÃ§Ã£o para converter caracteres especiais com acentos
/* function converte($string){
  return  iconv("UTF-8", "ISO-8859-1",$string);
  } */
//cria um documento PDF
$fpdf = new FPDF('p', 'mm', 'A4');

$fpdf->AddPage(); //adiconar uma pÃ¡gina
//$fpdf->Image('images/marca.png');//figura
//endereco da empresa
$fpdf->setFont('arial', '', 12);
$fpdf->Cell(0, 20, "Rua Fulano de Tal, s/n, Bairro Industrial", 0, 1, 'L');

//email para contao
$fpdf->setFont('arial', '', 12);
$fpdf->Cell(0, 20, "atendimento@empresa.com.br", 0, 1, 'L');

//dÃ¡ espaco
$fpdf->ln(20);

//configura a fonte
$fpdf->setFont('arial', 'B', 18);
//$fpdf->Cell(0,5,converte("Relatorio"),0,1,'C');
//linha abaixo do Titulo relatorio
$fpdf->Cell(0, 5, "", 0, 1, 'C');

//dÃ¡ espaco
$fpdf->ln(20);

//AtÃ© aqui Ã© igual para todos...............

if ($_GET['opcao'] == '1') {//mostrar todos os filmes
  //Query: mostrar todos os filmes
  $sql = "SELECT * FROM livro";

  $dados = mysqli_query($conn, $sql);

  //varrendo o banco atras do dados do filme

  while ($linha = mysqli_fetch_assoc($dados)) {

    //configura a fonte Label...........
    $fpdf->setFont('arial', 'B', 12);
    $fpdf->Cell(70, 20, converte("Titulo"), 0, 0, 'L');

    //configura a fonte
    $fpdf->setFont('arial', 'B', 12);
    $fpdf->Cell(0, 20, $linha['titulo'], 0, 1, 'L');

    //configura a fonte Label.........
    $fpdf->setFont('arial', 'B', 12);
    $fpdf->Cell(70, 20, converte("Trailer"), 0, 0, 'L');

    //configura a fonte
    $fpdf->setFont('arial', 'B', 12);
    $fpdf->Cell(0, 20, $linha['trailer'], 0, 1, 'L');
  }//while
} elseif ($_GET['opcao'] == '2') {
  //relatorio individual pegar o 'id'
  //Query: mostrar todos os filmes
  $sql = "SELECT * FROM livro WHERE codigo=" . $_POST['codigo'];

  $dados = mysqli_query($conn, $sql);

  //varrendo o banco atras do dados do filme

  while ($linha = mysqli_fetch_assoc($dados)) {


    $fpdf->setFont('arial', 'B', 12);
    //$fpdf->Cell(70,20,converte("Codigo"),0,0,'L');
    //configura a fonte
    $fpdf->setFont('arial', 'B', 12);
    $fpdf->Cell(0, 20, $linha['codigo'], 0, 1, 'L');


    //configura a fonte Label...........
    $fpdf->setFont('arial', 'B', 12);
    //$fpdf->Cell(70,20,converte("Titulo"),0,0,'L');
    //configura a fonte
    $fpdf->setFont('arial', 'B', 12);
    $fpdf->Cell(0, 20, $linha['titulo'], 0, 1, 'L');

    //configura a fonte Label............
    $fpdf->setFont('arial', 'B', 12);
    //$fpdf->Cell(70,20,converte("Sinopse"),0,0,'L');
    //configura a fonte
    $fpdf->setFont('arial', 'B', 12);
    $fpdf->Cell(0, 20, $linha['sinopse'], 0, 1, 'L');

    //configura a fonte Label............
    $fpdf->setFont('arial', 'B', 12);
    //$fpdf->Cell(70,20,converte("Quantidade"),0,0,'L');
    //configura a fonte
    $fpdf->setFont('arial', 'B', 12);
    $fpdf->Cell(0, 20, $linha['quantidade'], 0, 1, 'L');


    //configura a fonte Label.........
    $fpdf->setFont('arial', 'B', 12);
    //$fpdf->Cell(70,20,converte("Trailer"),0,0,'L');
    //configura a fonte
    $fpdf->setFont('arial', 'B', 12);
    $fpdf->Cell(0, 20, $linha['trailer'], 0, 1, 'L');
  }//while
}

$fpdf->Output();
?>