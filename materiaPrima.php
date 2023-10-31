<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar Materia prima</title>
	<meta charset="utf-8">
	<style type="text/css">
	form
	{
		margin-left: 16%; 
		color: white;
		margin-top: 100px;
		font-size: 30px;
	}
	body
	{
		background-image: url('style/pags.png');
	}
	select
	{
		width: 100%;
	}
	#btInserir
	{
		margin-left: 130px;
		background-color: #5a352c;
		color: white;
		width: 500px;
		height: 220px;
		position: fixed;
		margin-top: -200px;
		font-size: 30px;
	}
	.menu
	{
		color: white;
		width: 20%;
		display: inline-block;
	}
</style>
</head>
<body>
<!--
<a href="index.php"><button>Menu Inicial</button></a>
<a href="produto.php"><button>Cadastrar Produto</button></a>
-->
<div class="menu">
	<div><a href="index.php">Menu Inicial</a></div>
	<div><a href="produto.php">Cadastrar Produto</a></div></div>
	<form action="" method="POST">
		<table>
		<tr><td>Nome:</td><td>
			<input type="text" name="Nome" required>
		</td></tr>
		<tr><td>Descrição: (Max: 100 caracteres)</td><td>
			<input type="text" name="Descricao" required>
		<tr><td>Unidade de medida:</td><td>
		<select name="Unidade" required>
			<option value="'L'">Litros</option>
			<option value="'Kg'">Quilograma</option>
			<option value="'U'">Unidades</option>
			<option value="'g'">Grama</option>
			<option value="'OU'" selected>Outra unidade</option>
		</select>
		</td>
		<tr><td>Preço(em R$):</td><td>
		<input type="Number" name="Preco" required>
		<tr><td>Quantidade no estoque:</td><td>
		<input type="Number" name="QtdEstoque" required>
		<tr><td>Quantidade minima no estoque:</td><td>
		<input type="Number" name="QtdEstoqueMinimo" required>
		<td><input type="submit" name="Enviar" value="Inserir Materia Prima" id="btInserir"></td>
	</form>

<?php

$servidor = 'localhost';
$usuario = 'root';
$senha = 'root';
$schema = 'paogramacao';

$conexao = mysqli_connect($servidor, $usuario, $senha, $schema);
if ($conexao == null) {
	die('Não foi possível conectar: ' . mysql_error());
}
	$edicao = 0;
	if($_POST != null){
		if($_POST["Enviar"] == "Inserir Materia Prima"){
			$ComandoSQL = "Insert Into paogramacao.materiaprima (Nome, Descricao, UnidadeMedida, Preco, QtdEstoque, QtdEstoqueMinimo) Values ('" . $_POST["Nome"] . "', '" . $_POST["Descricao"] . "', " . $_POST["Unidade"] . " , '" . $_POST["Preco"] . "', '" . $_POST["QtdEstoque"] . "', '" . $_POST["QtdEstoqueMinimo"] . "');";

			mysqli_query($conexao, $ComandoSQL) or die("Erro ao inserir produto");
		}
	}
	if($_POST["Enviar"] == "Excluir"){
		$ComandoSQL = "Delete From paogramacao.materiaprima Where idMateriaPrima = " . $_POST["idMateriaPrima"] . ";";
			mysqli_query($conexao, $ComandoSQL) or die("Erro ao excluir aluno");
		}


$materiaprima = mysqli_query($conexao,"Select Nome, idMateriaPrima, Descricao, UnidadeMedida, Preco, QtdEstoque, QtdEstoqueMinimo from paogramacao.materiaprima;") or die("Erro ao consultar alunos" . mysql_error());
?>
<table border=1>
<th>idMateriaPrima</th>
<th>Nome</th>
<th>Descrição</th>
<th>Unidade de medida</th>
<th>Preço</th>
<th>Quantidade no estoque</th>
<th>Quantidade mínima</th>
<?php
while($dados = mysqli_fetch_assoc($materiaprima)) {
	echo("<tr><td>");
	echo($dados["idMateriaPrima"]);
	echo("</td><td>");
	echo($dados["Nome"]);
	echo("</td><td>");
	echo($dados["Descricao"]);
	echo("</td><td>");
	echo($dados["UnidadeMedida"]);
	echo("</td><td>");
	echo($dados["Preco"]);
	echo("</td><td>");
	echo($dados["QtdEstoque"]);
	echo("</td><td>");
	echo($dados["QtdEstoqueMinimo"]);
	echo("</td><td>");

	echo("<form action='' method='POST'>");
	echo("<input type='hidden' name='idMateriaPrima' value='" . $dados["idMateriaPrima"] . "'>");
	echo("<input type='submit' name='Enviar' value='Excluir'>");
	echo("</form>");

	echo("</td><td>");
	echo("<form action='' method='POST'>");
	echo("<input type='hidden' name='idMateriaPrima' value='" . $dados["idMateriaPrima"] . "'>");
	echo("<input type='submit' name='Enviar' value='Editar'>");
	echo("</form>");

	echo("</td></tr>");

}
echo("</table>");
?>
</body>
</html>