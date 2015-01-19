<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_login_form = "localhost";
$database_login_form = "login_form";
$username_login_form = "root";
$password_login_form = "";
$login_form = mysql_pconnect($hostname_login_form, $username_login_form, $password_login_form) or trigger_error(mysql_error(),E_USER_ERROR); 
?>