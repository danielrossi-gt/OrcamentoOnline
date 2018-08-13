<?php
  require_once("valida_sessao.php");
?>

<HTML>
<HEAD>
 <TITLE>Documento PHP</TITLE>
 <link href="estilo.css" rel="stylesheet" type="text/css" />
 <script src="funcoes.js" type="text/javascript"></script>
</HEAD>
<BODY>

<?php
  require_once('Connections/MySQLConn.php');
  include('dm.php');
  
  $codigo = $_GET["codigo"];
  $ds = Dataset("orcamentos", "CODIGO = $codigo", "");
  
  $descri = mysql_result($ds, 0, "DESCRI");
  $datorc = mostraData(mysql_result($ds, 0, "DATORC"));
  
  //Cabeçalho
  echo "<table width='1000' border='0' align='center'>";
  echo "<tr><td colspan='2' align='right' valign='center'>";
  echo "  <a href=\"menu.php\"><img src=\"imagens/cancel.jpg\" width=\"16\" height=\"16\" border=\"0\" align='center'></a>";
  echo "</td>";
  echo "</tr>";
  echo "<tr><td colspan=2><font color='white'><b><img src=\"imagens/man_orcamentos.jpg\" width=\"1000\" height=\"70\" border='0'></b></font></td></tr>";

  //Dados do orçamento
  echo "<tr><td colspan=2>";
  echo "<b>Orçamento nº.: </b>$codigo<BR>";
  echo "<b>Descrição:</b> $descri<BR>";
  echo "<b>Data:</b> $datorc";
  echo "</td></tr>";


  //Fornecedores
  echo "<tr><td valign=\"center\" width=\"25%\" class=noborder>";
  echo "<b>Inclusão de Fornecedores</b></td><td class=noborder align='right'>
        <a href='' onClick='window.open(\"cadastro.php?tabela=orcforn&codorc=$codigo&descri=$descri\", \"JANELA\", \"scrollbars = yes, height = 340 , width = 550, top=100 , left=600\");'>
        <img src=\"imagens/cadastro.jpg\" width=\"16\" height=\"16\" border=\"0\" align='center'></td></a>";
  echo "</td></tr>";

  $sqlfor = "SELECT orcforn.codfor codfor, fornecedores.RAZSOC razsoc".
            "  FROM orcforn, fornecedores".
            " WHERE orcforn.CODORC = $codigo".
            "   AND fornecedores.CODIGO = orcforn.codfor";
            
  $dsfor = mysql_query($sqlfor);
  $nrfor = mysql_num_rows($dsfor);

  echo "<tr><td colspan=2>";
  echo "<table width='100%'>";

  for ($i = 0; $i < $nrfor; $i ++) {
    $codfor = mysql_result($dsfor, $i, "codfor");
    $desfor = mysql_result($dsfor, $i, "razsoc");
    echo "<tr><td width='20' align='center'>";
    echo "<a href='deletar.php?tabela=orcforn&indice=$codigo&codfor=$codfor' onClick=\"return confirm('Tem certeza que deseja apagar o registro?')\"><img src=\"imagens/cancel.jpg\" width=\"16\" height=\"16\" border=\"0\" align='center'></td>";
    echo "<td width='40' align='right'>$codfor</a></td><td>$desfor<BR></td>";
    echo /*"$forinc</td>*/"</tr>";
  }
  echo "</table>";
  
  echo "<tr><td valign=\"center\" width=\"25%\" class=noborder>";
  echo "<b>Inclusão de Produtos</b></td><td class=noborder align='right'>
        <a href='' hint='Apagar' onClick='window.open(\"cadastro.php?tabela=orcprod&codorc=$codigo&descri=$descri\", \"JANELA\", \"scrollbars = yes, height = 340 , width = 550, top=100 , left=600\");'>
        <img src=\"imagens/cadastro.jpg\" width=\"16\" height=\"16\" border=\"0\" align='center'></a></td>";
  echo "</td></tr>";
  echo "<tr><td colspan=2>";

  $sqlpro = "SELECT orcprod.codpro codpro, produtos.DESCRI descri, orcprod.QUANTI quanti, produtos.UNIMED unimed" .
            "  FROM orcprod, produtos" .
            " WHERE orcprod.CODORC = $codigo" .
            "   AND orcprod.codpro = produtos.CODIGO";
            
  $dspro = mysql_query($sqlpro);
  $nrpro = mysql_num_rows($dspro);

  echo "<table width='100%'>";
  for ($i = 0; $i < $nrpro; $i ++) {
    $codpro = mysql_result($dspro, $i, "codpro");
    $despro = mysql_result($dspro, $i, "descri");
    $quanti = mysql_result($dspro, $i, "quanti");
    $unimed = mysql_result($dspro, $i, "unimed");
    
    echo "<tr><td width='20' align='center'>";
    echo "<a href='deletar.php?tabela=orcprod&indice=$codigo&produto=$codpro' onClick=\"return confirm('Tem certeza que deseja apagar o registro?')\"><img src=\"imagens/cancel.jpg\" width=\"16\" height=\"16\" border=\"0\" align='center'></a></td>";
    echo "<td width='40' align='right'>$codpro</td><td>$despro </td><td>$quanti</td><td>$unimed</td></tr>";
  }
  echo "</table>";

  echo "</td></tr>";
  echo "</table>";
  mysql_close();
  
?>
