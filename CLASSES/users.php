<?php

Class User 
{
    private $pdo; 
    public $msgError = "";

    public function connect($nome, $host, $user, $senha)
    {
        global $pdo;
        global $msgError;

        try 
        {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $user, $senha);
        } 
        catch (PDOException $e) 
        {
            $msgError = $e->getMessage();
        }
        
    }

    public function register($nome, $telefone, $email, $senha)
    {
        global $pdo;
        global $msgError;

        //verify if email is alredy rigistered 
        $sql = $pdo->prepare("SELECT id_user FROM users WHERE email = :e");
        $sql-> bindValue(":e",$email);
        $sql-> execute();

        if($sql->rowCount() > 0) 
        {
            return false; //is alredy registered
        }
        else 
        {
            $sql = $pdo->prepare("INSERT INTO users (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
            $sql-> bindValue(":n",$nome);
            $sql-> bindValue(":t",$telefone);
            $sql-> bindValue(":e",$email);
            $sql-> bindValue(":s",md5($senha));
            $sql-> execute();
            return true;
        }
    }

    public function login($email, $senha)
    {
        global $pdo;
        //verify if email and password are registered
        $sql = $pdo->prepare("SELECT id_user FROM users WHERE email = :e AND senha = :s");
         $sql->bindValue(":e", $email);
         $sql->bindValue(":s", md5($senha));
         $sql->execute();

        if($sql->rowCount() > 0)
        {
            //enter in private area (session)
            $dado =  $sql->fetch();
            session_start();
            $_SESSION['id_user'] = $dado['id_user'];
            return true; 
        } 
        else 
        {
            return false;
        }
        global $msgError;
    }
}

?>