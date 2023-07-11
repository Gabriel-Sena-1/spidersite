<?php
  
class Adm{
    public $nome;
    public $senha;

    function verificarLogin($nome, $senha){// senha 202cb962ac59075b964b07152d234b70 (123)
        $conn = Database::conecta();
        $stmt = $conn->prepare('SELECT * FROM administradores WHERE nome=:nome AND senha=:senha');

        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':senha', $senha);

        $stmt->execute();

            $linha = $stmt->fetch();
        if(!empty($linha) || $linha != ''){
                return true;
            }else{//linha igual a nulo, ou seja nada encontrado
            return false;
        }
    }
}
