<?php
  require_once("valida_sessao.php");
  include('dm.php');

  $tabela = 'produtos';
  $codigo = $_POST["CODIGO"];
  $descri = $_POST["DESCRI"];
  $unimed = $_POST["UNIMED"];
  
  $dscerr = '';

  //Valida��es
  if ($descri == '') {
    $dscerr =  "Descri��o <br/>";
  }
  
  if ($unimed == '') {
    $dscerr .=  "Unidade de Medida <br/>";
  }

  if ($dscerr != '') {
    echo "<h3>Aten��o! Os campos abaixo s�o obrigat�rios e n�o foram preenchidos!</h3>";
    echo $dscerr;
    echo "<br/><a href='http://localhost/orconline/alterar.php?tabela=$tabela&indice=$codigo'>Voltar</a>";
  }
  else {
    UpdProduto($codigo, $descri, $unimed);
    include('mensagem.php');
  }
?>
