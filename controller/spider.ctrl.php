<?php
require_once('./../model/Spider.class.php');
require_once('./../model/Database.class.php');
session_start();

if(isset($_GET['pagina'])){//listagem ajax
    $pagina = $_GET['pagina'];
    Spider::listarpagina($pagina); //imprime linhas de tabela com 5 músicas a partir de $pagina
}

if(isset($_POST['action']) && $_POST['action'] == 'cadastrar'){
    //
    $spider = new Spider(
        $_POST['nomeH'], 
        $_POST['tempoH'], 
        $_POST['corH'], 
        $_POST['terraH'], 
        $_POST['RA']);

     $spiderCadastrar = $spider->salvar($spider);
     $msg = $_SESSION['msg'];
     header('Location: ./../view/listagem.php?msg');
}

if (isset($_GET['act']) && $_GET['act'] == 'editar'){
    
    if(!isset($_GET['id'])){
        die('Id não informado');
    }

    $id = $_GET['id'];
    $buscarAvaliador = Spider::buscarPorId($id);
        header('Location: ./../view/editarHeroi.php?id='.$buscarAvaliador['id']);
}

if (isset($_POST['action']) && $_POST['action'] == 'editar'){
    var_dump($_POST);
    Spider::editar($_POST['id'], $_POST['nomeH'], $_POST['tempoH'], $_POST['corH'],$_POST['terraH']);
}


if (isset($_GET['act']) && $_GET['act'] == 'delete'){
    
    if(!isset($_GET['id'])){
        die('Id não informado');
    }

    $id = $_GET['id'];
    $deuCerto = Spider::deletar($id);

        $_SESSION['msg'] = $deuCerto ? 'Registro excluido' : 'Erro ao excluir SPIDER';
        header('Location: ./../view/listagem.php');
}
