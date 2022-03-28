<?php
session_start();
$conexao = mysqli_connect("localhost", "root", "", "biblioteca");

$verificarelacionamento = "select * from livrousuario where livro = ".$_POST['emprestimo']." and usuario= ".$_SESSION['id']."";

$q = "select quantidade from livro where id=".$_POST['emprestimo']."";

if($vr = mysqli_query($conexao, $verificarelacionamento)){
    $verifica = mysqli_fetch_array($vr);

    if(empty($verifica['id'])){

$relacionamento = "insert into livrousuario (usuario, livro) values (".$_SESSION['id'].", ".$_POST['emprestimo'].")";

if($query = mysqli_query($conexao, $relacionamento)){
    $queryqtd = mysqli_query($conexao, $q);
    $qtd = mysqli_fetch_array($queryqtd);
    $qtdfinal = $qtd['quantidade'] -1;
    $changeqtd = "update livro set quantidade = $qtdfinal where id=".$_POST['emprestimo']."";
   mysqli_query($conexao, $changeqtd);
    header("Location: select.php");
}
}else{
    header("Location: biblioteca.php?msg=repetido");
}
}
?>