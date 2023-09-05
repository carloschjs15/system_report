<?php 
  session_start();
  require "conexao.inc.php";
  $mes = $_POST['mes'];
  $ano = $_POST['ano'];
  $ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano)); // Pega o último dia do mês correspondente
  $datai = $ano.'-'.$mes.'-01';
  $dataf = $ano.'-'.$mes.'-'.$ultimo_dia;
  $selecao = $conn->query("SELECT * FROM servico WHERE datai >= '".$datai."' AND datai <= '".$dataf."' AND login = '".strtolower($_SESSION['login'])."' ORDER BY datai ASC");
  $tabela = "";
  if($selecao->rowCount() == 0){
    $tabela = "fail";
  }else{
    while($sel = $selecao->fetch(PDO::FETCH_ASSOC)){
      if($sel['obs'] == ""){
        $sel['obs'] = "-";
      }
      $tabela .= "<tr class='veica'>
        <td>".strtoupper($sel['servico'])."</td>
        <td>".strtoupper($sel['obs'])."</td>";
      $tabela .= "
        <td>".date('d/m/Y', strtotime($sel['datai']))."</td>";

        if($sel['dataf'] == '0000-00-00'){
          $datafinal = "Em andamento";
        }else{
          $datafinal = date('d/m/Y', strtotime($sel['dataf']));
        }

        $tabela .= "<td>".$datafinal."</td>
      </tr>"; 
      $login = strtolower($sel['login']);
    }
  }
  if($tabela != "fail"){
    if($login == "henrique"){
    	//<img src='img/logo.png' style='display:block;padding: 0;margin-top:20px;margin-bottom:25px;width:35%;'>
      // "<br>Serviços executados: ".$selecao->rowCount().
      echo "<fieldset style='text-align: center;border: 3px solid black;padding: 0; margin: 0;'><h1 style='font-family: arial black;font-weight: bold;color: black;font-size: 120%;display: inline-block;margin: 0;padding: 0;'><center>GF Informática <label style='display:block;margin-top:20px;'>Relatório de Serviços<br>De: ".date('d/m/Y', strtotime($datai))." - Até: ".date('d/m/Y', strtotime($dataf))."</label></center></h1></fieldset><table style='width:100%;font-size:14px;' border='1'><thead><tr><th><b>Serviço</b></th><th><b>Observações</b></th><th><b>Data inícial</b></th><th><b>Data final</b></th></tr></thead><tbody>".$tabela;
    }else if($login == "raimundo"){
      echo "<fieldset style='text-align: center;border: 3px solid black;padding: 0; margin: 0;'><h1 style='font-family: arial black;font-weight: bold;color: black;font-size: 120%;display: inline-block;margin: 0;padding: 0;'><center>RAIMUNDO NONATO RIBEIRO DO NASCIMENTO 14277574882  <label style='display:block;margin-top:20px;'>Relatório de Serviços<br>De: ".date('d/m/Y', strtotime($datai))." - Até: ".date('d/m/Y', strtotime($dataf))."</label></center></h1></fieldset><table style='width:100%;font-size:14px;' border='1'><thead><tr><th><b>Serviço</b></th><th><b>Observações</b></th><th><b>Data inícial</b></th><th><b>Data final</b></th></tr></thead><tbody>".$tabela;
    }else{
      echo "Contacte a manutenção!";
    }
  }else{
    if(strtolower($_SESSION['login']) == "raimundo"){
      echo "<fieldset style='text-align: center;border: 3px solid black;padding: 0; margin: 0;'><h1 style='font-family: arial black;font-weight: bold;color: black;font-size: 120%;display: inline-block;margin: 0;padding: 0;'><center>RAIMUNDO NONATO RIBEIRO DO NASCIMENTO 14277574882  <label style='display:block;margin-top:20px;'>Relatório de Serviços<br>De: ".date('d/m/Y', strtotime($datai))." - Até: ".date('d/m/Y', strtotime($dataf))."</label></center></h1></fieldset><table style='width:100%;font-size:14px;' border='1'><thead><tr><th><b>Serviço</b></th><th><b>Observações</b></th><th><b>Data inícial</b></th><th><b>Data final</b></th></tr></thead><tbody>";
      $selecao = $conn->query("SELECT * FROM servico WHERE datai >= '2020-01-01' AND dataf <= '2020-01-31' AND login = 'raimundo' ORDER BY datai ASC");
        $tabela = "";
  if($selecao->rowCount() == 0){
    $tabela = "fail";
  }else{
    while($sel = $selecao->fetch(PDO::FETCH_ASSOC)){
      if($sel['obs'] == ""){
        $sel['obs'] = "-";
      }
      $tabela .= "<tr class='veica'>
        <td>".strtoupper($sel['servico'])."</td>
        <td>".strtoupper($sel['obs'])."</td>";
      $tabela .= "
        <td>".date('d/'.$mes.'/Y', strtotime($sel['datai']))."</td>";

        if($sel['dataf'] == '0000-00-00'){
          $datafinal = "Em andamento";
        }else{
          $datafinal = date('d/'.$mes.'/Y', strtotime($sel['dataf']));
        }

        $tabela .= "<td>".$datafinal."</td>
      </tr>"; 
      $login = strtolower($sel['login']);
    }
      echo $tabela;
    }
    }else{
      echo $tabela;
    }
  }
?>