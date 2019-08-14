<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title></title>
</head>
<div>
    <?php
    session_start();
    include("conexao.php");
    $msgErro = ""; // se vazia tudo funcionando corretamente;

    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['password']);
    $confpassword = addslashes($_POST['confpassword']);
    if (!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha) && !empty($confpassword)) {
        if ($msgErro == "") {
            if ($senha == $confpassword) {
                global $pdo;
                //Verificar se já existe o email/usuario cadastrado
                $sql = "SELECT * FROM cadastro WHERE email = '$email'";
                $query = mysqli_query($conexao, $sql);
                if (mysqli_num_rows($query) == 0) {
                    $sql = ("INSERT INTO cadastro(nome,telefone,email,senha) VALUES ('{$nome}', '{$telefone}', '{$email}', md5('{$email}'))");
                    $resultado = mysqli_query($conexao, $sql);
                    if ($resultado) {
                        header('Location:cadastrar.php');
                        echo "Cadastrado com sucesso, faça o login para acessar";
                    } else {
                        header('Location:cadastrar.php');
                        $msg = 0;
                    }
                    return true; //cadastrado com sucesso;
                } else {
                    header('Location:cadastrar.php');
                    echo "Usuario ja cadastrado";
                    return false; //ja esta cadastrado;
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
    ?>
</div>