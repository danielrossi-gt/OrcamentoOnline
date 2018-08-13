<?php
  require_once("valida_sessao.php");
  include('dm.php');

  $descri = $_POST["DESCRI"];
  $unimed = $_POST["UNIMED"];

  InsProduto($descri, $unimed);

  $tabela = 'produtos';
  $cadastro = 1;
  include('mensagem.php');

?>
