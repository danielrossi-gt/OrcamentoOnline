<?php

  if (isset($_GET["erro"])) {
    $erro = $_GET["erro"];
  }
  else {
    $erro = 0;}
    
?>
<HTML>
<HEAD>
 <TITLE>Documento PHP</TITLE>
 <link href="estilo.css" rel="stylesheet" type="text/css" />
 <script src="funcoes.js" type="text/javascript"></script>
</HEAD>
<BODY>
  <form name='frm_login' action='login.php' method='post'>
  <table width='500' align='center'>
  <tr><th colspan='2'><img src="imagens/orconline.jpg" width="500" height="250" border="0"></th></tr>
  <tr><th bgcolor='blue' colspan=2><font color='white'><b> :: Login :: </b></font></th></tr>
  <tr>
  <td width='40%' align='right'>
     Login:
  </td>
  <td>
    <input type='text' id='login' name='login' size='20' maxlength='10'>
  </td>
  </tr>
  <tr>
  <td align='right'>
     Senha:
  </td>
  <td>
    <input type='password' id='senha' name='senha' size='20' maxlength='10'>
  </td>
  </tr>
  </table>
  <table width='500' border='0' align='center'>
  <tr><td class='noborder' colspan=2 align='center'>
  <?php
    if ($erro == 1) {
      echo "<font color='red'><b>Usuário ou Senha Inválida!</b></font>";
    }
    
    if ($erro == 2) {
      echo "<font color='red'><b>Logout efetuado com sucesso!</b></font>";
    }

  ?></td></tr>
<!--  <tr><td class='noborder' colspan=2><hr></td></tr> <td class='noborder'></td>-->
  <tr><td align='right' colspan='2'><input type='button' value='OK' onClick="return validalogin()"></td></tr>
<!--  <tr><td class='noborder' colspan=2><hr></td></tr> -->
  </table>

  </form>
  
</BODY>
</HTML>
