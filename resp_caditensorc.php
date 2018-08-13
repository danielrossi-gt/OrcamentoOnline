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
  
  $codorc = $_POST["codorc"];
  $codfor = $_POST["codfor"];
  $valor  = $_POST["valor"]; // captura todos os campos em um array

  $valor = gravaMoeda($valor);

  $dsProd = Dataset("ORCPROD, PRODUTOS",
                    "CODPRO = CODIGO
                     AND CODORC = $codorc",
                    "CODIGO");
  $nrProd = mysql_num_rows($dsProd);
  
  for ($i = 0; $i < $nrProd; $i ++) {
  
    $codigo = mysql_result($dsProd, $i, "CODIGO");
    
    $vlrorc = $valor[$codigo];


    $sql = "INSERT INTO RESPORC
                   (CODORC, CODPRO, CODFOR, VLRORC)
                 VALUES
                   ($codorc, $codigo, $codfor, $vlrorc)";

    mysql_query($sql) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $sql . "\"</i>");;
  }

  $tabela = 'resporc';
  include('mensagem.php');
?>
</BODY>
</HTML>
