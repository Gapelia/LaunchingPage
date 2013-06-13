<?php
	session_start();
	require( 'config.php' );
	$con = mysql_connect ( SERV, USER, WRD ); 
	mysql_select_db ( MOD );
	$cookie = $_GET[cookie];
	$sql="SELECT IdUser FROM users 
 					WHERE gap_key = '" . $cookie .  "'";
	$result = mysql_query ( $sql, $con );
	$fetch = mysql_fetch_assoc ( $result ) ;
	if (mysql_errno()) {
		echo 0;
	} 
	else {
		echo $fetch[IdUser];
	}	
return;	