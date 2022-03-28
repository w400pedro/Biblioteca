<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    body{ 
        padding-left: 600px;
        padding-top: 130px;

    }
    #footer{
        position: fixed;
        bottom:10px;
        left: 20px;
    }
    </style>
</head>
<body>
<h2>Cadastre seu usúario!</h2>


<?php
session_start();
    if(!empty($_SESSION['nome'])){
        header("Location: select.php");
    }
if(!empty($_GET['msg'])){
if($_GET['msg']=='email_existente'){
    echo "<table><tr><td style=\"color: white; border: 3px red solid; background-color: grey;\"><h3>Email já cadastrado<h3></td></tr></table>";
}

}
?>
<br>
<form action="insertcadastro.php" method="POST">
<label for="nome">Nome <input id="nome" name="nome" type="text" required></label> 
<br><br>
<label for="email">E-mail <input id="email" name="email" type="email" required></label>
<br><br>
<label for="password">Senha <input id="senha" name="senha" type="password" required></label>

<br><br>
<input type="button" onclick="window.location.href='inicio.php'" value="Voltar"> &nbsp; <button type="submit" name="CRIA">Registrar</button>
</form>
<footer id="footer">By Pedro Henrique © | IFRS 2022</footer>
</body>
</html>
