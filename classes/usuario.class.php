<?php

require_once 'conexao.class.php';

class Usuarios {
     private $con; //variavel que recebe a conexao

     private $id;
     private $nome;
     private $email;
     private $senha;
     private $permissoes; //ADD, EDIT, DELETE, SUPER(ACESSO A GESTAO DO USUARIO)
    
     public function __construct(){
        $this ->con = new Conexao();

     }

/*
aqui deve ser criado o CRUD para Usuarios
-adicionar
-listar
-buscar
-editar
-excluir
-existe_email
*/

//metodos referentes ao login

public function fezerLogin ($email, $senha){

$sql = $this->con ->conectar()->prepare
("SELECT * FROM usuarios WHERE email = : email AND senha = :senha");
$sql ->bindValue (":email", $email);
$sql ->bindValue (":senha", $senha);
$sql ->execute();

     if($sql->rowCount() > 0){
        $sql = $sql->fetch();

         $_SESSION['logado'] = $sql['id'];
      return TRUE;


        }
        return FALSE;
    }
    public function setUsuario($id){
        $this->id = $id;
        $sql = $this->con->conectar()->prepare("SELECT * FROM usuarios WHERE id = :id")
        $sql->execute()    

        if($sql->rowCount() > 0 ){
            $sql = $sql->fetch();
            $this->permissoes = explode(',',$sql['permissoes']);
        }
    }
    public function getPermissoes(){
        return $this->permissoes;
    }
    public function temPermissoes($p){
        if(in_array($p, $this->permissoes)){
            return TRUE;
        }else {
            return FALSE;
        }    
    }
}