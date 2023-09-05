<?php 
	session_start();
	require "conexao.inc.php";
	$sel = $conn->query("SELECT * FROM servico WHERE id = '".$_POST['id']."'");
	while($s = $sel->fetch(PDO::FETCH_ASSOC)){
		$servico = $s['servico'];
		$obs = $s['obs'];
		$datai = $s['datai'];
		$dataf = $s['dataf'];
	}
	echo "<p>Digite o serviço: </p><input type='text' name='servico' placeholder='Serviço' automplete='on' title='Digite o serviço.' required='on' id='input_servico' value='".$servico."'><textarea placeholder='Observações' title='Digite a Observações do serviço' autocomplete='on' name='obs' id='obs'>".$obs."</textarea><span class='text-primary'>Selecione a data inícial: </span>
	<input type='date' name='datai' id='datai' required='on' value='".$datai."'><br><span class='text-primary'>Selecione a data final: </span><input type='date' name='dataf' id='dataf' value='".$dataf."' min = '".$datai."'><input type='hidden' name='id' value='".$_POST['id']."'>";
?>