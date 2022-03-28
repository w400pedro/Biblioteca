<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    body{ 
        padding-left: 559px;
        padding-top: 92px;

    }
    #footer{
        position: fixed;
        bottom:10px;
        left: 20px;
    }
    </style>
</head>
<body>
    <?php
    session_start();
    if(!empty($_SESSION['nome'])){
        header("Location: select.php");
    }
    if(!empty($_GET['msg'])){
    if($_GET['msg']=='errologin'){
        echo "<table><tr><td style=\"color: white; border: 3px red solid; background-color: grey;\"><h3>Email ou Senha incorretos<h3></td></tr></table>";
    }else if($_GET['msg']=='registrado'){
        echo "<table><tr><td style=\"color: green;\"><h2>Cadastrado com sucesso<h2></td></tr></table>";
    }else if($_GET['msg']=='erro_no_cadastro'){
        echo "<table><tr><td style=\"color: white; border: 3px red solid; background-color: grey;\"><h3>Usuário ja cadastrado<h3></td></tr></table>";
    }
}

?>
    <h2>Bem-vindo usuario!!</h2>
    <h3>Faça seu login: </h3>
    <form action="verifica.php" name="login" method="POST">
    <label for="email">E-mail <input type="email" name="email"> </label>
    <br><br>
    <label for="senha">Senha <input &nbsp type="password" name="senha"></label>
    <br><br>
    <button type="submit" name="LOGA">Entrar</button>
    </form>
<br><br>
<h2>Não tem uma conta ainda? Cadastre-se já!</h2>
<br>
<h3><a href="cadastro.php">Criar Conta</a></h3>
<footer id="footer">By Pedro Henrique © | IFRS 2022</footer>
</body>
</html>

