<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style type="text/css">

table{
    margin: 0 auto;
    background-color: coral;
    width: 1300px
}
tr{
    border: none;
}
.tds{
    font-size: 1.8em;
    border: 1px solid
}
}
 #livros{
    position:absolute;
		left:8%;
		top:2%;
        margin-left:-110px;
        text-decoration: none;
 }
 #logado{
    position:absolute;
		left:40%;
		top:0%;
		margin-left:-110px;
 }
 #logout{
    position:absolute;
		left:98%;
		top:2%;
        margin-left:-110px;
        text-decoration: none;
 }
 .none{
     background-color: white;
 }

</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<?php session_start(); echo "<h2 id=\"logado\"> Bem-vindo ". $_SESSION['nome']."!</h2>";
echo "<h3><a href=\"logout.php\" id=\"logout\" onclick=\"return confirm('Tem certeza que deseja sair da sua conta?');\">Logout</a></h3>";
if(empty($_SESSION['nome'])){
    header("Location: inicio.php");
}
$conexao = mysqli_connect("localhost","root","","biblioteca");

if(!empty($_POST['livroid'])){
    $delete = "delete from livrousuario where livro=".$_POST['livroid']." and usuario=".$_SESSION['id']."";
    mysqli_query($conexao, $delete);
    $qtdreal = $_POST['livroqtd'] + 1;
    $update ="update livro set quantidade= $qtdreal where id=".$_POST['livroid']."";
    mysqli_query($conexao, $update);
}

echo "<h2><a id=\"livros\" href=\"biblioteca.php\">Catalogo de Livros</a></h2>"; sleep(1);

$consulta = "select *, livro.id as livid from livro join livrousuario on livrousuario.livro = livro.id join usuario on usuario.id = livrousuario.usuario where usuario.id =". $_SESSION['id']."" ;

$consultaverifica = mysqli_query($conexao, $consulta);

$verificacao = mysqli_fetch_array($consultaverifica);
echo "";
if(empty($verificacao)){
    echo "<h2 style=\"padding-left:525px; color: gray;\">Você ainda não alugou nenhum livro</h2>";
}else{
echo "<table><br><br><th class=\"none\" colspan=\"5\" style= \"text-align: center; font-size: 2.1em;\">Livros sobre sua posse: </th></tr>";
if($consulta2 = mysqli_query($conexao, $consulta)){
    echo "<tr><td class=\"tds\">Titulo</td>";
    echo "<td class=\"tds\">Ano</td>";
    echo "<td class=\"tds\">Autor(es)</td>";
    echo "<td class=\"tds\">Editora</td><td class=\"none\"></td></tr>";

   while($livro = mysqli_fetch_array($consulta2)){
       echo "<tr><td class=\"tds\">".$livro['titulo']."</td>";
       echo "<td class=\"tds\">".$livro['ano']."</td>";
       echo "<td class=\"tds\">".$livro['autor']."</td>";
       echo "<td class=\"tds\">".$livro['editora']."</td>";
       echo "<td class=\"none\"><form method=\"post\" action=\"select.php\"> <input type=\"hidden\" name=\"livroid\" value=\"".$livro['livid']."\"> <input type=\"hidden\" name=\"livroqtd\" value=\"".$livro['quantidade']."\"> <button type=\"submit\" class=\"btn btn-primary btn-lg\">Devolver</button></form></td></tr>";
   }
}
}
echo "</table>";
?>
</table>
</body>
</html>
