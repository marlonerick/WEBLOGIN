<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('verificalogin.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="_icones/favicone1.png" />
    <link rel="stylesheet" href="_css/home.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Document</title>
</head>

<body class="fundo">
    <nav class="text-right">
        <p class="text-right">Bem Vindo,<?php echo $_SESSION['email']; ?></p>
        <a type="button" class="btn btn-light" href="logout.php">Logout</a>
    </nav>
    <div id="home-form">
        <h1 class="display-4">Bem Vindo</h1>
        <h2>Previsão do tempo</h2>
        <div class="input-group input-group-lg inputWithIcon">
            <input type="text" class="form-control" placeholder="Insira aqui nome da sua cidade" aria-label="Recipient's username" aria-describedby="button-addon2">
            <i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
        </div>
        <hr class="border-top" />
</body>

</html>