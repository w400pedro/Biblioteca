<?php
session_start();
$email = $_POST['email'];
$senha = $_POST['senha'];

$conexao = mysqli_connect("localhost","root","","biblioteca");

$padrao = '08';
$salt = 'Cf1f11ePArKlBJomM0F6aJ';

$hash = crypt($senha, '$2a$'.$padrao.'$'.$salt.'$');

$verifica = "select * from usuario where email='$email'";

if ($log = mysqli_query($conexao, $verifica)){
    $logfetch = mysqli_fetch_array($log);
    if(!empty($logfetch)){
        $hash = $logfetch['senha'];
        if(crypt($senha, $hash)== $hash){
        $_SESSION['nome'] = $logfetch['nome'];
        $_SESSION['email'] = $logfetch['email'];
        $_SESSION['id'] = $logfetch['id'];
    header("Location: select.php");
        }else{
            unset($_SESSION['nome']);
    unset($_SESSION['email']);
    unset($_SESSION['senha']);  
    unset($_SESSION['id']); 
    session_destroy();
    header("Location: inicio.php?msg=errologin");
    sleep(2);
        }
} else {
    unset($_SESSION['nome']);
    unset($_SESSION['email']);
    unset($_SESSION['senha']);  
    unset($_SESSION['id']); 
    session_destroy();
    header("Location: inicio.php?msg=errologin");
    sleep(2);
}
}
?>