<?php

require 'conexao.php';

if (!empty($_POST)) {
    $output = '';
    $message = '';
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    if ($_POST['codigo'] != '') {
        $query = "UPDATE usuarios SET nome='$nome', email='$email' WHERE codigo='" . $_POST['codigo'] . "'";
        $message = 'Dados Atualizados';
    } else {
        $query = "  
           INSERT INTO usuarios(nome, email) VALUES('$nome', '$email');";
        $message = 'Dados Inseridos';
    }
    if (mysqli_query($conn, $query)) {
        $output .= '<label class="text-success">' . $message . '</label>';
        $select_query = "SELECT * FROM usuarios ORDER BY codigo DESC";
        $result = mysqli_query($conn, $select_query);
        $output .= '  
                <table class="table table-bordered">  
                    <tr>  
                        <th width="5%">Código</th> 
                        <th width="70%">Nome do Usuario</th>  
                         
                    </tr>  
           ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '  
                     <tr>  
                          <td>' . $row['codigo'] . '</td>  
                          <td>' . $row['nome'] . '</td>  
                          <td><button class="btn"><i class="fa fa-bars"></i> </button></td>
                          <td><input type="button" name="edit" value="Edit" id="' . $row['codigo'] . '" class="btn btn-info btn-xs edit_data" /></td>  
                          <td><input type="button" name="view" value="view" id="' . $row['codigo'] . '" class="btn btn-info btn-xs view_data" /></td>  
                     </tr>  
                ';
        }
        $output .= '</table>';
    }
    echo $output;
}
