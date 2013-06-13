<?php
	session_start();
	require( 'config.php' );
	$con = mysql_connect ( SERV, USER, WRD ); 
	echo mysql_error ();
	mysql_select_db ( MOD );
	$mail = $_GET[emailb];
	$pass = $_GET[passwdb];
	$sql="SELECT * FROM users 
 					WHERE email = '" . $mail .  "'
 					AND   passwd = '" . $pass . "'";
	$res = mysql_query ( $sql, $con );
	$fetch = mysql_fetch_assoc ( $res );
	if ($fetch=='') {
		echo 0;
	} 
	else {
		echo $fetch[gap_key];
	}
return;	