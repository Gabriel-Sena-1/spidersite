<?php

class Database
{
    private const DSN = 'mysql:dbname=spidersite;host=localhost';
    private const DUSER = 'root';
    private const DPASS = '';
    private static $conexao = null;
    
    static function conecta(){
        try{
            Database::$conexao = new PDO(Database::DSN, Database::DUSER, Database::DPASS);
            Database::$conexao->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }catch (Exception $erro) {
            echo 'Não foi possivel se conectar ao Banco <br>';
            die($erro->getMessage());
        }
        return Database::$conexao;
    }
}