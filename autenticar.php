<?php
	session_start();
	require "conexao.inc.php";
	$logar = $conn->query("SELECT * FROM user WHERE login = '".$_POST['login']."' AND senha = '".$_POST['senha']."'");
	if($logar->rowCount() == 0){
		echo "<script>alert('Usuário ou senha incorreta!');window.location = 'index.html';</script>";
	}else{
		$_SESSION['login'] = strtolower($_POST['login']);
		echo "<script>window.location = 'home.php';</script>";
	}
?>
