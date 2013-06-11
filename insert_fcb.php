<?php

	session_start();

	require( 'config.php' );

	$con = mysql_connect ( SERV, USER, WRD ); 

	mysql_select_db ( MOD );
		
	$fee = $_GET[feeling];
	$pla = $_GET[place];
	$mail = $_GET[m];
	$id = $_GET[id];
	$name = $_GET[na];
	$coords = $_GET[coord];
        $rawDump = $_GET[raw];

	
	print_r($GET);
	//print_r($pla);

	$sql="SELECT IdUser, gap_key FROM users 
 					WHERE fcb_key = '" . $id .  "'";
	
	$result = mysql_query ( $sql, $con );
	$fetch = mysql_fetch_assoc ( $result );
	
	if ($fetch=='') { // IF NO USER, INSERT NEW USER
		
		$gapKey= uniqid();
		
		$sql="INSERT INTO users 
 					SET email = '" . $mail . "',
 					    gap_key = '" . $gapKey . "',
 					    fcb_key = '" . $id . "',
 					    name = '" . utf8_decode($name) . "',
                                            rawDump = '" . $rawDump . "' ";
 				
 		$result = mysql_query ( $sql, $con );
	
 		echo $gapKey;
 		
 		// GET THE USERID AND INSERT FEELING AND PLACE
 		
 		$sql="SELECT IdUser FROM users 
 					WHERE fcb_key = '" . $id .  "'";
	
		$result = mysql_query ( $sql, $con );
		$fetch = mysql_fetch_assoc ( $result );
 		
 		$user = $fetch[IdUser];
	
	
		$sql="INSERT INTO raw_data 
	 					SET place = '" . utf8_decode($pla) . "',
	 					    coords = '" . $coords . "',
	 					    IdUser = '" . $user . "',
	 						feeling = '" .  utf8_decode($fee) . "'";
	 						
		$result = mysql_query ( $sql, $con );
 		
 	
	} else {   // THERE IS A USER, ONLY INSERT FEELING AND PLACE
		$user = $fetch[IdUser];
	
	
		$sql="INSERT INTO raw_data 
	 					SET place = '" . utf8_decode($pla) . "',
	 					    coords = '" . $coords . "',
	 					    IdUser = '" . $user . "',
	 						feeling = '" .  utf8_decode($fee) . "'";
	 						
		$result = mysql_query ( $sql, $con );
		
		echo $fetch[gap_key];
	}
	return;