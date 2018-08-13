<?php
  require_once("valida_sessao.php");
  include('dm.php');

  $tabela = 'orcamentos';
  $descri = $_POST["DESCRI"];
  $datorc = $_POST["DATORC"];

  $dscerr = '';

  //Validações
  if ($descri == '') {
    $dscerr =  "Descrição <br/>";
  }

  if ($datorc == '') {
    $dscerr .=  "Data <br/>";
  }

  if ($dscerr != '') {
    echo "<h3>Atenção! Os campos abaixo são obrigatórios e não foram preenchidos!</h3>";
    echo $dscerr;
    echo "<br/><a href='http://localhost/orconline/cadastro.php?tabela=$tabela>Voltar</a>";
  }
  else {
    $codigo = InsOrcamento( $descri, $datorc );
    $cadastro = 1;
    header("Location: caditensorc.php?codigo=$codigo");
  }

?>
