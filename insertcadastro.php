<?php
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$conexao = mysqli_connect("localhost","root","","biblioteca");

$verifica = "SELECT * FROM usuario WHERE email = '$email'";

if($vemail = mysqli_query($conexao, $verifica)){
    $verificaemail = mysqli_fetch_array($vemail);
    if(!empty($verificaemail['email'])){
        header("Location: cadastro.php?msg=email_existente");
    } else{
        $padrao = '08';
        $salt = 'Cf1f11ePArKlBJomM0F6aJ';

        $hash = crypt($senha, '$2a$'.$padrao.'$'.$salt.'$');


        $cadastro = "INSERT INTO usuario (nome,email,senha) VALUES ('$nome','$email', '$hash')";

 if (mysqli_query($conexao, $cadastro)){
    header("Location: inicio.php?msg=registrado");
    
} else {
   header("Location: inicio.php?msg=erro_no_cadastro");
}
    }
}


?>