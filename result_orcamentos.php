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
  
  //Registros por página
  $rp = 10;
  
  //Prepara paginação
  if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
  }
  else {
    $pagina = '';
  }

  if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
  }
  else {
    $inicio = ($pagina - 1) * $rp;
  }
  
  $ds = Dataset("orcamentos", "CODIGO IN (SELECT CODORC FROM resporc)", "DATORC DESC");
  $nr = mysql_num_rows($ds);
  
  //Total de Páginas
  $tp = ceil($nr / $rp);

  $ds = Dataset("orcamentos", 'CODIGO IN (SELECT CODORC FROM resporc)', 'DATORC DESC LIMIT ' . $inicio . "," . $rp);
  $nr = mysql_num_rows($ds);
  
  echo "<table width='1000' border='0' align='center'>";
  echo "<tr><td colspan='2' align='right' valign='center'>";
  echo "  <a href=\"menu.php\"><img src=\"imagens/cancel.jpg\" width=\"16\" height=\"16\" border=\"0\" align='center'></a>";
  echo "</td>";
  echo "</tr>";
  echo "<tr><td colspan=2><font color='white'><b><img src=\"imagens/man_orcamentos.jpg\" width=\"1000\" height=\"70\" border='0'></b></font></td></tr>";
  echo "</table>";

  echo "<table width='1000' border='0' align='center'>";
  echo "<tr>";
  echo "<th width=50>Código</th><th>Descrição</th><th width=80>Data</th><th width=20 align=center>Operações</th>";
  echo "</tr>";

  for ($i = 0; $i < $nr; $i++) {
    $codigo = mysql_result($ds, $i, "CODIGO");
    $descri = mysql_result($ds, $i, "DESCRI");
    $datorc = mysql_result($ds, $i, "DATORC");
    
    $datorc = mostraData($datorc);
    
    echo "<tr><td>$codigo</td><td>$descri</td><td>$datorc</td><td align=center>
          <a href='result_itensorc.php?codorc=$codigo&descri=$descri&datorc=$datorc'>
          <img src='imagens/visualizar.jpg' width=\"16\" height=\"16\" border=\"0\" align='center' alt='Visualizar'></a></td></tr>";
    
    
  }
  
  if ($nr < $rp) {
    $pr = $rp - $nr;
    for ($i=1; $i <= $pr; $i++) {
      echo "<tr><td colspan=$ds class='noborder'></td></tr>";
    }
  }
  echo "</table>";

  echo "<table width='1000' border='0' align='center'>";
  echo "<tr><td colspan=2 class='noborder'><hr></td></tr>";
  echo "<tr><td class='noborder' colspan=2><p class='tinytext'>";

  if ($tp > 1) {
    echo "Páginas: ";
    for ($i=1; $i<=$tp; $i++) {
      if ($pagina == $i) {
        echo $pagina . " ";
      }
      else {
        echo " <a href=\"listagem.php?tabela=$tabela&pagina=$i\">$i</a> ";
      }
    }
  }

  echo "</p></td></tr>";
  echo "</table>";



?>
</BODY>
</HTML>
