<?php
session_start();
require 'conexao.php';
$iOffset = empty($_GET['pagina']) ? 0 : ($_GET['pagina'] * 15) - 15;
$query = "SELECT * FROM usuarios WHERE 1 = 1 %s %s  ORDER BY codigo ASC LIMIT 10 OFFSET $iOffset";

$query = sprintf($query
        , (isset($_POST['nome']) && $_POST['nome']) ? ' AND NOME LIKE \'%' . addslashes($_POST['nome']) . '%\'' : ''
        , (isset($_POST['codigo']) && $_POST['codigo']) ? ' AND CODIGO = ' . $_POST['codigo'] : ''
);
$result = mysqli_query($conn, $query);
$aKeys = array_keys($_GET);
if (in_array('pagina', $aKeys)) {
    $iPagina = $_GET['pagina'];
} else {
    $iPagina = 1;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cadastro de Usuário</title>
        <meta charset = "utf-8">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
        <meta name="google-signin-client_id" content="444094126116-nkdc6oda1qb2ro0uq1mi5rg8dp8t23vd.apps.googleusercontent.com">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        
        <div class="container" style="width:700px;"><br>
            <h1 align="center">Usuários - BookFree </h1>
            <div class="table-responsive">
                <div align="right">
                    <!--<a href="#" onclick="signOut();" class="btn btn-danger">Sair <span class="glyphicon glyphicon-log-out"></span></a> -->
                    <div align="left"><br>
                        <div align="right">
                        <!--    <button type="button" name="relatorios" id="relatorios" data-toggle="modal" data-target="#relatorio_Modal" class="btn btn-success"> <span class="glyphicon glyphicon-folder-open"></span> Relatórios Gerais</button> &nbsp;-->
                            <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Adicionar <span class="glyphicon glyphicon-plus"></span> </button> 
                        </div>
                    </div>
                    <br>
                    <!-- FORMULÁRIO DE PESQUISA -->
                    <div align="left">
                        <form method="POST" id="form-pesquisa" action="" class="form-inline">
                            <div class="form-group">
                                <label class="sr-only">Nome</label>
                                <input type="text" name="nome" id="nome" placeholder="Nome" class="form-control-static">
                            </div>
                            <div class="form-group">
                                <label class="sr-only">Codigo</label>
                                <input type="text" name="codigo" id="codigo" placeholder="E-mail" class="form-control-static">
                            </div>
                            <button type="submit" class="btn btn-primary" name="enviar" value="Pesquisar">Pesquisar</button> 
                        </form>
                    </div>
                    <!--
                    <script>
                        function signOut() {
                            var auth2 = gapi.auth2.getAuthInstance();
                            console.log(auth2);
                            auth2.signOut().then(function () {
                                deleteAllCookies();
                            });
                            auth2.disconnect();
                            setTimeout(function () {
                                location.href = "index.php";
                            }, 2000);
                        }
                        function deleteAllCookies() {
                            var cookies = document.cookie.split(";");

                            for (var i = 0; i < cookies.length; i++) {
                                var cookie = cookies[i];
                                var eqPos = cookie.indexOf("=");
                                var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
                            }
                        }
                        function onLoad() {
                            gapi.load('auth2', function () {
                                gapi.auth2.init();
                            });
                        }
                    </script>-->
                    <br/><br/>
                    <div id="employee_table">
                        <table class="table table-striped table-bordered">
                            <tr align="center">
                                <th width="5%" style="text-align: center; font-size: 14pt;">Código</th>
                                <th width="50%" style="text-align: center; font-size: 14pt;">Usuários</th>
                                <th width="30%" style="text-align: center; font-size: 14pt;">Ação</th>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr >
                                    <td style="text-align: center; font-style: oblique;"><?php echo $row['codigo']; ?></td>
                                    <td style="font-size: 14pt; font-style: oblique;"><?php echo $row['nome']; ?></td>
                                    <td align="center">
                                        <button type="button" name="view" value="view" codigo="<?php echo $row['codigo']; ?>" class="btn btn-success  view_data"><span class="glyphicon glyphicon-eye-open"></span></button>
                                        <button type="button" name="edit" value="Edit" codigo="<?php echo $row['codigo']; ?>" class="btn btn-info edit_data"><span class="glyphicon glyphicon-cog"></span></button>
                                        <button type="button" name="pass" value="pass" codigo="<?php echo $row['codigo']; ?>" class="btn btn-warning pass_data"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <button type="button" name="delete" value="delete" codigo="<?php echo $row['codigo']; ?>" class="excluirReg btn btn-danger "><span class="glyphicon glyphicon-trash"></span></button>
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
            <a href="cadastroUsuario.php" class="btn btn-default <?= ($iPagina == 1) ? 'btn-lg btn-primary' : '' ?>"> 1</a>
            <a href="cadastroUsuario.php?pagina=2" class="btn btn-default <?= ($iPagina == 2) ? 'btn-lg btn-primary' : '' ?> disabled"> 2 </a>
              <!--  <a href="cadastroUsuario.php?pagina=3" class="btn btn-default <?/*= ($iPagina == 3) ? 'btn-lg btn-primary' : '' ?>"> 3 </a>
              <a href="cadastroUsuario.php?pagina=4" class="btn btn-default <?/*= ($iPagina == 4) ? 'btn-lg btn-primary' : '' ?>"> 4 </a>
              <a href="cadastroUsuario.php?pagina=5" class="btn btn-default <?/*= ($iPagina == 5) ? 'btn-lg btn-primary' : '' */?>"> 5 </a>   -->      
        </div>
        <!--Modal Adicionar -->
        <div id="add_data_Modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Adicionar Novo Usuário</h4>
                    </div>
                    <div class="modal-body">
                        <form name="form1" id="form1" class="form-horizontal">
                            <div class="form-group">
                                <label for="nome-add" class="col-sm-2 control-label"> Nome do Usuário: *</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nome-add" id="nome-add" class="form-control" placeholder="Fulano de Tal" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email-add" class="col-sm-2 control-label"> E-mail: *</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email-add" id="email-add" class="form-control" placeholder="fulanodetal@exemplo.com" required x-moz-errormessage="Ops. Não esqueça de preencher este campo."/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="senha-add" class="col-sm-2 control-label"> Senha: *</label>
                                <div class="col-sm-3">
                                    <input type="password" name="senha-add" id="senha-add" class="form-control" placeholder="••••••••" required>
                                </div>
                                <label for="senha-confirma" class="col-sm-2 control-label">Confirma Senha: *</label>
                                <div class="col-sm-3">
                                    <input type="password" name="senha-confirma" id="senha-confirma" class="form-control" placeholder="••••••••" required>
                                </div>
                                <div align="right" style="margin-right: 15px">
                                    <input type="button" id="enviar" value="Adicionar" class="btn btn-primary" />
                                </div>
                                <div id="resultado"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal Relatórios 
        <div id="relatorio_Modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title" style="font-size:30px;">Relatórios Gerais</h>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-bordered">
                            <tr align="center">
                                <th style="font-size:40px; text-align: center;" >PDF <i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i></th>
                                <th style="font-size:40px; text-align: center;">XLS <i class="fa fa-file-excel-o" style="font-size:48px;color:green"></i></th>
                            </tr>
                            <tr>
                                <td align="center">
                                    <a href="livroRelatorioPDF.php" target="_blank" class="btn btn-primary">Todos os Livros <span class="glyphicon glyphicon-book"></span></a><br><br>
                                    <a href="autorRelatorioPDF.php" target="_blank" class="btn btn-success">Todos os Autores <span class="glyphicon glyphicon-user"></span></a><br><br>
                                    <a href="edicaoRelatorioPDF.php" target="_blank" class="btn btn-warning">Todas as Edições <span class="glyphicon glyphicon-calendar"></span></a><br><br>
                                    <a href="geralRelatorioPDF.php"  target="_blank" class="btn btn-danger">Geral <span class="glyphicon glyphicon-credit-card"></span></a><br><br>
                                </td>
                                <td align="center">
                                    <a href="livroRelatorioXLS.php" target="_blank" class="btn btn-primary">Todos os Livros <span class="glyphicon glyphicon-book"></span></a><br><br>
                                    <a href="autorRelatorioXLS.php" target="_blank" class="btn btn-success">Todos os Autores <span class="glyphicon glyphicon-user"></span></a><br><br>
                                    <a href="edicaoRelatorioXLS.php" target="_blank" class="btn btn-warning">Todas as Edições <span class="glyphicon glyphicon-calendar"></span></a><br><br>
                                    <a href="geralRelatorioXLS.php" target="_blank" class="btn btn-danger">Geral <span class="glyphicon glyphicon-credit-card"></span></a><br><br>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>-->
        <!--Modal Visualizar -->
        <div id="dataModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Detalhe do Usuário<?php echo $row['codigo']; ?> </h4>
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
                        <h4 class="modal-title" id="myModalLabel">Excluir Usuário</h4>
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
        <!--Modal Atualizar -->
        <div id="ed_data_Modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Atualizar dados do Usuário</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="edit_form">
                            <label>Livro</label>
                            <input type="text" name="nome" id="nome-insert" class="form-control" value="<?php echo $row['nome']; ?>"/>
                            <br />
                            <label>Autor</label>
                            <input type="text" name="email" id="email-insert" class="form-control" />
                            <br />
                            <input type="hidden" name="codigo" id="codigo-insert" />
                            <input type="submit" name="edit" id="edit" value="Editar" class="btn btn-success" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal Atualizar Senha-->
        <div id="up_data_Modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Atualizar Senha do Usuário</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="up_form">                         
                            <div class="col-sm-5">
                                Senha Atual * <input type="password" name="senha-up" id="senha-up" class="form-control" placeholder="••••••••" required="true">
                            </div></br></br></br></br>
                            <div class="col-sm-5">
                                Nova Senha * <input type="password" name="senha-nova" id="senha-nova" class="form-control" placeholder="••••••••" required="true">
                            </div>

                            <div class="col-sm-5">
                                Confirma Nova Senha *<input type="password" name="senhaCNova" id="senhaCNova" class="form-control" placeholder="••••••••" required="true">
                            </div></br></br>
                            <input type="hidden" name="codigo" id="codigo-insert" />
                            <input type="submit" name="edit" id="edit" value="Editar" class="btn btn-success" />
                            <br>
                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
        <script>
            /* Script Adicionar */
            $(document).ready(function () {
                $('#enviar').click(function () {

                    if ($('#nome-add').val() === '') {
                        alert("Digite o nome do Usuário");
                    }
                    else if ($('#email-add').val() === '') {
                        alert("Digite o E-mail");
                    }
                    else if ($('#senha-add').val() === '') {
                        alert("Digite a Senha");
                    }
                    else if ($('#senha-add').val() !== $('#senha-confirma').val()) {
                        alert("Senhas Diferentes");
                    }
                    else
                    {
                        $.ajax({
                            url: 'inserirUsuario.php',
                            type: 'POST',
                            data: 'nome-add=' + $('#nome-add').val() + '&email-add=' + $('#email-add').val() + '&senha-add=' + $('#senha-add').val(),
                            success: function (data) {
                                $('#resultado').html(data);
                                alert("Dados inseridos");
                                location.href = "cadastroUsuario.php";
                                window.close();
                            }
                        });
                    }
                });
            });
            /* Script Atualizar Senha */
            $('#up_form').on("submit", function (event) {
              event.preventDefault();
                if ($('#senha-nova').val() === '') {
                    alert("Digite a Senha");
                }
                else if ($('#senha-nova').val() !== $('#senhaCNova').val()) {
                    alert("Senhas Diferentes");
                }
                else
                {
                    $.ajax({
                        url: "atualizarSenhaUser.php",
                        method: "POST",
                        dataType: "json",
                        data: $('#up_form').serialize(),
                        beforeSend: function () {
                            $('#edit').val("Atualizado");
                            alert("Dados Atualizados");
                            location.href = "cadastroUsuario.php";
                            window.close();
                        },
                        success: function (data) {
                            $('#up_form')[0].reset();
                            $('#up_data_Modal').modal('hide');
                            $('#employee_table').html(data);
                        }
                    });
                }
            });
          $(document).ready(function () {
                $('#add').click(function () {
                    $('#insert').val("Insert");
                });
                $(document).on('click', '.pass_data', function () {
                    var codigo = $(this).attr("codigo");
                    $.ajax({
                        url: "buscarUsuario.php",
                        method: "POST",
                        data: {'codigo': codigo},
                        dataType: "json",
                        success: function (data) {
                            $('#senha-nova').val(data.senha);
                            //$('#email-insert').val(data.email);
                            $('#codigo-insert').val(data.codigo);
                            $('#pass_data').val("Editar");
                            $('#up_data_Modal').modal('show');
                        }
                    });
                });
            });


            /* Script Detalhes */
            $(document).on('click', '.view_data', function () {
                var codigo = $(this).attr("codigo");
                if (codigo !== '')
                {
                    $.ajax({
                        url: "detalhesUsuarios.php",
                        method: "POST",
                        data: {codigo: codigo},
                        dataType: "html",
                        success: function (data) {
                            $('#employee_detail').html(data);
                            $('#dataModal').modal('show');
                        }
                    });
                }
            });
            /* Script Excluir */
            var codigo;
            $('.excluirReg').click(function () {
                codigo = $(this).attr('codigo');
                $('.deleteID').val(codigo)
                $("#myModal").modal('show');
            });
            $('.delete-confirm').click(function () {
                if (codigo != '') {
                    $.ajax({
                        url: 'excluirUsuario.php',
                        data: {'codigo': codigo},
                        method: "post",
                        success: function (data) {
                            $('#result').html(data);
                            alert("Dados Excluidos");
                            location.href = "cadastroUsuario.php";
                            window.close();
                        }
                    });
                }
            });
            /* Script Atualizar */
            $('#edit_form').on("submit", function (event) {
                //cancelando submit do form
                event.preventDefault();
                if ($('#nome-insert').val() === "") {
                    alert("Digite o nome do Livro");
                }
                else if ($('#email-insert').val() === '') {
                    alert("Digite o nome do Autor");
                }
                else
                {
                    $.ajax({
                        url: "atualizarUsuario.php",
                        method: "POST",
                        dataType: "json",
                        data: $('#edit_form').serialize(),
                        beforeSend: function () {
                            $('#edit').val("Atualizado");
                            alert("Dados Atualizados");
                            location.href = "cadastroUsuario.php";
                            window.close();
                        },
                        success: function (data) {
                            $('#edit_form')[0].reset();
                            $('#ed_data_Modal').modal('hide');
                            $('#employee_table').html(data);
                        }
                    });
                }
            });
            $(document).ready(function () {
                $('#add').click(function () {
                    $('#insert').val("Insert");
                });
                $(document).on('click', '.edit_data', function () {
                    var codigo = $(this).attr("codigo");
                    $.ajax({
                        url: "buscarUsuario.php",
                        method: "POST",
                        data: {'codigo': codigo},
                        dataType: "json",
                        success: function (data) {
                            $('#nome-insert').val(data.nome);
                            $('#email-insert').val(data.email);
                            $('#codigo-insert').val(data.codigo);
                            $('#edit_data').val("Editar");
                            $('#ed_data_Modal').modal('show');
                        }
                    });
                });
            });
        </script>
    </body>
</html>