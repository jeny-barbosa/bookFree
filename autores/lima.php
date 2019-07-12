<!DOCTYPE html>
<html>
  <head>
    <title>Lima Barreto</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../_css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estilo.css"/>
  </head>
  <body>
    <?php require_once 'menu2.php'; ?>
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="../tela2.html">BookFree</a>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="../tela2.html">Home <span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../download.html">Acervo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../autores.html">Autores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../contatoTela.html">Contato</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../tela.html">Sair</a>
          </li>
        </ul>
      </div>
    </nav>

    <h1>Lima Barreto</h1>
    <table>
      <th>
      <td>
        <img src="img/lima.jpg" width="400" height="500" class="foto">
      </td>
      <td>
        <p>Afonso Henriques de Lima Barreto nasceu em 13 de maio de 1881 na cidade do Rio de Janeiro. Sua família era negra e humilde e seus pais descendentes de escravos. Ele ficou órfão de mãe quando tinha apenas 6 anos de idade.</p>
        <p>Foi apadrinhado pelo Visconde de Ouro Preto e, portanto, teve oportunidade de ter uma boa educação.
        </p>
        <p>Cursou seus estudos secundários no Colégio Dom Pedro II. Mais tarde, foi cursar Engenharia na Escola Politécnica. No entanto, foi obrigado a abandonar o curso para ajudar sua família com as despesas. Foi funcionário da Secretaria do Ministério da Guerra.
        </p>
        <p>Além disso, trabalhou como escritor em jornais (Correio da Manhã e Jornal do Commercio) e revistas do Rio de Janeiro (Fon-Fon, Floreal, Careta, ABC, etc.).
        </p>
        <p>Diante de uma vida complicada, Barreto teve problemas de alcoolismo e chegou a ser internado algumas vezes. Além disso, como seu pai, ele sofreu de uma depressão aguda, sendo internado pela primeira vez em 1914.
        </p>
        <p>Em 1918 foi aposentado por invalidez do cargo que exercia na Secretaria de Guerra. Faleceu em 1 de novembro de 1922 com 41 anos de idade.
        </p>
      </td>
    </th>
  </table>
  <br>

  <h1>Obras no nosso acervo</h1>
  <fieldset>
    <div class="gallery">
      <a target="_blank" href="../livros/DiarioIntimo.pdf">
        <img src="../img/DiarioIntimo.jpg" alt="Diario Intimo" width="800" height="500">
        <div class="desc"><strong> Diario Intimo</strong></div>
      </a>
    </div>
    <div class="gallery">
      <a target="_blank" href="../livros/OTristeFimDePolicarpo.pdf">
        <img src="../img/TristeFim.jpg" alt="O Triste Fim de Policarpo" width="800" height="500">
        <div class="desc"><strong> O Triste Fim de Policarpo</strong></div>
      </a>
    </div>
  </fieldset>
</body>
</html>