<?php

class Spider
{

    private $id;
    private $nome;
    private $tempo;
    private $cor;
    private $terra;
    private $RA;

    public function __construct($nome, $tempo, $cor, $terra, $RA)
    {
        $this->nome = $nome;
        $this->tempo = $tempo;
        $this->cor = $cor;
        $this->terra = $terra;
        $this->RA = $RA;
    }


    //cria getters para todos os atributos do objeto
    public function __get($name)
    {
        return $this->$name;
    }

    //cria setters para todos os atributos
    public function __set($name, $value)
    {
        if (property_exists('Spider', $name)) {
            $this->$name = $value;
        } else {
            throw new Exception("Propriedade não existe");
        }
    }


    //cadastrar um novo Aranha no Banco de Dados
    public static function salvar($spider)
    {
        $con = Database::conecta();
        $sqlCadastro = "INSERT INTO spider(nome,tempo,cor,terra,RA) VALUES (:nome,:tempo,:cor,:terra,:RA)";

        $stmt = $con->prepare($sqlCadastro);

        $stmt->bindValue(":nome", $spider->nome);
        $stmt->bindValue(":tempo", $spider->tempo);
        $stmt->bindValue(":cor", $spider->cor);
        $stmt->bindValue(":terra", $spider->terra);
        $stmt->bindValue(":RA", $spider->RA);

        $spider = $stmt->execute();
        if ($spider == true) {
            $_SESSION['msg'] ='Salvo com sucesso' ;
            header("Location: ./../view/listagem.php");
        }
        else{
            $_SESSION['msg'] ='Deu errado ao cadastrar';
            header("Location: ./../view/cadastro.php");
        }
    }

    //editar um aranha já cadastrado
    public static function editar($id, $nome, $tempo, $cor, $terra){
        $con = Database::conecta();
        try {
            $sqlEditar = "UPDATE spider SET nome = :nome, tempo = :tempo, cor = :cor, terra = :terra
            WHERE id = :id ";

            $stmt = $con->prepare($sqlEditar);
            $stmt->bindValue(":id", $id);
            $stmt->bindValue(":nome", $nome);
            $stmt->bindValue(":tempo", $tempo);
            $stmt->bindValue(":cor", $cor);
            $stmt->bindValue(":terra", $terra);

            $spider = $stmt->execute();
            if ($spider == true) {
                $_SESSION['msg'] ='Editado com sucesso' ;
                header("Location: ./../view/listagem.php");
            }
            else{
                $_SESSION['msg'] ='Deu errado ao editar';
                header("Location: ./../view/cadastro.php");
            }            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //busca uma aranha no Banco de dados
    public static function buscarPorId($id)
    {
        $con = Database::conecta();

        try{
            $sqlBuscarSpider=("SELECT * FROM spider WHERE id = :id");
            $stmt = $con->prepare($sqlBuscarSpider);
            $stmt->bindValue(':id', $id);
    
            $stmt->execute();
    
            $spider = $stmt->fetch();
            if (!empty($spider) || $spider != '') {
                return $spider;
            } else { //linha igual a nulo, ou seja nada encontrado
                return false;
            }
        }catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    //retorna lista de todas as aranhas como objetos
    public static function listar($pagina)
    {
        $aranhas = array();
        $con = Database::conecta();

        $stmt = $con->prepare('SELECT * FROM spider LIMIT 5 OFFSET :pagina');
        $stmt->bindValue(':pagina', intval($pagina), PDO::PARAM_INT);
        $stmt->execute();


        while ($linha = $stmt->fetch()) {
            $spider = new Spider(
                $linha['nome'],
                $linha['tempo'],
                $linha['cor'],
                $linha['terra'],
                $linha['RA']
            );
            $spider->id = $linha['id'];
            $aranhas[] = $spider;
        }
        return $aranhas;
    }

    //apresenta um html, com as listagem das aranhas 
    public static function listarpagina($pagina)
    {
        foreach (Spider::listar($pagina) as $spider) {
            echo "<tr><td>{$spider->nome}</td>
            <td>{$spider->terra}</td>
            <td>{$spider->tempo}</td>

            <td><button class=\"button is-link\"><a href=\"./../controller/spider.ctrl.php?act=editar&id={$spider->id}\" style=\"color: white!important;\">Editar</a></button> </td>

            <td><button class=\"button is-danger\"><a href=\"./../controller/spider.ctrl.php?act=delete&id={$spider->id}\" style=\"color: white!important;\">Excluir</a></button> </td>
            </tr>";
        }
    }

    //deleta uma aranha
    public static function deletar($id)
    {
        try {
            $con = Database::conecta();
            $stmt = $con->prepare("DELETE FROM spider WHERE id=:id");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Erro ao excluir o homem-aranha!" . $e->getMessage());
        }
    }
}
