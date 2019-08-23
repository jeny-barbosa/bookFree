<head>
  <meta charset="utf-8">
  <title>Verificar a data</title>
</head>
<body>
  <p id="msg"></p>
  <label>Data de retirada:</label><br>
  <input type="date" id="data_inicio-incluir"><br><br>
  <label>Data de entrega:</label><br>
  <input type="date" id="data_fim-incluir"><br><br>
  <button onclick="verificarData()">Verificar</button>
  <script>
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

      dataI = dataI.replace(/[^0-9-]/g, "").trim(); // Filtrando o valor do input
      dataF = dataF.replace(/[^0-9-]/g, "").trim(); // Filtrando o valor do input

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

        msg.innerHTML = ("Ok");
        return true;
      }

    }
  </script>
</body>
</html>
