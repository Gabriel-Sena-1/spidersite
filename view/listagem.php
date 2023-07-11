<?php
session_start();


if (isset($_SESSION['msg'])) {
  $msg = $_SESSION['msg'];
  echo "<script>alert('$msg')</script>";
  unset($_SESSION['msg']); //destroi variável $_SESSION['msg']
}

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
  <title>Listagem</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  <link rel="stylesheet" href="fragments/estiloListagem.css">
  <link rel="icon" type="image/png" href="img/iconpage.png" /> 
  <link type="text/javascript" href="js/funcoes.js">
  <script>
    function filtro(textoFiltro){
    var lista = document.querySelectorAll('tbody tr');


    for (let i = 0; i< lista.length; i++) {
        const element = lista[i];
        var textoLinha = element.innerText;
        element.style.display = '';
        textoLinha = textoLinha.toLowerCase();
        var filt = textoFiltro.toLowerCase();


      if(!textoLinha.includes(filt)){
        element.style.display = 'none';
        }
       
    }
    }

    var pagina = 5;
  //objeto JS para req AJAX
  var xhttp = new XMLHttpRequest();

  function montaTabela(){
    //Tratar a resposta do AJAX
    if (xhttp.readyState == 4 && xhttp.status == 200) {
        var tabela = document.getElementById('tabela');
        tabela.innerHTML += xhttp.responseText;
        pagina += 5;
    }
  }


  function carregaItens(){
    //define endereco que será requisitado assincronamente
    xhttp.open('GET', './../controller/spider.ctrl.php?pagina=' + pagina, true);
    //funcao chamada quando a resposta voltar
    xhttp.onreadystatechange = montaTabela;
    //envia requisição
    xhttp.send();
  }

  </script>
</head>




<body>

  <div style="display: flex; float: right; margin: 2vh 4vh 0 0;">
        <button class="button is-danger" style="padding: 25px; font-weight: 600;">
            <a href="./../controller/login.ctrl.php?action=logout" action="logout" style="color: white!important;" method="get">
             Sair
            </a>
        </button>
    </div>

  <div style="display: flex; float: right; margin: 2vh 4vh 0 0;">
        <button class="button is-primary" style="padding: 25px; font-weight: 600;">
            <a href="./cadastro.php" style="color: white!important;" >
             Cadastrar Novo Membro
            </a>
        </button>
  </div>

  
  
  <section class="section hero is-fullheight">
    <div class="container" >
      <h1 class="title is-1 has-text-centered" style="color: white!important;">Listagem de Heróis Aranha</h1>
      
      <div style="color: white; margin: -1vh; font-weight: 600; display: flex; padding: 3vh;">
	    <input type="text" class="input" id="filtroInput" placeholder="Coloque o que deseja filtrar" onkeypress="filtro(this.value)" onkeyup="filtro(this.value)" 
      style="margin-right: 3vh;">
      
      

        <div style="margin-left: 3vh;">
        <button class="button" style="font-weight: 600; font-size: 20px; background-color: orange; color: white!important;" onclick="carregaItens()">
             +
        </button>
        </div>
      </div>

      <table class="table is-striped is-hoverable is-fullwidth" id="tabela">
        <thead>
          <tr>
            <th>Nome de Herói Aranha</th>
            <th>Terra de Origem</th>
            <th>Tempo como Herói</th>
            <th>Editar</th>
            <th>Excluir</th>
          </tr>
        </thead>
        <tbody>

          <?php
          require_once('./../model/Spider.class.php');
          require_once('./../model/Database.class.php');
          Spider::listarpagina(0);
          //Se há mensagem msg na sessao, mostra com alerta
          // if(isset($_SESSION['msg'])){
          //     $msg = $_SESSION['msg'];
          //     echo "<script>alert('$msg')</script>";
          //     unset($_SESSION['msg']);
          // }
          ?>
          <!-- <tr>
            <td>Peter Parker</td>
            <td>Terra-616</td>
            <td>10 anos</td>
            <td>
              <a class="button is-small is-primary" href="#">Editar</a>
            </td>
          </tr>
          <tr>
            <td>Miles Morales</td>
            <td>Terra-1610</td>
            <td>2 anos</td>
            <td>
              <a class="button is-small is-primary" href="./editarHeroi.php">Editar</a>
            </td>
          </tr> -->

        </tbody>
      </table>
    </div>
  </section>
</body>

</html>0
