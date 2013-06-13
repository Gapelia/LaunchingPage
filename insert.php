<?php
	session_start();
	require( 'config.php' );
	$con = mysql_connect ( SERV, USER, WRD ); 
	echo mysql_error ();
	mysql_select_db ( MOD );
	$fee = $_GET[feeling];
	$pla = $_GET[place];
	$id = $_GET[id];
	$coord = $_GET[coord];
	print_r($fee);
	print_r($pla);
	if ($id=='') {
		$sql="INSERT INTO raw_data 
 			SET place = '" . utf8_decode($pla) . "',
 			    coords = '" . $coord . "',
 				feeling = '" .  utf8_decode($fee) . "'";
	} 
	else {
		$sql="INSERT INTO raw_data 
 					SET place = '" . utf8_decode($pla) . "',
 					coords = '" . $coord . "',
 					 IdUser = '" . $id . "',  
 						feeling = '" .  utf8_decode($fee) . "'";
	}					
	$result = mysql_query ( $sql, $con );
	echo mysql_error ();