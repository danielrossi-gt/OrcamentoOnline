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
  $codfor = $_POST["codfor"];

/*  echo "teste $codorc<br>";
  echo "$codfor"; */

  InsOrcForn($codorc, $codfor);

  $cadastro = 1;
  $tabela = 'orcforn';
  include('mensagem.php');
  
?>
