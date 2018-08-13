<?php
  require_once("valida_sessao.php");
  include("dm.php");
  $descri = $_SESSION["descri"];
  $codfor = $_SESSION["codfor"];

  $ds = Dataset("orcamentos, orcforn",
                "orcforn.CODORC = CODIGO AND
                 orcforn.CODFOR = $codfor AND
                 CODIGO NOT IN (SELECT CODORC
                        FROM resporc
                       WHERE CODFOR = $codfor)", "");
                       
  $nr = mysql_num_rows($ds);
  
?>
<HTML>
<HEAD>
 <TITLE>:: Menu Principal ::</TITLE>
 <link href="estilo.css" rel="stylesheet" type="text/css" />
</HEAD>
<BODY>
  <table width='500' align='center'>
  <tr>
  <td colspan='2' align='right' valign='center'>
    <a href="logout.php"><img src="imagens/cancel.jpg" width="16" height="16" border="0" align='center'></a>
  </td>
  </tr>
  <tr><th colspan='2'><img src="imagens/orconline.jpg" width="500" height="250" border="0"></th></tr>
  <tr><th bgcolor='blue' colspan=2><font color='white'><b> :: Menu Principal :: </b></font></th></tr>
  <tr>
  <td>
      <h3>Bem Vindo <?php echo $descri ?>!</h3>
      <?php
        if ($nr > 0) {
          echo "Você tem <a href='resp_orcamento.php?codfor=$codfor'>$nr</a> orçamento(s) pendente(s).";
        }
        else {
          echo "Você não tem orçamentos pendentes.";
        }
      ?>

  </td>
  </tr>

</BODY>
</HTML>
