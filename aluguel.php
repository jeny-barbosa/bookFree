<?php
session_start();
require 'conexao.php';
$iOffset = empty($_GET['pagina']) ? 0 : ($_GET['pagina'] * 10) - 10;

$query   = ""
  . "SELECT aluguel.id, livro.nome as livro, usuarios.nome as usuario, aluguel.data_inicio, aluguel.data_fim "
    . " FROM aluguel "
      . "INNER JOIN usuarios "
        . "ON usuarios.codigo = aluguel.idusuario "
      . "INNER JOIN livro "
        . "ON livro.codigo = aluguel.idlivro "
    . "WHERE 1 = 1 %s %s %s %s %s  "
    . "ORDER BY id ASC "
    . "LIMIT 10 OFFSET $iOffset";

$query  = sprintf($query
  , (isset($_POST['usuario_nome']) && $_POST['usuario_nome']) ? ' AND usuarios.nome LIKE \'%' . addslashes($_POST['usuario_nome']) . '%\'' : ''
  , (isset($_POST['email_user']) && $_POST['email_user']) ? ' AND EMAIL_USER LIKE \'%' . addslashes($_POST['email_user']) . '%\'' : ''
  , (isset($_POST['nome_livro']) && $_POST['nome_livro']) ? ' AND livro.nome LIKE \'%' . addslashes($_POST['nome_livro']) . '%\'' : ''
  , (isset($_POST['data_inicio']) && $_POST['data_inicio']) ? ' AND DATA_INICIO LIKE \'%' . addslashes($_POST['data_inicio']) . '%\'' : ''
  , (isset($_POST['data_fim']) && $_POST['data_fim']) ? ' AND DATA_FIM = ' . $_POST['data_fim'] : ''
);

$result = mysqli_query($conn, $query);
$aKeys  = array_keys($_GET);

