<?php
	session_start();
	require "conexao.inc.php";
	$del = $conn->exec("DELETE FROM servico WHERE id = '".$_POST['id']."'");
	if($del){
		echo "Serviço deletado com sucesso!";
	}else{
		echo "Erro ao deletar serviço!";
	}
?>