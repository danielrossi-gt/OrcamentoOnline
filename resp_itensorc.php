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

<form method="POST" action="resp_caditensorc.php">

<?php
  require_once('Connections/MySQLConn.php');
  include('dm.php');
  
  $codfor = $_GET["codfor"];
  $codorc = $_GET["codorc"];

  echo "<input type='hidden' name='codorc' value=$codorc>";
  echo "<input type='hidden' name='codfor' value=$codfor>";
  
  //Cabeçalho
  echo "<table width='1000' border='0' align='center'>";
  echo "<tr><td colspan='5' align='right' valign='center'>";
  echo "  <a href='menu_forn.php'><img src='imagens/cancel.jpg' width='16' height='16' border='0' align='center'></a>";
  echo "</td>";
  echo "</tr>";
  echo "<tr><td colspan='5'><font color='white'><b><img src='imagens/man_orcamentos.jpg' width='1000' height='70' border='0'></b></font></td></tr>";

  $dsProd = Dataset("ORCPROD, PRODUTOS",
                    "CODPRO = CODIGO
                     AND CODORC = $codorc",
                    "CODIGO");
  $nrProd = mysql_num_rows($dsProd);

  echo "<tr>";
  echo "<th width= '50' align='right'>Produto</th>";
  echo "<th>Descrição</th>";
  echo "<th width= '50' align='right'>Quantidade</th>";
  echo "<th width= '50' align='right'>Un. Medida</th>";
  echo "<th width= '50' align='right'>Valor</th>";
  echo "</tr>";

  for ($i = 0; $i < $nrProd; $i ++) {
    $codigo = mysql_result($dsProd, $i, "CODIGO");
    $descri = mysql_result($dsProd, $i, "DESCRI");
    $quanti = mysql_result($dsProd, $i, "QUANTI");
    $unimed = mysql_result($dsProd, $i, "UNIMED");
    
    echo "<tr>";
    echo "<td align='right'>$codigo</td>";
    echo "<td>$descri</td>";
    echo "<td align='right'>$quanti</td>";
    echo "<td align='right'>$unimed</td>";
    echo "<td align='right'><input type='text' size='20' name='valor[$codigo]'></td>";
    echo "</tr>";

  }
  echo "<tr><td align='right' colspan='5'><input type='submit' value='Gravar'></td>";
  echo "</table>";
?>

</form>
</BODY>
</HTML>
