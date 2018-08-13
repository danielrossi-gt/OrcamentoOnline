<?php
  require_once("valida_sessao.php");
  include("dm.php");
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
  <tr><td width='50%' valign='top'>
    <h3><img src="imagens/cadastro.jpg" width="16" height="16" border="0"> Cadastros</h3>
    <ul type="circle">
     <li><a href="cadastro.php?tabela=usuarios">Usuários</a></li>
     <li><a href="cadastro.php?tabela=produtos">Produtos</a></li>
     <li><a href="cadastro.php?tabela=fornecedores">Fornecedores</a></li>
     <li><a href="cadastro.php?tabela=orcamentos">Orçamentos</a></li>
    </ul>
  
  </td>
  <td valign='top'>
  
    <h3><img src="imagens/manutencao.jpg" width="16" height="16" border="0"> Manutenção</h3>
    <ul type="circle">
     <li><a href="listagem.php?tabela=usuarios">Usuários</a></li>
     <li><a href="listagem.php?tabela=produtos">Produtos</a></li>
     <li><a href="listagem.php?tabela=fornecedores">Fornecedores</a></li>
     <li><a href="listagem.php?tabela=orcamentos">Orçamentos</a></li>
  <?php
    $ds = Dataset('empresa', '', '');
    $nr = mysql_num_rows($ds);
    $codigo = mysql_result($ds, 0, "CODIGO");

    if ($nr > 0) {
      echo "<li><a href='alterar.php?tabela=empresa&indice=$codigo'>Empresa</a></li>";
    }
    else {
      echo "<li><a href='cadastro.php?tabela=empresa'>Empresa</a></li>";
    }

  ?>

    </ul>
  
  </td>
  </tr>
  <tr>
  <td colspan=2 align=center>
  <a href='result_orcamentos.php'>
   Visualizar respostas de orçamentos
  </a>
  </td>
  </tr>

</BODY>
</HTML>
