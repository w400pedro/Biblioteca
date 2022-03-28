<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style type="text/css">
table{
    margin: 0 auto;
    width: 98%;
    
}
tr{
    border: none;
}
.tds{
    font-size: 1.8em;
    border: 1px solid black;
}
.principal{
    background-color: coral;
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
		left:36%;
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


echo "<h2><a id=\"livros\" href=\"select.php\">Meus Livros</a></h2>"; sleep(1);
echo "<br>";
echo "<form method=\"GET\" action=\"biblioteca.php\">";
echo "<label for=\"filtro\">Filtro <input required name=\"parametro\" type=\"text\"></label>";
echo "<button type=\"submit\">Filtrar</button>";
echo "</form>";

echo "<form method=\"POST\"><button name=\"todos\" type=\"submit\">Limpar Filtros</button> <button name=\"ano\" type=\"submit\">Filtrar por ano(decrescente)</button></form>";


echo "<h2 style=\"margin: \">Selecione o livro que deseja pegar: </h2>";

if(!empty($_GET['msg'])){
if($_GET['msg']=='repetido'){
    echo "<h2 style=\"color: red; padding-left: 580px\">Você já tem esse livro!</h2>";
}
}

$conexao = mysqli_connect("localhost","root","","biblioteca");

$consulta = "select * from livro";

$parametro = filter_input(INPUT_GET, "parametro");

if(isset($_POST['todos'])){
    header("Location: biblioteca.php");
  }

if(isset($_POST['ano'])){
      $consulta = "select * from livro order by ano desc";
    }


if($parametro){
    $consulta = "select * from livro where titulo like '%$parametro%'";
}
if(($parametro) && (isset($_POST['ano']))){
    $consulta = "select * from livro where titulo like '%$parametro%' order by ano desc";
}

echo "<table><tr><th colspan=\"5\" style= \"text-align: center; font-size: 2.1em;\">Livros no catálogo: </th></tr>";
echo "<tr class=\"principal\"><td class=\"tds\">Titulo</td>";
echo "<td class=\"tds\">Ano</td>";
echo "<td class=\"tds\">Autor(es)</td>";
echo "<td class=\"tds\">Editora</td>";
echo "<td class=\"tds\">Qtd</td></tr>";
if($consulta2 = mysqli_query($conexao, $consulta)){
   while($livro = mysqli_fetch_array($consulta2)){
    echo "<tr class=\"principal\">";
    echo "<td class=\"tds\">".$livro['titulo']."</td>";
    echo "<td class=\"tds\">".$livro['ano']."</td>";
    echo "<td class=\"tds\">".$livro['autor']."</td>";
    echo "<td class=\"tds\">".$livro['editora']."</td>";
    echo "<td class=\"tds\">".$livro['quantidade']."</td>";
    echo "<td class=\"none\" style=\"width: 2px;\">";
    if($livro['quantidade']==0){
        echo "<form method=\"post\" action=\"emprestimo.php\"> <input type=\"hidden\" name=\"emprestimo\" value=\"".$livro['id']."\"> <button type=\"submit\" class=\"btn btn-primary btn-lg\" disabled>+</button></form>&nbsp</td></tr>";

    }else{
    echo "<form method=\"post\" action=\"emprestimo.php\"> <input type=\"hidden\" name=\"emprestimo\" value=\"".$livro['id']."\"> <button type=\"submit\" class=\"btn btn-primary btn-lg\">+</button></form>&nbsp</td></tr>";
    }   
}
   }
echo "</table>";
?>
</table>
</body>
</html>
