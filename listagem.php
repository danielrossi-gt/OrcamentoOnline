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
  
  $tabela = $_GET['tabela'];
  
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

  //Select com a estrutura da tabela
  $SQL = " SELECT COLUMN_NAME, COLUMN_COMMENT, EXTRA, DATA_TYPE,             ".
         "        CHARACTER_MAXIMUM_LENGTH, NUMERIC_PRECISION, NUMERIC_SCALE ".
         "   FROM INFORMATION_SCHEMA.COLUMNS                                 ".
         "  WHERE TABLE_NAME = '$tabela'                                     ".
         "   AND TABLE_SCHEMA = '$database_MySQLConn'                        ".
         " ORDER BY ORDINAL_POSITION                                         ";


  $ds = mysql_query($SQL);
  $nr = mysql_num_rows($ds); //número de registros totais
  $cs = mysql_num_rows($ds) + 1; //colspan
  
  echo "<table width='1000' border='0' align='center'>";
  echo "<tr><td colspan='2' align='right' valign='center'>";
  echo "  <a href=\"menu.php\"><img src=\"imagens/cancel.jpg\" width=\"16\" height=\"16\" border=\"0\" align='center'></a>";
  echo "</td>";
  echo "</tr>";
  echo "<tr><td colspan=2><font color='white'><b><img src=\"imagens/man_$tabela.jpg\" width=\"1000\" height=\"70\" border='0'></b></font></td></tr>";
  echo "</table>";
  echo "<table width='1000' border='0' align='center'>";
  echo "<tr>";

  //monta o cabeçalho da tabela
  for ($i = 0; $i < $nr; $i ++) {
    $colnam = mysql_result($ds, $i, 'COLUMN_NAME');
    $descri = mysql_result($ds, $i, 'COLUMN_COMMENT');
    $fextra = mysql_result($ds, $i, 'EXTRA');
    $dattyp = mysql_result($ds, $i, 'DATA_TYPE');
    $chrmax = mysql_result($ds, $i, 'CHARACTER_MAXIMUM_LENGTH');
    $nummax = mysql_result($ds, $i, 'NUMERIC_PRECISION');
    $numprc = mysql_result($ds, $i, 'NUMERIC_SCALE');

    if ($tabela != 'fornecedores') {
      echo "<th bgcolor='silver'>$descri</th>";
    }
    else {
      if (($colnam != 'NRCNPJ') &&
          ($colnam != 'ENDERE') &&
          ($colnam != 'BAIRRO') &&
          ($colnam != 'CIDADE') &&
          ($colnam != 'ESTADO') &&
          ($colnam != 'NUMCEP')) {
        echo "<th bgcolor='silver'>$descri</th>";
      }
    }
  }
  echo "<th bgcolor='silver'>Operações</th>";
  echo "</tr>";
  
  //traz os dados
  $ds = Dataset($tabela, '', '');
  $nr = mysql_num_rows($ds);
  
  //Total de Páginas
  $tp = ceil($nr / $rp);

  $ds = Dataset($tabela, '', 'CODIGO LIMIT ' . $inicio . "," . $rp);
  $nr = mysql_num_rows($ds);

  //tabela de usuarios
  if ($tabela == 'usuarios') {
    for ($i = 0; $i < $nr; $i++) {
      $codigo = mysql_result($ds, $i, 'CODIGO');
      $nomusu = mysql_result($ds, $i, 'NOMUSU');
      $tipusu = mysql_result($ds, $i, 'TIPUSU');
      $passwd = mysql_result($ds, $i, 'PASSWD');
      $descri = mysql_result($ds, $i, 'DESCRI');
      $codfor = mysql_result($ds, $i, 'CODFOR');
      
      echo "<tr>";
      echo "<td>$codigo</td>";
      echo "<td>$nomusu</td>";
      echo "<td>$tipusu</td>";
      echo "<td>******</td>"; //$passwd
      echo "<td>$descri</td>";
      echo "<td>$codfor - ";
      EscreveFornecedor($codfor, 1);
      echo "</td>";
      echo "<td width='100' align=\"center\"><a href='deletar.php?tabela=$tabela&indice=$codigo' onClick=\"return confirm('Tem certeza que deseja apagar o registro?')\"><img src='imagens/delete.png' border='0' title='Apagar'></a>&nbsp&nbsp&nbsp<a href='alterar.php?tabela=$tabela&indice=$codigo'><img src='imagens/edit.png' border='0' alt='Editar'></a></td>";
      echo "</tr>";
    }
  }
   
  //tabela de produtos
  if ($tabela == 'produtos') {
    for ($i = 0; $i < $nr; $i++) {
      $codigo = mysql_result($ds, $i, 'CODIGO');
      $descri = mysql_result($ds, $i, 'DESCRI');
      $unimed = mysql_result($ds, $i, 'UNIMED');

      echo "<tr>";
      echo "<td>$codigo</td>";
      echo "<td>$descri</td>";
      echo "<td>$unimed</td>";
      echo "<td width='100' align=\"center\"><a href='deletar.php?tabela=$tabela&indice=$codigo' onClick=\"return confirm('Tem certeza que deseja apagar o registro?')\"><img src='imagens/delete.png' border='0' title='Apagar'></a>&nbsp&nbsp&nbsp<a href='alterar.php?tabela=$tabela&indice=$codigo'><img src='imagens/edit.png' border='0' alt='Editar'></a></td>";
      echo "</tr>";
    }
  }
  
  //tabela de Orçamentos
  if ($tabela == 'orcamentos') {
    for ($i = 0; $i < $nr; $i++) {
      $codigo = mysql_result($ds, $i, 'CODIGO');
      $descri = mysql_result($ds, $i, 'DESCRI');
      $datorc = mysql_result($ds, $i, 'DATORC');
      
      $datorc = mostraData($datorc);

      echo "<tr>";
      echo "<td>$codigo</td>";
      echo "<td>$descri</td>";
      echo "<td>$datorc</td>";
      echo "<td width='100' align=\"center\">
            <a href='deletar.php?tabela=$tabela&indice=$codigo' onClick=\"return confirm('Tem certeza que deseja apagar o registro?')\">
            <img src='imagens/delete.png' border='0' title='Apagar'></a>&nbsp&nbsp&nbsp
            <a href='caditensorc.php?codigo=$codigo'><img src='imagens/edit.png' border='0' alt='Editar'></a></td>";
      echo "</tr>";
    }
  }

  //tabela de fornecedores
  if ($tabela == 'fornecedores') {
    for ($i = 0; $i < $nr; $i++) {

      $codigo = mysql_result($ds, $i, 'CODIGO');
      $razsoc = mysql_result($ds, $i, 'RAZSOC');
//      $nrcnpj = mysql_result($ds, $i, 'NRCNPJ');
//      $endere = mysql_result($ds, $i, 'ENDERE');
//      $bairro = mysql_result($ds, $i, 'BAIRRO');
//      $cidade = mysql_result($ds, $i, 'CIDADE');
//      $estado = mysql_result($ds, $i, 'ESTADO');
//      $numcep = mysql_result($ds, $i, 'NUMCEP');
      $tlfone = mysql_result($ds, $i, 'TLFONE');
      $e_mail = mysql_result($ds, $i, 'E_MAIL');
      $weburl = mysql_result($ds, $i, 'WEBURL');

      echo "<tr>";
      echo "<td>$codigo</td>";
      echo "<td>$razsoc</td>";
//      echo "<td>$nrcnpj</td>";
//      echo "<td>$endere</td>";
//      echo "<td>$bairro</td>";
//      echo "<td>$cidade</td>";
//      echo "<td>$estado</td>";
//      echo "<td>$numcep</td>";
      echo "<td>$tlfone</td>";
      echo "<td>$e_mail</td>";
      echo "<td>$weburl</td>";
      echo "<td width='100' align=\"center\">
            <a href='deletar.php?tabela=$tabela&indice=$codigo' onClick=\"return confirm('Tem certeza que deseja apagar o registro?')\">
            <img src='imagens/delete.png' border='0' title='Apagar'></a>&nbsp&nbsp&nbsp
            <a href='alterar.php?tabela=$tabela&indice=$codigo'><img src='imagens/edit.png' border='0' alt='Editar'></a></td>";
      echo "</tr>";
    }
  }

  if ($nr < $rp) {
    $pr = $rp - $nr;
    for ($i=1; $i <= $pr; $i++) {
      echo "<tr><td colspan=$cs class='noborder'></td></tr>";
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
  echo "</form>";
?>
</BODY>
</HTML>
