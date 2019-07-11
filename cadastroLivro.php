<?php
session_start();
require 'conexao.php';
$iOffset = empty($_GET['pagina']) ? 0 : ($_GET['pagina'] * 10) - 10;
$query = "SELECT * FROM livro WHERE 1 = 1 %s %s %s ORDER BY codigo ASC LIMIT 10 OFFSET $iOffset";

$query = sprintf($query
        , (isset($_POST['nome']) && $_POST['nome']) ? ' AND NOME LIKE \'%' . addslashes($_POST['nome']) . '%\'' : ''
        , (isset($_POST['autor']) && $_POST['autor']) ? ' AND AUTOR LIKE \'%' . addslashes($_POST['autor']) . '%\'' : ''
        , (isset($_POST['edicao']) && $_POST['edicao']) ? ' AND EDICAO = ' . $_POST['edicao'] : ''
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
        <title>Cadastro de Livro</title>
        <meta charset = "utf-8">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
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
        <div class="container" style="width:700px;">
            <p align="center" style="font-size:32pt;">Livros - BookFree </p>
            <div class="table-responsive">
                <div align="right">
                    <button align="left" type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-lg btn-warning">Adicionar <span class="glyphicon glyphicon-plus"></span> </button> 
                    <br> <br>
                    <!-- FORMULÁRIO DE PESQUISA -->
                    <div align="left">
                        <form method="POST" id="form-pesquisa" action="" class="form-inline">
                            <div class="form-group">
                                <input type="text" name="nome" id="nome" placeholder=" Livro " class="form-control-static" size="10">
                            </div>
                            <div class="form-group">
                                <label class="sr-only">Autor</label>
                                <input type="text" name="autor" id="autor" placeholder=" Autor " class="form-control-static"  size="10">
                            </div>
                            <div class="form-group mx-sm-3">
                                <label class="sr-only">Edicao</label>
                                <input type="text" name="edicao" id="edicao" placeholder=" 1500 " class="form-control-static"  size="10">
                            </div>
                            <button type="submit" class="btn btn-lg btn-primary" name="enviar" value="Pesquisar"  size="10">Pesquisar</button> 
                        </form>
                    </div>
                    <br/>
                    <div id="employee_table">
                        <table class="table table-striped table-bordered">
                            <tr align="center">
                                <th width="5%" style="text-align: center; font-size: 14pt;">Código</th>
                                <th width="50%" style="text-align: center; font-size: 14pt;">Nome do Livro</th>
                                <th width="20%" style="text-align: center; font-size: 14pt;">Ação</th>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr >
                                    <td style="text-align: center; font-style: oblique;"><?php echo $row['codigo']; ?></td>
                                    <td style="font-size: 14pt; font-style: oblique;"><?php echo $row['nome']; ?></td>
                                    <td align="center">
                                        <button type="button" name="view" value="view" codigo="<?php echo $row['codigo']; ?>" class="btn btn-success  view_data"><span class="glyphicon glyphicon-eye-open"></span></button>
                                        <button type="button" name="edit" value="Edit" codigo="<?php echo $row['codigo']; ?>" class="btn btn-info edit_data"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <button type="button" name="delete" value="delete" codigo="<?php echo $row['codigo']; ?>" class="excluirReg btn btn-dark "><span class="glyphicon glyphicon-trash"></span></button>
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
            <a href="cadastroLivro.php" class="btn btn-default <?= ($iPagina == 1) ? 'btn-lg btn-primary' : '' ?>"> 1</a>
            <a href="cadastroLivro.php?pagina=2" class="btn btn-default <?= ($iPagina == 2) ? 'btn-lg btn-primary' : '' ?>"> 2 </a>
            <a href="cadastroLivro.php?pagina=3" class="btn btn-default <?= ($iPagina == 3) ? 'btn-lg btn-primary' : '' ?>"> 3 </a>
            <a href="cadastroLivro.php?pagina=4" class="btn btn-default <?= ($iPagina == 4) ? 'btn-lg btn-primary' : '' ?>"> 4 </a>
            <a href="cadastroLivro.php?pagina=5" class="btn btn-default <?= ($iPagina == 5) ? 'btn-lg btn-primary' : '' ?>"> 5 </a>  
            <a href="cadastroLivro.php?pagina=6" class="btn btn-default <?= ($iPagina == 6) ? 'btn-lg btn-primary' : '' ?>"> 6 </a> 
            <a href="cadastroLivro.php?pagina=7" class="btn btn-default <?= ($iPagina == 7) ? 'btn-lg btn-primary' : '' ?>"> 7 </a> 
        </div>
        <!--Modal Adicionar -->
        <div id="add_data_Modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Adicionar novo livro</h4>
                    </div>
                    <div class="modal-body">
                        <form name="form1" id="form1" class="form-horizontal">
                            <div class="form-group">
                                <label for="nome-add" class="col-sm-2 control-label"> Nome do Livro: *</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nome-add" id="nome-add" class="form-control" placeholder="Fulano de Tal" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="autor-add" class="col-sm-2 control-label"> Autor: *</label>
                                <div class="col-sm-10">
                                    <input type="text" name="autor-add" id="autor-add" class="form-control" placeholder="Ciclano de Tal" required x-moz-errormessage="Ops. Não esqueça de preencher este campo."/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edicao-add" class="col-sm-2 control-label"> Edição: *</label>
                                <div class="col-sm-3">
                                    <input type="number" name="edicao-add" id="edicao-add" class="form-control" placeholder="1500" required>
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

        <!--Modal Visualizar -->
        <div id="dataModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Detalhe do Livro <?php echo $row['codigo']; ?> </h4>
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
                        <h4 class="modal-title" id="myModalLabel">Excluir Livro</h4>
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
                        <h4 class="modal-title">Atualizar Livro</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="edit_form">
                            <label>Livro</label>
                            <input type="text" name="nome" id="nome-insert" class="form-control" value="<?php echo $row['nome']; ?>"/>
                            <br />
                            <label>Autor</label>
                            <input type="text" name="autor" id="autor-insert" class="form-control" />
                            <br />
                            <label>Edição</label>
                            <input type="text" name="edicao" id="edicao-insert" class="form-control" />
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
        <script>
            /* Script Adicionar */
            $(document).ready(function () {
                $('#enviar').click(function () {

                    if ($('#nome-add').val() === "") {
                        alert("Digite o nome do Livro");
                    }
                    else if ($('#autor-add').val() === '') {
                        alert("Digite o nome do Autor");
                    }
                    else if ($('#edicao-add').val() === '') {
                        alert("Digite a Edição");
                    }
                    else
                    {
                        $.ajax({
                            url: 'inserir.php',
                            type: 'POST',
                            data: 'nome-add=' + $('#nome-add').val() + '&autor-add=' + $('#autor-add').val() + '&edicao-add=' + $('#edicao-add').val(),
                            success: function (data) {
                                $('#resultado').html(data);
                                alert("Dados inseridos");
                                location.href = "cadastroLivro.php";
                                window.close();
                            }
                        });
                    }
                });
            });
            /* Script Detalhes */
            $(document).on('click', '.view_data', function () {
                var codigo = $(this).attr("codigo");
                if (codigo !== '')
                {
                    $.ajax({
                        url: "detalhes.php",
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
                        url: 'excluir.php',
                        data: {'codigo': codigo},
                        method: "post",
                        success: function (data) {
                            $('#result').html(data);
                            alert("Dados Excluidos");
                            location.href = "cadastroLivro.php";
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
                else if ($('#autor-insert').val() === '') {
                    alert("Digite o nome do Autor");
                }
                else if ($('#edicao-insert').val() === '') {
                    alert("Digite a Edição");
                }
                else
                {
                    $.ajax({
                        url: "atualizar.php",
                        method: "POST",
                        dataType: "json",
                        data: $('#edit_form').serialize(),
                        beforeSend: function () {
                            $('#edit').val("Atualizado");
                            alert("Dados Atualizados");
                            location.href = "cadastroLivro.php";
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
                        url: "buscar.php",
                        method: "POST",
                        data: {'codigo': codigo},
                        dataType: "json",
                        success: function (data) {
                            $('#nome-insert').val(data.nome);
                            $('#autor-insert').val(data.autor);
                            $('#edicao-insert').val(data.edicao);
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