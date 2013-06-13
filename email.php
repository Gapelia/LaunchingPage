<?php
	session_start();
	require( 'config.php' );
	$con = mysql_connect ( SERV, USER, WRD ); 
	echo mysql_error ();
	mysql_select_db ( MOD );
	$mail = $_GET[email];
	$pass = $_GET[passwd];
	$sql="SELECT count(*) FROM users 
 					WHERE email = '" . $mail .  "'";
	$res = mysql_query ( $sql, $con );
	$count = mysql_result($res,0);
	if ($count == 1) {
		echo 0;
	} else {
		$gapKey= uniqid();
		$sql="INSERT INTO users 
 					SET email = '" . $mail . "',
 					    gap_key = '" . $gapKey . "',
 						passwd = '" .  $pass . "'";
 		$result = mysql_query ( $sql, $con );
 		echo $gapKey;
	}	
return;	