if (in_array('pagina', $aKeys)) {
  $iPagina = $_GET['pagina'];
} else {
  $iPagina = 1;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Cadastro de Livro</title>
    <meta charset = "utf-8">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <style>
      .numero{
        text-decoration: none;
        background: #2A85B6;
        text-align: center;
        padding: 3px 0;
        display: block;
        margin: 0 2px;
        float: left;
        width: 20px;
        color: #fff;
      }
      .numero:hover, .numativo, .controle:hover{
        background: #1B3B54;
      }
      .controle{
        text-decoration: none;
        background: #2A85B6;
        text-align: center;
        padding: 3px 8px;
        display: block;
        margin: 0 3px;
        float: left;
        color: #fff;
      }
    </style>
  </head>
  <body>
    <?php include_once 'menu.php'; ?>

    <div class="container" style="width:900px;">
      <p align="center" style="font-size:32pt;">Empréstimos - BookFree </p>
      <div class="table-responsive">
        <div align="right">
          <button align="left" type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-lg btn-warning">Adicionar <span class="glyphicon glyphicon-plus"></span> </button>
          <br> <br>
          <!-- FORMULÁRIO DE PESQUISA -->
          <div align="left">
            <form method="POST" id="form-pesquisa" action="" class="form-inline">
              <div class="form-group">
                <input type="text" name="usuario_nome" id="usuario_nome" placeholder="Usuario" class="form-control-static" size="10">
              </div>
              <div class="form-group">
                <label class="sr-only">livro</label>
                <input type="text" name="nome_livro" id="nome_livro" placeholder=" Livro " class="form-control-static"  size="10">
              </div>
              <div class="form-group">
                <label class="sr-only">livro</label>
                <input type="date" name="data_inicio" id="data_inicio" placeholder=" Livro " class="form-control-static"  size="10">
              </div>

              <button type="submit" class="btn btn-lg btn-primary" name="enviar" value="Pesquisar"  size="10">Pesquisar</button>
            </form>
          </div>
          <br/>
          <div id="employee_table">
            <table class="table table-striped table-bordered">
              <tr align="center">
                <th width="5%" style="text-align: center; font-size: 14pt;">ID</th>
                <th width="30%" style="text-align: center; font-size: 14pt;">Nome do Livro</th>
                <th width="20%" style="text-align: center; font-size: 14pt;">Usuario</th>
                <th width="15%" style="text-align: center; font-size: 14pt;">Data Inicio</th>
                <th width="15%" style="text-align: center; font-size: 14pt;">Data Fim</th>
                <th width="60%" style="text-align: center; font-size: 14pt;">Ação</th>
              </tr>

              <?php
              while ($row = mysqli_fetch_array($result)) {
              ?>
              <tr>
                  <td style="text-align: center;"><?php echo $row['id']; ?></td>
                  <td style="font-size: 12pt;"><?php echo $row['livro']; ?></td>
                  <td style="font-size: 12pt;"><?php echo $row['usuario']; ?></td>
                  <td style="font-size: 12pt;"><?php echo date('d/m/Y', strtotime($row['data_inicio'])); ?></td>
                  <td style="font-size: 12pt;"><?php echo date('d/m/Y', strtotime($row['data_fim'])); ?></td>
                  <td align="center">
                    <button type="button" name="view" value="view" id="<?php echo $row['id']; ?>" class="btn btn-success  view_data"><span class="glyphicon glyphicon-eye-open"></span></button>
                    <button type="button" name="delete" value="delete" id="<?php echo $row['id']; ?>" class="excluirReg btn btn-danger "><span class="glyphicon glyphicon-trash"></span></button>
                  </td>
                </tr>

              <?php
              }
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div align="center">
      <a href="aluguel.php" class="btn btn-default <?= ($iPagina == 1) ? 'btn-lg btn-primary' : '' ?>"> 1</a>
      <a href="aluguel.php?pagina=2" class="btn btn-default <?= ($iPagina == 2) ? 'btn-lg btn-primary' : '' ?> "> 2 </a>
      <!--<a href="aluguel.php.php?pagina=3" class="btn btn-default <?= ($iPagina == 3) ? 'btn-lg btn-primary' : '' ?>"> 3 </a>
      <a href="aluguel.php.php?pagina=4" class="btn btn-default <?= ($iPagina == 4) ? 'btn-lg btn-primary' : '' ?>"> 4 </a>
      <a href="aluguel.php.php?pagina=5" class="btn btn-default <?= ($iPagina == 5) ? 'btn-lg btn-primary' : '' ?>"> 5 </a>
      <a href="aluguel.php.php?pagina=6" class="btn btn-default <?= ($iPagina == 6) ? 'btn-lg btn-primary' : '' ?>"> 6 </a>
      <a href="aluguel.php.php?pagina=7" class="btn btn-default <?= ($iPagina == 7) ? 'btn-lg btn-primary' : '' ?>"> 7 </a> -->
    </div>
    <!--Modal Adicionar -->
    <div id="add_data_Modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Adicionar Aluguel</h4>
          </div>
          <div class="modal-body">
            <form name="form1" id="form1" method="post"  >
              <?php
              $query = mysqli_query($conn, ""
                . "SELECT codigo, nome "
                  . "FROM usuarios "
                  . "ORDER BY nome");
              ?>
              <label for="">Selecione um usuario</label>
              <select id="usuario_nome_incluir" name="usuario_nome_incluir">
                <option >Selecione...</option>
                <?php while ($user  = mysqli_fetch_array($query)) { ?>
                  <option value="<?php echo $user['codigo'] ?>"><?php echo $user['nome'] ?></option>
                <?php } ?>
              </select>  <br> <br>

              <?php
              $query = mysqli_query($conn, ""
                . "SELECT codigo, nome "
                  . "FROM livro "
                  . "ORDER BY nome");
              ?>
              <label for="">Selecione um livro</label>
              <select id="nome_livro_incluir" name="nome_livro_incluir">
                <option>Selecione...</option>
                <?php while ($livro = mysqli_fetch_array($query)) { ?>
                  <option value="<?php echo $livro['codigo'] ?>"><?php echo $livro['nome'] ?> </option>
                <?php } ?>
              </select> <br> <br>
              <p id="msg"></p>
              <label>Data Inicio</label>
              <input type="date" name="data_inicio-incluir" id="data_inicio-incluir">

              <label>Data Fim</label>
              <input type="date" name="data_fim-incluir" id="data_fim-incluir">

              <div align="right" style="margin-right: 15px">
                <input type="button" id="enviar" value="Adicionar" class="btn btn-primary"  onclick="verificarData()" />
              </div>
              <div id="resultado"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--Modal Visualizar -->
    <div id="dataModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="font-size: 16pt;">Detalhes do Aluguel <?php echo $row['id']; ?> </h4>
          </div>
          <div class="modal-body" id="employee_detail">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>
    <!--Modal Excluir -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog" role="document"></div>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Excluir Livro </h4>
          </div>
          <div class="modal-body">
            <p class="sucess-message">Tem certeza de que quer excluir o registro?</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success delete-confirm" type="button">Sim</button>
            <button class="btn btn-default" type="button" data-dismiss="modal">Não</button>
          </div>
          <div id="result"></div>
        </div>
      </div>
    </div>
    <script>
      /* Script Adicionar */
      $(document).ready(function () {
        $('#enviar').click(function () {
          if ($('#usuario_nome_incluir').children("option:selected").val() === "Selecione...") {
            alert("Selecione um Usuario");
          } else if ($('#nome_livro_incluir').children("option:selected").val() === "Selecione...") {
            alert("Selecione um Livro");
          } else if ($('#data_inicio-incluir').datepicker().val() === "") {
            alert("Informe a data de Locacao");
          } else if ($('#data_fim-incluir').datepicker().val() === "") {
            alert("Informe a data de devolução");
          } else
          {
            $.ajax({
              url: 'inserirAluguel.php',
              type: 'POST',
              data: {
                'idusuario': $('#usuario_nome_incluir').children('option:selected').val()
                , 'idlivro': $('#nome_livro_incluir').children("option:selected").val()
                , 'data_inicio': $('#data_inicio-incluir').datepicker().val()
                , 'data_fim': $('#data_fim-incluir').datepicker().val()
              },
              success: function (data) {
                $('#resultado').html(data);
                //alert("Dados inseridos");
                //location.href = "aluguel.php";
                //window.close();
              }
            });
          }
        });
      });
      /* Script Detalhes */
      $(document).on('click', '.view_data', function () {
        var id = $(this).attr("id");
        if (id !== '')
        {
          $.ajax({
            url: "detalhesAluguel.php",
            method: "POST",
            data: {id: id},
            dataType: "html",
            success: function (data) {
              $('#employee_detail').html(data);
              $('#dataModal').modal('show');
            }
          });
        }
      });
      /* Script Excluir */
      var id;
      $('.excluirReg').click(function () {
        id = $(this).attr('id');
        $('.deleteID').val(id)
        $("#myModal").modal('show');
      });
      $('.delete-confirm').click(function () {
        if (id != '') {
          $.ajax({
            url: 'excluirAluguel.php',
            data: {'id': id},
            method: "post",
            success: function (data) {
              $('#result').html(data);
              alert("Dados Excluidos");
              location.href = "aluguel.php";
              window.close();
            }
          });
        }
      });

      /*VALIDAR DATAS */
      var dataInicio, dataFinal, msg;

      window.onload = function () {
        dataInicio = document.getElementById("data_inicio-incluir");
        dataFinal = document.getElementById("data_fim-incluir");
        msg = document.getElementById("msg");
      };

      function verificarData()
      {
        let dataI, dataF;

        dataI = dataInicio.value;
        dataF = dataFinal.value;

        dataI = dataI.replace(/[^0-9-]/g, "").trim();
        dataF = dataF.replace(/[^0-9-]/g, "").trim();

        if (dataI == "" && dataI.length != 10)
        {
          msg.innerHTML = ("A data de retirada é invalida.");
          return false;
        }

        if (dataF == "" && dataF.length != 10)
        {
          ﻿msg.innerHTML = ("A data de entrega é invalida.");
          return false;
        }

        if (dataI != "" || dataF != "" || dataI.length == 10 || dataF.length == 10)
        {
          dataI = new Date(dataI);
          dataF = new Date(dataF);
          if (dataF <= dataI)
          {
            msg.innerHTML = ("A data entrega não pode ser menor ou igual a data da retirada.");
            return false;
          }
          dataI.setDate(dataI.getDate() + 7);

          if (dataF > dataI)
          {
            msg.innerHTML = ("A data de entrega não pode ser maior que 7 dias da data da retirada.");
            return false;
          }

          msg.innerHTML = ("Período válido");
          return true;
        }
      }
    </script>
  </body>
</html>