<?php
	session_start();
	require( 'config.php' );
	$con = mysql_connect ( SERV, USER, WRD ); 
	mysql_select_db ( MOD );
	$fee = $_GET[feeling];
	$pla = $_GET[place];
	$cookie = $_GET[key];
	print_r($fee);
	print_r($pla);
	$sql="SELECT IdUser FROM users 
 					WHERE gap_key = '" . $cookie .  "'";
	$result = mysql_query ( $sql, $con );
	$fetch = mysql_fetch_assoc ( $result );
	if ($fetch=='') {
		echo 0;
	} 
	else {
		$user = $fetch[IdUser];
		$sql="INSERT INTO raw_data 
	 					SET place = '" . utf8_decode($pla) . "',
	 					    IdUser = '" . $user . "',
	 						feeling = '" .  utf8_decode($fee) . "'";
		$result = mysql_query ( $sql, $con );
	}
return;