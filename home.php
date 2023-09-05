<?php
  session_start();
  setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' ); 
  date_default_timezone_set( 'America/Fortaleza' );
  require "conexao.inc.php";
  if(!isset($_SESSION['login'])){
    echo "<script>alert('Acesso negado, por favor efetue o login!'); window.location = 'index.html';</script>";
  }

  if(isset($_POST['add_serv'])){
    $add = $conn->exec("INSERT INTO servico VALUES(default, '".$_POST['servico']."','".$_POST['obs']."','".$_POST['datai']."','".$_POST['dataf']."','".date('m')."','".date('Y')."','".trim($_SESSION['login'])."')");
    if($add){
      echo "<script>alert('Serviço adicionado com sucesso!'); window.location = 'home.php';</script>";
    }else{
      echo "<script>alert('Erro ao adicionar serviço!'); window.location = 'home.php';</script>";
    }
  }
  if(isset($_POST['edita_serv'])){
    $edita = $conn->exec("UPDATE servico SET servico = '".$_POST['servico']."', obs = '".$_POST['obs']."', datai = '".$_POST['datai']."',dataf = '".$_POST['dataf']."' WHERE id= '".$_POST['id']."'");
    if($edita){
     echo "<script>alert('Serviço editado com sucesso!'); window.location = 'home.php';</script>"; 
    }else{
      echo "<script>alert('Erro ao editar serviço!'); window.location = 'home.php';</script>";
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistema de relatório de serviços</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="font1.css" rel="stylesheet">
  <link href="font2.css" rel="stylesheet">
  <link rel="icon" href="img/icon.png">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/resume.min.css" rel="stylesheet">

</head>

<body id="page-top">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-none d-lg-block">
            <img src="img/logo.png" title="Casa TI">
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#about">Início</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#experience">Adicionar Serviço</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#education">Edição/Exclusão/Visualização</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#skills">Fechar serviço em andamento</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#awards">Relatório mensal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="sair.php">Sair</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container-fluid p-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="about">
      <div class="w-100">
        <h1 class="mb-0">Relatório
          <span class="text-primary">de Serviços</span>
        </h1>
        <div class="subheading mb-5">CARLOS HENRIQUE JACINTO DA SILVA 07831240314
          <a href="mailto:name@email.com">CNPJ: 31.648.718/0001-12</a>
        </div>
        <!-- <p class="lead mb-5">I am experienced in leveraging agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.</p>
        <div class="social-icons">
          <a href="#">
            <i class="fab fa-linkedin-in"></i>
          </a>
          <a href="#">
            <i class="fab fa-github"></i>
          </a>
          <a href="#">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#">
            <i class="fab fa-facebook-f"></i>
          </a>
        </div> -->
      </div>
    </section>

    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex justify-content-center" id="experience">
      <div class="w-100">
        <h2 class="mb-5">Adicionar Serviço</h2>

        <div class="resume-item d-flex flex-column flex-md-row justify-content-between">
          <form action="" method="post" id="form_add">
            <div class="resume-content">
              <h3 class="mb-0">Digite o serviço: </h3>
              <div class="subheading mb-6"><input type="text" name='servico' placeholder="Serviço" automplete="on" title="Digite o serviço." required="on" id="input_servico"></div>
              <textarea placeholder="Observações" title="Digite a Observações do serviço" autocomplete="on" name="obs" id="obs"></textarea>
            </div>
            <div class="resume-date text-md-right">
              <span class="text-primary">Selecione a data inícial: </span>
              <input type="date" name="datai" id="datai" required="on" value="<?php echo date('Y-m-01'); ?>">
              <span class="text-primary">Selecione a data final: </span>
              <input type="date" name="dataf" id="dataf" value="<?php echo date('Y-m-d'); ?>">
              <input type="submit" value="Adicionar" title="Adicionar serviço" name="add_serv">
            </div>
          </form>
        </div>

      </div>

    </section>

    <hr class="m-0">

    <div class="modal fade" id="define" data-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Editar Serviço</h4>
                  </div>
              <form action="" method="post" enctype="multipart/form-data">
                  <div class="modal-body" id="estadia_form">
                    <!-- Puchar todos os slides -->
                    <!-- <input type="file" name="imag" accept="image/png, image/jpeg, image/jpg"> -->
                    <!-- <input type="hidden" name="tipo1" value="0" id="tipo1"> -->
                  </div>
                  <div class="modal-footer">
                    <!-- <button type="button" id='delramal' class="btn btn-danger pull-left"><i class="fa fa-times fa-lg"></i></button>   -->
                    <button type="submit" class="btn btn-primary" name='edita_serv'>Editar</button>  
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </div>
              </form>
            </div>
          </div>
      </div>

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="education">
      <div class="w-100" id="divedicao">
        <h2 class="mb-5">Edição / Exclusão / Visualização</h2>

        <?php 
            $sel = $conn->query("SELECT * FROM servico WHERE login = '".$_SESSION['login']."' AND dataf!='0000-00-00' AND mes='".date('m')."' AND ano = '".date('Y')."'");
            if($sel->rowCount() == 0){
              echo "No momento você não possui serviços fechado nesse mês.";
            }
            while($linha = $sel->fetch(PDO::FETCH_ASSOC)){
              //Data de início: ?>
              <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5" id="serv<?php echo $linha['id'];?>">
                <div class="resume-content" onclick="edicao_servico(<?php echo $linha['id'];?>)">
                  <h3 class="mb-0"><?php echo $linha['servico'];?></h3>
                  <div class="subheading mb-3">Início: <?php echo date('d/m/Y',strtotime($linha['datai']));?> - Fim: <?php echo date('d/m/Y',strtotime($linha['dataf']));?></div>
                  <p><?php echo $linha['obs'];?></p>
                </div>
                <div class="resume-date text-md-right">
                  <button class='btn btn-default' type='button' onclick="deleta_servico(<?php echo $linha['id'];?>)"><span class="text-primary">Excluir</span></button>
                </div>
              </div>
            <?php }
          ?>

      </div>
    </section>

    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="skills">
      <div class="w-100">
        <h2 class="mb-5">Fechar Serviços em Andamento</h2>

        <ul class="fa-ul mb-0" id="fecha_servicos">
          <!-- <li>
            <i class="fa-li fa fa-check"></i>
            Mobile-First, Responsive Design
          </li> -->
          <?php 
            $sel = $conn->query("SELECT * FROM servico WHERE login = '".$_SESSION['login']."' AND dataf='0000-00-00' AND mes='".date('m')."' AND ano = '".date('Y')."'");
            if($sel->rowCount() == 0){
              echo "No momento você não possui serviços em andamento.";
            }
            while($linha = $sel->fetch(PDO::FETCH_ASSOC)){
              //Data de início: ?>
              <li onclick="fecha_servico(<?php echo $linha['id'].",'".$linha['datai'];?>')" id="op<?php echo $linha['id'];?>"><i class='fa-li fa fa-check'></i><?php echo $linha['servico']." | ".date('d/m/Y', strtotime($linha['datai']));?></li>
            <?php }
          ?>  
        </ul>
      </div>
    </section>

    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="awards">
      <div class="w-100">
        <h2 class="mb-5">Relatório mensal</h2>
        <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-3">
          <p>Selecione o mês: </p>
          <input type="number" value="<?php echo date('m');?>" name="mes" id="mes_rel" min="1" max="12">
          <p>Selecione o ano: </p>
          <input type="number" value="<?php echo date('Y');?>" name="ano" id="ano_rel" max="<?php echo date('Y');?>">
        </div>
        <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-3">
          <button class="btn btn-primary" title="Gerar relatório" id="gerar">Gerar</button>
          <button class="btn btn-warning" title="Imprimir relatório" id="imprimir" onclick="imprime()">Imprimir</button>
        </div>

        <div id="janela_tabela" value="0">
          
        </div>
      </div>

    </section>



  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/resume.min.js"></script>

  <script type="text/javascript">
    function edicao_servico(id){
      $("#define").modal("show");
      $.ajax({
        url: 'consulta_servico.php',
        method: 'post',
        data: {'id': id},
        success:function(data){
          $("#estadia_form").html(data);
        }
      });
    }
    function imprime(){
      if($("#janela_tabela").attr("value") == "1"){
        var conteudo = document.getElementById('janela_tabela').innerHTML;
        tela_impressao = window.open('SIRE');
        tela_impressao.document.write(conteudo);
        tela_impressao.window.print();
        tela_impressao.window.close();
      }else{
        alert("Nada a ser impresso, por favor gere primeiro o relatório!");
      }
    }
    function fecha_servico(id, data){
      dia = prompt("Digite o dia: ");
      mes = prompt("Digite o mês: ");
      ano = prompt("Digite o ano: ");
      $.ajax({
        url: 'fecha_servico.php',
        method: 'post',
        data: {'id': id, 'dia':dia, 'mes':mes, 'ano':ano, 'datai':data},
        success:function(data){
          alert(data);
          if(data == "Serviço fechado com sucesso!"){
            $("#op"+id).remove();
          }
        }
      });
    }
    function deleta_servico(id){
      if(confirm("Você está deletando o serviço!")){
        $.ajax({
          url: 'deleta_servico.php',
          method: 'post',
          data: {'id': id},
          success:function(data){
            alert(data);
            if(data == "Serviço deletado com sucesso!"){
              $("#serv"+id).remove();
            }
          }
        });
      }
    }
    $(document).ready(function(){
      $("#gerar").on("click",function(){
        $.ajax({
          url: 'gera_relatorio.php',
          method: 'post',
          data: {'mes':$("#mes_rel").val(), 'ano':$("#ano_rel").val()},
          success:function(data){
            if(data == "fail"){
              alert("Não foi possível gerar relatório, pois nesse período não há serviço registrado!");
            }else{
              //alert(data);
              $("#janela_tabela").html(data);
              $("#janela_tabela").attr("value","1");
            }
          }
        });
      });
    });
  </script>
</body>

</html>
