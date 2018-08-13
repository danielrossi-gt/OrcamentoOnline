<HTML>
<HEAD>
 <TITLE>Documento PHP</TITLE>
 <link href="estilo.css" rel="stylesheet" type="text/css" />
 <script src="funcoes.js" type="text/javascript"></script>
</HEAD>
<BODY>

<?php

  if (isset($cadastro)) {
    $url = "cadastro.php?tabela=$tabela";
  }
  else {
    $url = "listagem.php?tabela=$tabela";
  }

  if ($tabela == 'empresa') {
    $url = "menu.php";
  }
  
  if ($tabela == 'orcprod' || $tabela == 'orcforn') {
    echo "<script language='javascript'>opener.location.reload();</script>";
  }

  echo "<table width='500' border='0' align='center'>";
  echo "<tr><td colspan='2' align='right' valign='center'>";
  
  if ($tabela == 'resporc') {
    echo "<a href=\"menu_forn.php\"><img src=\"imagens/cancel.jpg\" width=\"16\" height=\"16\" border=\"0\" align='center'></a>";
  }
  else if (($tabela != 'orcprod') && ($tabela != 'orcforn')) {
    echo "<a href=\"menu.php\"><img src=\"imagens/cancel.jpg\" width=\"16\" height=\"16\" border=\"0\" align='center'></a>";
  }
  else {
    echo "<a href=\"\" onClick=\"window.close();\"><img src=\"imagens/cancel.jpg\" width=\"16\" height=\"16\" border=\"0\" align='center'></a>";
  }
  
  echo "</td>";
  echo "</tr>";
  echo "<tr><td colspan=2><font color='white'><b><img src=\"imagens/cad_$tabela.jpg\" width=\"500\" height=\"70\" border='0'></b></font></td></tr>";
  echo "<tr><td colspan=2 align='center'><br/><br/><br/><br/><br/><br/><b>Operação realizada com sucesso!<br/><br/></b><br/><br/><br/><br/><br/></td></tr>";
  echo "</table>";

?>

</BODY>
</HTML>
