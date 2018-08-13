<?php
  require_once("valida_sessao.php");
  include('dm.php');

  $tabela = $_GET["tabela"];
  $indice = $_GET["indice"];

  if ($tabela == 'usuarios') {
    DelUsuario($indice);
  }

  if ($tabela == 'produtos') {
    DelProduto($indice);
  }

  if ($tabela == 'fornecedores') {
    DelFornecedor($indice);
  }
  
  if ($tabela == 'orcamentos') {
    DelOrcamento($indice);
  }

  if ($tabela == 'orcprod') {
    $codpro = $_GET["produto"];
    DelOrcProd($indice, $codpro);
    header("Location: caditensorc.php?codigo=$indice");
  }

  if ($tabela == 'orcforn') {
    $codfor = $_GET["codfor"];
    DelOrcForn($indice, $codfor);
    header("Location: caditensorc.php?codigo=$indice");
  }


  if (($tabela != 'orcforn') && ($tabela != 'orcprod')) {
    include('mensagem.php');
  }

?>
