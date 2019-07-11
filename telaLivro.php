<!DOCTYPE html>
<html>
    <head>
        <title>Book Free</title>
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
            .texto {
                margin-top: 15%;
            }
            #titulo1{
                font-size: 64px;
            }
            #subTitulo{
                font-size: 25px;
            }
        </style>
    </head>
    <body> 
        <?php include_once 'menu.php'; ?>
        
        <div align="center" class="texto">
            <h1 id="titulo1">Seja bem-vindo(a) à BookFree! </h1>
            <h2 id="subTitulo">Os clássicos da Literatura Brasileira disponíveis em um só lugar.</h2>
        </div>
    </body>
</html>
