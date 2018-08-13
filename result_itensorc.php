<?php
 // require_once("valida_sessao.php");
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
  
  echo "<table width='1000' border='0' align='center'>";
  echo "<tr><td colspan='2' align='right' valign='center'>";
  echo "  <a href=\"result_orcamentos.php\"><img src=\"imagens/cancel.jpg\" width=\"16\" height=\"16\" border=\"0\" align='center'></a>";
  echo "</td>";
  echo "</tr>";
  echo "<tr><td colspan=2><font color='white'><b><img src=\"imagens/man_orcamentos.jpg\" width=\"1000\" height=\"70\" border='0'></b></font></td></tr>";

  $codorc = $_GET["codorc"];
  $desorc = $_GET["descri"];
  $datorc = $_GET["datorc"];
  
  //Dados do orçamento
  echo "<tr><td colspan=2>";
  echo "<b>Orçamento nº.: </b>$codorc<BR>";
  echo "<b>Descrição:</b> $desorc<BR>";
  echo "<b>Data:</b> $datorc";
  echo "</td></tr>";
  echo "</table>";

//  echo "Orçamento: $codorc, $desorc, $datorc<br><br>";

  $dsProd = Dataset("ORCPROD, PRODUTOS", "CODIGO = CODPRO AND CODORC = $codorc", "CODIGO");
  $nrProd = mysql_num_rows($dsProd);

  for ($i = 0; $i < $nrProd; $i++) {
    echo "<table width='1000' border='0' align='center'>";

    $codpro = mysql_result($dsProd, $i, "CODPRO");
    $despro = mysql_result($dsProd, $i, "DESCRI");
    $quanti = mysql_result($dsProd, $i, "QUANTI");
    
    echo "<tr><td class='noborder'><b>Produto: $codpro - $despro</b></td></tr>";
    
    $dsForn = Dataset("ORCFORN, FORNECEDORES", "CODIGO = CODFOR AND CODORC = $codorc", "CODIGO");
    $nrForn = mysql_num_rows($dsForn);
    
    echo "<table width='1000' border='0' align='center'>";
    echo "<tr>
          <td class='noborder'>&nbsp</td>
          <th>Código</th>
          <th>Razão Social</th>
          <th>Quantidade</th>
          <th>Valor</th></tr>";

    for ($x = 0; $x < $nrForn; $x++) {
    
      $codfor = mysql_result($dsForn, $x, "CODFOR");
      $razsoc = mysql_result($dsForn, $x, "RAZSOC");
      
      $sql = "SELECT VLRORC
                FROM resporc
               WHERE CODORC = $codorc
                 AND CODFOR = $codfor
                 AND CODPRO = $codpro";

      $dsValor = mysql_query($sql);
      $nrValor = mysql_num_rows($dsValor);
      
      $valor = 'Não Informado';
      
      if ($nrValor > 0) {
        $valor = mysql_result($dsValor, 0, "VLRORC");
        $valor = number_format($valor,2,',','.');
      }
    
      echo "<tr>
            <td class='noborder'>&nbsp</td>
            <td width='50' align='right'>$codfor</td>
            <td>$razsoc</td>
            <td width='50' align='right'>$quanti</td>
            <td width='150' align='right'>$valor</td></tr>";
    }
    echo "</table>";
  }
  
  echo "</table>";

?>
</BODY>
</HTML>
