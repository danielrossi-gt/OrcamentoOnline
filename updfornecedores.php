<?php
  require_once("valida_sessao.php");
  include('dm.php');

/*
  echo $_POST["NOMUSU"] . '<br>';
  echo $_POST["TIPUSU"] . '<br>';
  echo $_POST["PASSWD"] . '<br>';
  echo $_POST["DESCRI"] . '<br>';
*/
  $tabela = 'fornecedores';
  $codigo = $_POST["CODIGO"];
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

  $dscerr = '';
  
  //Valida��es
  if ($razsoc == '') {
    $dscerr =  "Raz�o Social <br/>";
  }

  if ($nrcnpj == '') {
    $dscerr .=  "CNPJ <br/>";
  }

  if ($dscerr != '') {
    echo "<h3>Aten��o! Os campos abaixo s�o obrigat�rios e n�o foram preenchidos!</h3>";
    echo $dscerr;
    echo "<br/><a href='http://localhost/orconline/alterar.php?tabela=$tabela&indice=$codigo'>Voltar</a>";
  }
  else {
    UpdFornecedor( $codigo, $razsoc, $nrcnpj, $endere, $bairro, $cidade, $estado, $numcep, $tlfone, $e_mail, $weburl );
    include('mensagem.php');
  }

?>
