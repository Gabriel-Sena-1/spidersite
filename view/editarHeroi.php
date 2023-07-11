<?php
require_once('./../model/Database.class.php');
require_once('./../model/Spider.class.php');

$spider = Spider::buscarPorId($_GET['id']);
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
    <title>Editar Herói</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="fragments/estiloCadastro.css">
    <link rel="icon" type="image/png" href="img/iconpage.png"/> 
</head>
<body>
  

  <section class="hero is-fullheight">

    <div class="hero-body">
      <div class="container has-text-centered">
        <h1 class="title is-1">Editar Heroi Aranha </h1>
        <div class="columns is-centered" style="">
          <div class="column is-half" style="" >
            <form action="./../controller/spider.ctrl.php" method="post">
            <input type="hidden" name="action" value="editar">
            <input type="hidden" name="id" value="<?php echo $spider['id']; ?>">
              <div class="field">
                <label class="label">Nome de Super-Herói Aranha</label>
                <div class="control">
                  <input class="input" name="nomeH" type="text" value="<?php echo $spider['nome']; ?>" min="2" max="50" required>
                </div>
              </div>
              <div class="field">
                <label class="label">Tempo como Herói</label>
                <div class="control">
                  <input class="input" name="tempoH" type="text" value="<?php echo $spider['tempo']; ?>" min="2" max="50" required>
                </div>
              </div>
              <div class="field">
                <label class="label">Cores Tema</label>
                <div class="control">
                  <input class="input" name="corH" type="text" value="<?php echo $spider['cor']; ?>" min="2" max="50" required>
                </div>
              </div>
              <div class="field">
                <label class="label">Terra de Origem</label>
                <div class="control">
                  <input class="input" name="terraH" type="number" value="<?php echo $spider['terra']; ?>" min="2" required>
                </div>
              </div>
              <div class="field">
                <div class="control">
                  <button class="button is-primary" type="submit">Alterar</button>
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
