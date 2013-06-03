<?php

	session_start();

	require( 'config.php' );

	$con = mysql_connect ( SERV, USER, WRD ); 
	echo mysql_error ();
	mysql_select_db ( MOD );
	
	$sql = 'SELECT * FROM users';
	
	$result = mysql_query ( $sql, $con );
	echo mysql_error ();
	
	while ( $fetch = mysql_fetch_assoc ( $result ) ) {
			$array [] = $fetch;
		}
	echo mysql_error ();
	
	print_r($array) ;




 



