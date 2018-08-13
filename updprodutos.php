<?php
  require_once("valida_sessao.php");
  include('dm.php');

  $tabela = 'produtos';
  $codigo = $_POST["CODIGO"];
  $descri = $_POST["DESCRI"];
  $unimed = $_POST["UNIMED"];
  
  $dscerr = '';

  //Validações
  if ($descri == '') {
    $dscerr =  "Descrição <br/>";
  }
  
  if ($unimed == '') {
    $dscerr .=  "Unidade de Medida <br/>";
  }

  if ($dscerr != '') {
    echo "<h3>Atenção! Os campos abaixo são obrigatórios e não foram preenchidos!</h3>";
    echo $dscerr;
    echo "<br/><a href='http://localhost/orconline/alterar.php?tabela=$tabela&indice=$codigo'>Voltar</a>";
  }
  else {
    UpdProduto($codigo, $descri, $unimed);
    include('mensagem.php');
  }
?>
