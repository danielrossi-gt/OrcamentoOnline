<?php

  include('dm.php');
  
  echo 'Testando <br/>';
  
  /*
  $ds = Dataset('USUARIOS', '', 'CODIGO DESC');
  $nrUsuarios = mysql_num_rows($ds);

  for ($i=0; $i < $nrUsuarios; $i++) {

  	$descri = mysql_result($ds, $i, "DESCRI");
	
	echo 'descri: ' . $descri . '<br/>';

  }	
  */

  // InsUsuario ('TESTE', 'A', '123', 'TESTE');
  
  // DelUsuario (2);
  
  //UpdUsuario(3, 'ADMIN', 'A', '123', 'Administrador');
  
//  InsProduto( 'Caneta Bic', 'Caixa' );

//  DelProduto(1);

//   UpdProduto(2, 'Caneta Bic Azul', 'Un');

//   InsFornecedor('DebCred', '123456789', 'Rua 1, 152', 'Centro',
//                 'Limeira', 'SP', '13480-041', '(19) 3546-1392', 'contato@debcred.com.br', 'www.debcred.com.br');
                 
//  DelFornecedor(2);

  UpdFornecedor(3, 'DebCred Sistemas de Gestão', '123456789', 'Rua 1, 152', 'Centro',
                 'Limeira', 'SP', '13480-041', '(19) 3546-1392', 'contato@debcred.com.br', 'www.debcred.com.br');

?>
