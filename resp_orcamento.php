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

  $codfor = $_GET["codfor"];
  
  //Cabeçalho
  echo "<table width='1000' border='0' align='center'>";
  echo "<tr><td colspan='4' align='right' valign='center'>";
  echo "  <a href=\"menu_forn.php\"><img src=\"imagens/cancel.jpg\" width=\"16\" height=\"16\" border=\"0\" align='center'></a>";
  echo "</td>";
  echo "</tr>";
  echo "<tr><td colspan='4'><font color='white'><b><img src=\"imagens/man_orcamentos.jpg\" width=\"1000\" height=\"70\" border='0'></b></font></td></tr>";

  $dsOrc = Dataset("orcamentos, orcforn",
                   "orcamentos.CODIGO = orcforn.CODORC
                    AND CODFOR = $codfor
                    AND orcamentos.CODIGO NOT IN (SELECT CODORC
                                                    FROM resporc
                                                   WHERE CODFOR = $codfor)",
                   "DATORC DESC");
  $nrOrc = mysql_num_rows($dsOrc);
  
  echo "<tr>";
  echo "<th width= '50' align='right' >Orçamento</th>";
  echo "<th width='100' align='center'>Data</th>";
  echo "<th>Descrição</th>";
  echo "<th width= '20' align='center'>Operações</th>";
  echo "</tr>";
  
  for ($i = 0; $i < $nrOrc; $i ++) {
    $codigo = mysql_result($dsOrc, $i, "CODIGO");
    $descri = mysql_result($dsOrc, $i, "DESCRI");
    $datorc = mostraData(mysql_result($dsOrc, $i, "DATORC"));
    
    echo "<tr>";
    echo "<td align='right' >$codigo</td>";
    echo "<td align='center'>$datorc</td>";
    echo "<td>$descri</td>";
    echo "<td align='center'>
          <a href='resp_itensorc.php?codfor=$codfor&codorc=$codigo'>
          <img src=\"imagens/cadastro.jpg\" width=\"16\" height=\"16\" border=\"0\" align='center'>
          </a>
          </td>";
    echo "</tr>";
  }
  echo "</table>";
?>
