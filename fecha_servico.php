<?php 
	session_start();
	require "conexao.inc.php";
	if(checkdate($_POST['mes'], $_POST['dia'], $_POST['ano'])){
		// Válido
		if($_POST['ano']."-".$_POST['mes']."-".$_POST['dia'] < $_POST['datai']){
			echo "A data informada não pode ser menor que a data de início!";
		}else{
			$fecha = $conn->exec("UPDATE servico SET dataf = '".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']."' WHERE id = '".$_POST['id']."'");
			if($fecha){
				echo "Serviço fechado com sucesso!";
			}else{
				echo "Erro ao fechar serviço.";
			}
		}
	}else{
		echo "Data inválida. Por favor digite uma data correta.";
	}
?>