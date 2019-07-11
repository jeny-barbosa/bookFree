<meta charset = "utf-8">
<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
<meta name="google-signin-client_id" content="444094126116-nkdc6oda1qb2ro0uq1mi5rg8dp8t23vd.apps.googleusercontent.com">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
  #tit {
    font-size:18pt;
  }
</style>
<nav class="navbar navbar-inverse"  >
  <div class="container-fluid" id="tit">
    <div class="navbar-header" id="tit">
      <a class="navbar-brand" href="telaLivro.php">BookFree</a>
    </div>
    <ul class="nav navbar-nav" id="tit">
      <li class="dropdown" id="tit">
        <a class="dropdown-toggle" data-toggle="dropdown" href="telaLivro.php">Cadastro
          <span class="caret"></span></a>
        <ul class="dropdown-menu" id="tit">
          <li><a href="cadastroLivro.php">Livro</a></li>
          <li><a href="cadastroUsuario.php">Usuário</a></li>
        </ul>
      </li>
      <li id="tit"><a href="autores.php">Autores</a></li>
      <li id="tit"> <a href="acervo.php">Acervo</a></li>
      <li id="tit"><a href="aluguel.php">Aluguel</a></li>
      <li id="tit"><a href="pedidos.php">Pedidos</a></li>
      <li id="tit" class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Relatórios
          <span class="caret"></span></a>
        <ul class="dropdown-menu" id="tit">
          <li id="tit"><a href="relatorioLivro.php">Livros</a></li>
          <li id="tit"><a href="relatorioUsuario.php">Usuários</a></li>
          <li id="tit"><a href="relatorioPedido.php">Pedidos</a></li>
          <li id="tit"><a href="relatorioAlugados.php">Aluguel</a></li>
        </ul>
      </li>
    </ul>
    <ul class=" nav navbar-nav navbar-right" id="tit">
      <li id="tit"><a href="#" onclick="signOut();" class="btn btn-danger" style="color:white;">Sair <span class="glyphicon glyphicon-log-out"></span></a></li>
    </ul>
  </div>
</nav>
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
</script>
