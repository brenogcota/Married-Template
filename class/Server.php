<?php

require_once 'Class/Sql.php';




class Service {

    private $conn;
    private $id;
    private $nomeProduto;
    private $nomePessoa;
    private $quantidade;
    private $quantidadeMax;

    public function __construct() {
        $this->conn = new Sql();
    }


    
    public function querySelect() {
        try {
              $cst = $this->conn->connect()->prepare("SELECT * FROM `presentes`");
              $cst->execute();
              return $cst->fetchAll();
        } catch (PDOException $ex){
              return 'error ' . $ex->getMessage();
        }
    }

    public function queryInsert($produto, $nome) {
        try {

           $this->nomeProduto = $produto;
            $this->nomePessoa = $nome;
              


              $cst = $this->conn->connect()->prepare("INSERT INTO `presentes`( `produto`, `nome_pessoa`, `quantidade`, `quantidade_max`) VALUES (:produto, :nomePessoa, 1, 1)");
              $cst->bindParam(":produto", $this->nomeProduto);
              $cst->bindParam(":nomePessoa", $this->nomePessoa);

              if($cst->execute()){
                  return 'ok';
              } else {
                  return 'erro';
              }

        } catch (PDOException $ex ) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function queryUpdate($data, $id) {
        
        try {

            $this->quantidade = $data + 1;
            $this->id = $id;

            $cst = $this->conn->connect()->prepare("UPDATE `presentes` SET `quantidade`=:quantidade WHERE `ID` = :id");
            $cst->bindParam(":quantidade", $this->quantidade);
            $cst->bindParam(":id", $this->id);

            if($cst->execute()){
                return 'ok';
            } else {
                return 'erro';
            }

      } catch (PDOException $ex ) {
          return 'error ' . $ex->getMessage();
      }
        
    }

}