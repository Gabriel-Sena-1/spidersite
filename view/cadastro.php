<?php
session_start();

if(!isset($_SESSION) || empty($_SESSION)){
  $_SESSION['msg'] = 'É necessario fazer Login para acessar essa página!!!';
  header('Location: ./../controller/login.ctrl.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="fragments/estiloCadastro.css">
    <link rel="icon" type="image/png" href="img/iconpage.png"/>
    <script>
      function registroAranha(min, max) {
        var ra =  Math.random() * (max - min) + min;
        var inputRA = document.getElementById('inputRA');

        inputRA.value = Math.round(ra);
      }
    </script>
</head>
<body onload="registroAranha(100000, 999999)">
  <section class="hero is-fullheight">
    <div class="hero-body">
      <div class="container has-text-centered">
        <h1 class="title is-1">Cadastro de Aranha </h1>
        <div class="columns is-centered" style="">
          <div class="column is-half" style="" >
            <form action="./../controller/spider.ctrl.php" method="post">
            <input type="hidden" name="action" value="cadastrar">
              <div class="field">
                <label class="label">Nome de Super-Herói Aranha</label>
                <div class="control">
                  <input class="input" name="nomeH" type="text" placeholder="Digite o nome do herói aranha" min="2" max="50" required>
                </div>
              </div>
              <div class="field">
                <label class="label">Tempo como Herói</label>
                <div class="control">
                  <input class="input" name="tempoH" type="text" placeholder="Digite o tempo como herói" min="2" max="50" required>
                </div>
              </div>
              <div class="field">
                <label class="label">Cores Tema</label>
                <div class="control">
                  <input class="input" name="corH" type="text" placeholder="Digite as cores tema" min="2" max="50" required>
                </div>
              </div>
              <div class="field">
                <label class="label">Terra de Origem</label>
                <div class="control">
                  <input class="input" name="terraH" type="number" placeholder="Digite a terra de origem" min="2" required>
                </div>
              </div>
          
              <div class="field">
                <label class="label">Registro Aranha</label>
                <div class="control">
                  <input class="input" readonly name="RA" type="number" id="inputRA" placeholder="Clique aqui para gerar o registro aranha.">
                </div>
              </div>

              <div class="field">
                <div class="control">
                  <button class="button is-primary" type="submit">Cadastrar</button>
                </div>
              </div>
            
            </div>
            </form>

            </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
