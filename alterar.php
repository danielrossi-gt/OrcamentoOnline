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
  $indice = $_GET['indice'];

  $SQL = " SELECT COLUMN_NAME, COLUMN_COMMENT, EXTRA, DATA_TYPE,             ".
         "        CHARACTER_MAXIMUM_LENGTH, NUMERIC_PRECISION, NUMERIC_SCALE ".
         "   FROM INFORMATION_SCHEMA.COLUMNS                                 ".
         "  WHERE TABLE_NAME = '$tabela'                                     ".
         "   AND TABLE_SCHEMA = '$database_MySQLConn'                                  ".
         " ORDER BY ORDINAL_POSITION                                         ";

  $ds = mysql_query($SQL);
  $nr = mysql_num_rows($ds);

  echo "<form name='frm_cadastro' action='upd$tabela.php' method='post'>";
  echo "<input type='hidden' id='CODIGO' name='CODIGO' value='$indice'>";
  echo "<table width='500' border='0' align='center'>";
  echo "<tr><td colspan='2' align='right' valign='center'>";
  echo "  <a href=\"menu.php\"><img src=\"imagens/cancel.jpg\" width=\"16\" height=\"16\" border=\"0\" align='center'></a>";
  echo "</td>";
  echo "</tr>";
  echo "<tr><td colspan=2><font color='white'><b><img src=\"imagens/cad_$tabela.jpg\" width=\"500\" height=\"70\" border='0'></b></font></td></tr>";
  echo "<tr><td colspan=2></td></tr>";

  for ($i = 1; $i < $nr; $i ++) {

    $gerado = 0;

    $colnam = mysql_result($ds, $i, 'COLUMN_NAME');
    $descri = mysql_result($ds, $i, 'COLUMN_COMMENT');
    $fextra = mysql_result($ds, $i, 'EXTRA');
    $dattyp = mysql_result($ds, $i, 'DATA_TYPE');
    $chrmax = mysql_result($ds, $i, 'CHARACTER_MAXIMUM_LENGTH');
    $nummax = mysql_result($ds, $i, 'NUMERIC_PRECISION');
    $numprc = mysql_result($ds, $i, 'NUMERIC_SCALE');
    
    $reg = "SELECT $colnam FROM $tabela WHERE CODIGO = $indice";
    $dsreg = mysql_query($reg);
    $value = mysql_result($dsreg, 0, 0);

    //Se não for campo auto-increment
    if ($fextra == '') {

      //Label do campo
      echo "<tr><td width=100 align='right'>$descri:</td>";

      //Campos especiais de uma tabela
      if ($tabela == 'usuarios' && $descri == 'Tipo') {
        echo "<td>
                <select id='$colnam' name='$colnam'>
                   <option value='A'>Administrador</option>
                   <option value='U'>Usuário</option>
                   <option value='F'>Fornecedor</option>
                </select>
              </td>
              </tr>";
        $gerado = 1;
      }
      
      if ($tabela == 'usuarios' && $descri == 'Fornecedor') {
        echo "<td>
                <select id='$colnam' name='$colnam'>";
      
        EscreveFornecedor($value, 2);
        
        echo "</select>";
      }

      //Campos normais
      //Campo de Estado
      if ($descri == 'Estado') {
        echo "<td>
                <select name='$colnam' id='$colnam' name='$colnam' value='$value'>
                   <option>Selecione...</option>";

        EscreveEstado('AC', $value);
        EscreveEstado('AL', $value);
        EscreveEstado('AP', $value);
        EscreveEstado('AM', $value);
        EscreveEstado('BA', $value);
        EscreveEstado('CE', $value);
        EscreveEstado('ES', $value);
        EscreveEstado('DF', $value);
        EscreveEstado('MA', $value);
        EscreveEstado('MT', $value);
        EscreveEstado('MS', $value);
        EscreveEstado('MG', $value);
        EscreveEstado('PA', $value);
        EscreveEstado('PB', $value);
        EscreveEstado('PR', $value);
        EscreveEstado('PE', $value);
        EscreveEstado('PI', $value);
        EscreveEstado('RJ', $value);
        EscreveEstado('RS', $value);
        EscreveEstado('RO', $value);
        EscreveEstado('RR', $value);
        EscreveEstado('SC', $value);
        EscreveEstado('SP', $value);
        EscreveEstado('SE', $value);
        EscreveEstado('TO', $value);

        echo "</select>
              </td>
              </tr>";
        $gerado = 1;
      }

      //Campo CEP
      if (($dattyp == 'varchar') && ($descri == 'CEP') && ($gerado == 0)) {
        echo "<td><input type='text' id='$colnam' name='$colnam' size='$chrmax' maxlength='$chrmax' value='$value' onkeypress=\"formatar_mascara(this, '##.###-###')\"> <i>Somente números</i></td></tr>";
        $gerado = 1;
      }

      //Campo Telefone
      if (($dattyp == 'varchar') && ($descri == 'Telefone') && ($gerado == 0)) {
        echo "<td><input type='text' id='$colnam' name='$colnam' size='$chrmax' maxlength='$chrmax' value='$value' onkeypress=\"formataTel(event)\"> <i>Somente números</i></td></tr>";
        $gerado = 1;
      }

      //Campo Senha
      if (($dattyp == 'varchar') && ($descri == 'Senha') && ($gerado == 0)) {
        echo "<td><input type='password' id='$colnam' name='$colnam' size='$chrmax' maxlength='$chrmax' value='$value'></td></tr>";
      }

      //Campo Varchar
      if (($dattyp == 'varchar') && ($descri != 'Senha') && ($gerado == 0)) {

        $maxsiz = $chrmax;
        if ($chrmax > 50) { $maxsiz = 50; }

        echo "<td><input type='text' id='$colnam' name='$colnam' size='$maxsiz' maxlength='$chrmax' value='$value'></td></tr>";
      }

      //Campo Varchar
      if (($dattyp == 'date') && ($gerado == 0)) {

        $maxsiz = $chrmax;
        if ($chrmax > 50) { $maxsiz = 50; }
        $data = mostraData ($value);

        echo "<td><input type='text' id='$colnam' name='$colnam' size='$maxsiz' maxlength='$chrmax' value='$data'></td></tr>";
      }


      //Campo Integer
      if (($dattyp == 'integer') && ($gerado == 0)) {
        echo "<td><input type='text' id='$colnam' name='$colnam' size='$nummax' maxlength='$nummax' value='$value'></td></tr>";
      }
    }
  }
  echo "<tr><td colspan=2 class='noborder'><hr></td></tr>";
  echo "<tr><td class='noborder'></td><td align='right' class='noborder'><input type='submit' value='Gravar'></td></tr>";
  echo "<tr><td colspan=2 class='noborder'><hr></td></tr>";
  echo "</table>";
  echo "</form>";
?>
</BODY>
</HTML>
