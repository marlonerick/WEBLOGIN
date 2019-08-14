<?php
include "conexao.php";
class Usuario
{
    private $pdo;
    public $msgErro = ""; // se vazia tudo funcionando corretamente;

    public function conectar($nome, $host, $usuario, $senha)
    {
        global $con;
        global $msgErro;
        try {
            $con = new PDO("MySqli:dbname=" . $nome . ";host=" . $host, $usuario, $senha);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome, $telefone, $email, $senha)
    {
        global $pdo;
        //Verificar se já existe o email/usuario cadastrado
        $sql = $pdo->mysqli_connect("SELECT idusuario FROM projeto_login WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return false; //ja esta cadastrado;
        } else {
            $sql = $pdo->prepare("INSERT INTO projeto_login(nome,telefone,email,senha) VALUES (:n, :u, :t, :s)");
            $sql->bindValue(":e", $nome);
            $sql->bindValue(":u", $email);
            $sql->bindValue(":t", $telefone);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            return true; //cadastrado com sucesso;
        }
        //caso não, cadastrar;
    }

    public function login($email, $senha)
    {
        global $pdo;
        //verificar se o email e senha estao cadastrado no bd;
        $sql = $pdo->prepare("SELECT idcadastro FROM cadastro WHERE email = :e AND senha = :s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();
        if ($sql->rowCount() > 0) {
            //entrar no sistema;
            //guarda os dados em um array;
            $dados = $sql->fetch();
            session_start();
            $_SESSION['idcadastro'] = $dados['idcadastro'];
            return true; //cadastrado com sucesso;
        } else {
            return false; //nao foi possivel logar;
        }
        //entrar no sistema;
    }
}

if (isset($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['password']);
    $confpassword = addslashes($_POST['confpassword']);
    //verificar se esta preenchido;
    if (!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha) && !empty($confpassword)) {
        $u->conectar("bdcadastro", "127.0.0.1:3306", "root", "X0k9CJksMEb3DJjh");
        if ($u->$msgErro == "") {
            if ($senha == $confpassword) {
                if ($u->cadastrar($nome, $telefone, $email, $senha)) {
                    echo "Cadastrado com sucesso, faça o login para acessar";
                } else {
                    echo "Usuario/E-mail já cadastrado";
                }
            } else {
                echo "Senha não corresponder a confirmar senha!";
            }
        } else {
            echo "ERRO:" . $u->$msgErro;
        }
    } else {
        echo "Preencha todos os campos !";
    }
}
