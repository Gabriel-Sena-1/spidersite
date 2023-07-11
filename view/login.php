<?php

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  <link rel="stylesheet" href="fragments/estiloLogin.css">
  <link rel="icon" type="image/png" href="img/iconpage.png" />
  <?php
  session_start();
  //Se há mensagem msg na sessão, mostra com alerta
  if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    echo "<script>alert('$msg')</script>";
    unset($_SESSION['msg']); //destroi variável $_SESSION['msg']
  }
  ?>
</head>

<body>
  <section class="hero is-fullheight">
    <div class="hero-body">
      <div class="container has-text-centered">
        <h1 class="title is-1">Login</h1>
        <div class="columns is-centered">
          <div class="column is-one-third">
            <form action="./../controller/login.ctrl.php" method="post">
              <div class="field">
                <label class="label">Nome de Aranha Real (ADM)</label>
                <div class="control">
                  <input class="input" type="text" name='nome' placeholder="Digite o nome de aranha">
                </div>
              </div>
              <div class="field">
                <label class="label">Senha Aranha</label>
                <div class="control">
                  <input class="input" type="password" name="senha" placeholder="Digite o registro aranha">
                </div>
              </div>
              <div class="field">
                <div class="control">
                  <button class="button is-primary" type="submit">Entrar</button>
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