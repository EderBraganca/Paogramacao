<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar produto</title>
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
		margin-left: 150px;
		background-color: #5a352c;
		color: white;
		width: 500px;
		height: 200px;
		position: fixed;
		margin-top: -180px;
		font-size: 30px;
	}

</style>
</head>
<body>
<a href="index.php"><button>Menu inicial</button></a>
<a href="materiaPrima.php"><button>Cadastrar Matéria Prima</button></a>
	<form action="" method="POST">
		<table>
		<tr><td>Nome:</td><td>
			<input type="text" name="Nome" required>
		</td></tr>
		<tr><td>Descrição: (Max: 300 caracteres)</td><td>
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
		<tr><td>Preço custo(em R$):</td><td>
		<input type="Number" name="Preco" required>
		<tr><td>Percentual de lucro:</td><td>
		<input type="Number" name="PercentualLucro" required>
		<td><input type='Submit' name='Enviar' value='Inserir Produto' id="btInserir"></td>
	</form>
<hr>

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
		if($_POST["Enviar"] == "Inserir Produto"){
			$ComandoSQL = "Insert Into paogramacao.produto (Nome, Descricao, UnidadeMedida, PrecoCusto, PercentualLucro) Values ('" . $_POST["Nome"] . "', '" . $_POST["Descricao"] . "', " . $_POST["Unidade"] . " , '" . $_POST["Preco"] . "', '" . $_POST["PercentualLucro"] . "');";


			mysqli_query($conexao, $ComandoSQL) or die("Erro ao inserir produto");
		}
		if($_POST["Enviar"] == "Excluir"){
		$ComandoSQL = "Delete From paogramacao.Produto Where idProduto = " . $_POST["idProduto"] . ";";
			mysqli_query($conexao, $ComandoSQL) or die("Erro ao excluir aluno");
		}

	}
$Produto = mysqli_query($conexao,"Select Nome, idProduto, Descricao, UnidadeMedida, PrecoCusto, PercentualLucro from paogramacao.produto;") or die("Erro ao consultar alunos" . mysql_error());

?>

<table border=1>
<th>idProduto</th>
<th>Nome</th>
<th>Descricao</th>
<th>Unidade de medida</th>
<th>Preço Custo</th>
<th>Percentual de lucro</th>
<?php
while($dados = mysqli_fetch_assoc($Produto)) {
	echo("<tr><td>");
	echo($dados["idProduto"]);
	echo("</td><td>");
	echo($dados["Nome"]);
	echo("</td><td>");
	echo($dados["Descricao"]);
	echo("</td><td>");
	echo($dados["UnidadeMedida"]);
	echo("</td><td>");
	echo($dados["PrecoCusto"]);
	echo("</td><td>");
	echo($dados["PercentualLucro"]);
	echo("</td><td>");

	echo("<form action='' method='POST'>");
	echo("<input type='hidden' name='idProduto' value='" . $dados["idProduto"] . "'>");
	echo("<input type='submit' name='Enviar' value='Excluir'>");
	echo("</form>");

	echo("</td><td>");
	echo("<form action='' method='POST'>");
	echo("<input type='hidden' name='idProduto' value='" . $dados["idProduto"] . "'>");
	echo("<input type='submit' name='Enviar' value='Editar'>");
	echo("</form>");

	echo("</td></tr>");

}
echo("</table>");
?>

</body>
</html>