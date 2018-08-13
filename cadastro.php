<?php
  require_once("valida_sessao.php");
  include("dm.php");
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

  $tabela = $_GET['tabela'];
  
  if (isset($_GET['filtro'])) {
    $filtro = $_GET['filtro'];
  }
  else {
    $filtro = '';
  }

  $SQL = " SELECT COLUMN_NAME, COLUMN_COMMENT, EXTRA, DATA_TYPE,             ".
         "        CHARACTER_MAXIMUM_LENGTH, NUMERIC_PRECISION, NUMERIC_SCALE ".
         "   FROM INFORMATION_SCHEMA.COLUMNS                                 ".
         "  WHERE TABLE_NAME = '$tabela'                                     ".
         "   AND TABLE_SCHEMA = '$database_MySQLConn'                                  ".
         " ORDER BY ORDINAL_POSITION                                         ";

  $ds = mysql_query($SQL);
  $nr = mysql_num_rows($ds);

  echo "<form name='frm_cadastro' action='cad$tabela.php' method='post'>";



  echo "<table width='500' border='0' align='center'>";
  echo "<tr><td colspan='2' align='right' valign='center'>";
  
  if (($tabela != 'orcprod') && ($tabela != 'orcforn')) {
    echo "<a href=\"menu.php\"><img src=\"imagens/cancel.jpg\" width=\"16\" height=\"16\" border=\"0\" align='center'></a>";
  }
  else {
    echo "<a href=\"\" onClick=\"window.close();\"><img src=\"imagens/cancel.jpg\" width=\"16\" height=\"16\" border=\"0\" align='center'></a>";
  }
  
  echo "</td>";
  echo "</tr>";

  echo "<tr><td colspan=2><font color='white'><b><img src=\"imagens/cad_$tabela.jpg\" width=\"500\" height=\"70\" border='0'></b></font></td></tr>";
  echo "<tr><td colspan=2></td></tr>";

  for ($i = 0; $i < $nr; $i ++) {
  
    $gerado = 0;

    $colnam = mysql_result($ds, $i, 'COLUMN_NAME');
    $descri = mysql_result($ds, $i, 'COLUMN_COMMENT');
    $fextra = mysql_result($ds, $i, 'EXTRA');
    $dattyp = mysql_result($ds, $i, 'DATA_TYPE');
    $chrmax = mysql_result($ds, $i, 'CHARACTER_MAXIMUM_LENGTH');
    $nummax = mysql_result($ds, $i, 'NUMERIC_PRECISION');
    $numprc = mysql_result($ds, $i, 'NUMERIC_SCALE');

    //Se não for campo auto-increment
    if ($fextra == '') {

      //Label do campo
      echo "<tr><td width=100 align='right'>$descri:</td>";

      //Campos especiais de uma tabela
      if ($tabela == 'usuarios' && $descri == 'Tipo' && ($gerado == 0)) {
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

      if ($tabela == 'usuarios' && $descri == 'Fornecedor' && ($gerado == 0)) {
        $dsForn = Dataset('FORNECEDORES', '', '');
        $nrForn = mysql_num_rows($dsForn);

        echo "<td><select id='$colnam' name='$colnam'>";
        echo "<option value='0'>Nenhum</option>";
        for ($y = 0; $y < $nrForn; $y ++) {
          $codigo = mysql_result($dsForn, $y, "CODIGO");
          $razsoc = mysql_result($dsForn, $y, "RAZSOC");

          echo "<option value='$codigo'>$razsoc</option>";
        }
        echo "</select></td></tr>";
        $gerado = 1;
        
      }

      //Campos normais
      //Campo de Estado
      if ($descri == 'Estado' && ($gerado == 0)) {
        echo "<td>
                <select name='$colnam' id='$colnam' name='$colnam'>
                   <option>Selecione...</option>
                   <option value='AC'>AC</option>
                   <option value='AL'>AL</option>
                   <option value='AP'>AP</option>
                   <option value='AM'>AM</option>
                   <option value='BA'>BA</option>
                   <option value='CE'>CE</option>
                   <option value='ES'>ES</option>
                   <option value='DF'>DF</option>
                   <option value='MA'>MA</option>
                   <option value='MT'>MT</option>
                   <option value='MS'>MS</option>
                   <option value='MG'>MG</option>
                   <option value='PA'>PA</option>
                   <option value='PB'>PB</option>
                   <option value='PR'>PR</option>
                   <option value='PE'>PE</option>
                   <option value='PI'>PI</option>
                   <option value='RJ'>RJ</option>
                   <option value='RN'>RN</option>
                   <option value='RS'>RS</option>
                   <option value='RO'>RO</option>
                   <option value='RR'>RR</option>
                   <option value='SC'>SC</option>
                   <option value='SP'>SP</option>
                   <option value='SE'>SE</option>
                   <option value='TO'>TO</option>
                </select>
              </td>
              </tr>";
        $gerado = 1;
      }

      //Dados do Orçamento
      //Orçamento
      if (($tabela == 'orcprod' || $tabela == 'orcforn') && ($descri == 'Orçamento') && ($gerado == 0)) {
        $descri = $_GET["descri"];
        $codorc = $_GET["codorc"];
        echo "<td>$descri<input type='hidden' name='CODORC' value='$codorc'></td>";
        $gerado = 1;
      }
      
      //Produto
      if ($descri == 'Produto' && $gerado == 0) {
        $dsp = Dataset('Produtos', '', '');
        $nrp = mysql_num_rows($dsp);
        
        echo "<td><select id='$colnam' name='$colnam'>";
        
        for ($x = 0; $x < $nrp; $x ++) {
          $codigo = mysql_result($dsp, $x, 'CODIGO');
          $descri = mysql_result($dsp, $x, 'DESCRI');
        
          echo "<option value='$codigo'>$descri</option>";

        }
        
        echo "</select></td>";
        
        $gerado = 1;
      }

      //Fornecedor
      if (($descri == 'Fornecedor')  && ($gerado == 0)){
        $dsf = Dataset('fornecedores', '', $filtro);
        $nrf = mysql_num_rows($dsf);

        echo "<td><select id='$colnam' name='$colnam'>";

        for ($z = 0; $z < $nrf; $z ++) {
          $codigo = mysql_result($dsf, $z, 'CODIGO');
          $razsoc = mysql_result($dsf, $z, 'RAZSOC');

          echo "<option value='$codigo'>$razsoc</option>";

        }

        echo "</select></td>";

        $gerado = 1;
      }


      //Campo CEP
      if (($dattyp == 'varchar') && ($descri == 'CEP') && ($gerado == 0)) {
        echo "<td><input type='text' id='$colnam' name='$colnam' size='$chrmax' maxlength='$chrmax' onkeypress=\"formatar_mascara(this, '##.###-###')\"> <i>Somente números</i></td></tr>";
        $gerado = 1;
      }

      //Campo Telefone
      if (($dattyp == 'varchar') && ($descri == 'Telefone') && ($gerado == 0)) {
        echo "<td><input type='text' id='$colnam' name='$colnam' size='$chrmax' maxlength='$chrmax' onkeypress=\"formataTel(event)\"> <i>Somente números</i></td></tr>";
        $gerado = 1;
      }

      //Campo Senha
      if (($dattyp == 'varchar') && ($descri == 'Senha') && ($gerado == 0)) {
        echo "<td><input type='password' id='$colnam' name='$colnam' size='$chrmax' maxlength='$chrmax'></td></tr>";
      }

      //Campo Varchar
      if (($dattyp == 'varchar' || $dattyp == 'date') && ($descri != 'Senha') && ($gerado == 0)) {
      
        $maxsiz = $chrmax;
        if ($chrmax > 50) { $maxsiz = 50; }

        echo "<td><input type='text' id='$colnam' name='$colnam' size='$maxsiz' maxlength='$chrmax'></td></tr>";
      }

      //Campo Integer
      if (($dattyp == 'int') && ($gerado == 0)) {
        echo "<td><input type='text' id='$colnam' name='$colnam' size='$nummax' maxlength='$nummax'></td></tr>";
      }
    }
  }
//  echo "</table>";
//  echo "<table width='500' border='0' align='center'>";
//  echo "<tr><td class='noborder' colspan=2><hr></td></tr>";
  echo "<tr><td align='right' colspan='2' class='noborder'>
        <input type='button' value='Gravar' onClick='valida$tabela()'></td></tr>";
//  echo "</td></tr>";
//  echo "<tr><td class='noborder' colspan=2><hr></td></tr>";

  echo "</table>";
  echo "</form>";
?>
</BODY>
</HTML>
