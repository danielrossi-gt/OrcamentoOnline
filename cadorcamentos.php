<?php
  require_once("valida_sessao.php");
  include('dm.php');

  $tabela = 'orcamentos';
  $descri = $_POST["DESCRI"];
  $datorc = $_POST["DATORC"];

  $dscerr = '';

  //Valida��es
  if ($descri == '') {
    $dscerr =  "Descri��o <br/>";
  }

  if ($datorc == '') {
    $dscerr .=  "Data <br/>";
  }

  if ($dscerr != '') {
    echo "<h3>Aten��o! Os campos abaixo s�o obrigat�rios e n�o foram preenchidos!</h3>";
    echo $dscerr;
    echo "<br/><a href='http://localhost/orconline/cadastro.php?tabela=$tabela>Voltar</a>";
  }
  else {
    $codigo = InsOrcamento( $descri, $datorc );
    $cadastro = 1;
    header("Location: caditensorc.php?codigo=$codigo");
  }

?>
