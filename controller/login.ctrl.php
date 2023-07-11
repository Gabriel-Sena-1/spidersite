<?php
require_once('./../model/Adm.class.php');
require_once('./../model/Database.class.php');

session_start();

//acesso direto à pagina, ou seja abriu o arquivo, passou pela index.php e entrou na login.ctrl
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    //(logout)
    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_unset(); //limpa os valores da sessão atual
        session_destroy();
        header('Location: ./../view/login.php');
    } else if (isset($_SESSION['usuario'])) { //se já existir uma sessão, ou seja já fez login, entra aqui
        header('Location: ./../view/listagem.php');
    } else { //se não existir uma sessão, ou seja não realizou o login, entra aqui
        header('Location: ./../view/login.php');
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //cria objeto Adm
    $usuario = new Adm();
    $usuario->nome = $_POST['nome'];
    $usuario->senha = $_POST['senha'];

    //faz uma verificação se os dados inseridos são vazios
    if ($_POST['senha'] == '' || $_POST['nome'] == '') {
        $msg = 'Senha ou email não inseridos';
        $_SESSION['msg'] = $msg;
        header("Location: ./../view/login.php?msg=" . $_SESSION['msg']);
    }

    $nome = $usuario->nome;
    $senha = $usuario->senha;
    $senha = md5($senha);
    $verifica = $usuario->verificarLogin($nome,$senha);

    if($verifica){
        $_SESSION['usuario'] = $usuario;
        $_SESSION['msg'] = 'Bem vindo ' . $usuario->nome;
        header('Location: ./../view/listagem.php');
    }
    else
    {
        $_SESSION['msg'] = 'Login ou senha incorretos.';
        //$msg = $_SESSION['msg'];
        header('Location: ./../view/login.php?'.$_SESSION['msg']);
    }

}
