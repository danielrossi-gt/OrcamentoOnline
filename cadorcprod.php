<?php
  require_once("valida_sessao.php");
  include('dm.php');

/*
  echo $_POST["NOMUSU"] . '<br>';
  echo $_POST["TIPUSU"] . '<br>';
  echo $_POST["PASSWD"] . '<br>';
  echo $_POST["DESCRI"] . '<br>';
*/

  $codorc = $_POST["CODORC"];
  $codpro = $_POST["codpro"];
  $quanti = $_POST["QUANTI"];

/*  echo "teste $codorc<br>";
  echo "$codpro"; */

  InsOrcProd($codorc, $codpro, $quanti);

  $cadastro = 1;
  $tabela = 'orcprod';
  include('mensagem.php');
  
?>
