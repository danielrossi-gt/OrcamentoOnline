<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_MySQLConn = "localhost";
$database_MySQLConn = "orconline";
$username_MySQLConn = "root";
$password_MySQLConn = "";
//$password_MySQLConn = "root";
$MySQLConn = mysql_pconnect($hostname_MySQLConn, $username_MySQLConn, $password_MySQLConn) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_MySQLConn, $MySQLConn);  
?>
