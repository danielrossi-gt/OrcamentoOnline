<?php
  require_once("valida_sessao.php");
  include('dm.php');

/*
  echo $_POST["NOMUSU"] . '<br>';
  echo $_POST["TIPUSU"] . '<br>';
  echo $_POST["PASSWD"] . '<br>';
  echo $_POST["DESCRI"] . '<br>';
*/
  
  $tabela = 'usuarios';
  $codigo = $_POST["CODIGO"];
  $nomusu = $_POST["NOMUSU"];
  $tipusu = $_POST["TIPUSU"];
  $passwd = $_POST["PASSWD"];
  $descri = $_POST["DESCRI"];
  $codfor = $_POST["CODFOR"];
  
  $dscerr = '';
  
  //Valida��es
  if ($nomusu == '') {
    $dscerr =  "Login <br/>";
  }
  
  if ($tipusu == '') {
    $dscerr .= "Tipo do usu�rio <br/>";
  }
  
  if ($passwd == '') {
    $dscerr .= "Senha<br/>";
  }
  
  if ($descri == '') {
     $dscerr .= "Nome do Usu�rio <br/>";
  }
  
  if ($dscerr != '') {
    echo "<h3>Aten��o! Os campos abaixo s�o obrigat�rios e n�o foram preenchidos!</h3>";
    echo $dscerr;
    echo "<br/><a href='http://localhost/orconline/alterar.php?tabela=$tabela&indice=$codigo'>Voltar</a>";
  }
  else {
    UpdUsuario($codigo, $nomusu, $tipusu, $passwd, $descri, $codfor);
    include('mensagem.php');
  }

?>
