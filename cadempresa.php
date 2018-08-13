<?php
  require_once("valida_sessao.php");
  include('dm.php');

/*
  echo $_POST["NOMUSU"] . '<br>';
  echo $_POST["TIPUSU"] . '<br>';
  echo $_POST["PASSWD"] . '<br>';
  echo $_POST["DESCRI"] . '<br>';
*/


  $razsoc = $_POST["RAZSOC"];
  $nrcnpj = $_POST["NRCNPJ"];
  $endere = $_POST["ENDERE"];
  $bairro = $_POST["BAIRRO"];
  $cidade = $_POST["CIDADE"];
  $estado = $_POST["ESTADO"];
  $numcep = $_POST["NUMCEP"];
  $tlfone = $_POST["TLFONE"];
  $e_mail = $_POST["E_MAIL"];
  $weburl = $_POST["WEBURL"];


  InsEmpresa(  $razsoc, $nrcnpj, $endere, $bairro, $cidade, $estado, $numcep, $tlfone, $e_mail, $weburl);

  $tabela = 'empresa';
  include('mensagem.php');

?>
