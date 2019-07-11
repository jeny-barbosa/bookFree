<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Relatório Pedidos</title>
<?php require_once 'menu.php'; ?>
<body> 
    <h1 align="center">Relatórios dos Empréstimos - BookFree </h1> <br>
    <div class="container" style="width:600px;">
        <table class=" table-striped table-bordered" align="center"> 
            <tr>
                <th width="5%" style="font-size:40px; text-align: center;">Alugados</th>
                <th width="5%" style="font-size:40px; text-align: center;" >PDF <i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i></th></th> 
                <th width="5%" style="font-size:40px; text-align: center;">XLS <i class="fa fa-file-excel-o" style="font-size:48px;color:green"></i></th>
            </tr>
            <tr>
                <td style="font-size:30px;">&nbsp; Geral </td>
                <td align="center"><br><a href="aluguelRelatorioPDF.php" target="_blank" class="btn btn-lg btn-danger"> <span class="glyphicon glyphicon-user"></span></a> <br></td>
                <td align="center" ><br><a href="aluguelRelatorioXLS.php" target="_blank" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-user"></span></a><br></td>      
            </tr>

        </table>
    </div>
</body>        