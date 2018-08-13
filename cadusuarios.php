<?php
  require_once("valida_sessao.php");
  include('dm.php');

/*
  echo $_POST["NOMUSU"] . '<br>';
  echo $_POST["TIPUSU"] . '<br>';
  echo $_POST["PASSWD"] . '<br>';
  echo $_POST["DESCRI"] . '<br>';
*/
  
  $nomusu = $_POST["NOMUSU"];
  $tipusu = $_POST["TIPUSU"];
  $passwd = $_POST["PASSWD"];
  $descri = $_POST["DESCRI"];
  $codfor = $_POST["CODFOR"];

  InsUsuario($nomusu, $tipusu, $passwd, $descri, $codfor);
  
  $cadastro = 1;
  $tabela = 'usuarios';
  include('mensagem.php');

?>
