<?php

	session_start();
//echo getcwd();
	require( 'config.php' );

	$con = mysql_connect ( SERV, USER, WRD ); 

	mysql_select_db ( MOD );
		
	$fee = $_SESSION[feeling];
	$pla = $_SESSION[place];
	
	$fee = mysql_real_escape_string($fee);
	$pla = mysql_real_escape_string($pla);
	
	$id = $content->id;
	$name = $content->name;



	$sql="SELECT IdUser, gap_key FROM users 
 					WHERE twt_key = '" . $id .  "'";

	$result = mysql_query ( $sql, $con );
	$fetch = mysql_fetch_assoc ( $result );
	
	if ($fetch=='') { // IF NO USER, INSERT NEW USER
		
		$gapKey= uniqid();
		
		$sql="INSERT INTO users 
 					SET email = '" . $mail . "',
 					    gap_key = '" . $gapKey . "',
 					    twt_key = '" . $id . "',
 					    name = '" . utf8_decode($name) . "'";
 				
 		$result = mysql_query ( $sql, $con );
	
 		$_SESSION['gapkey']= $gapKey;
 		
 		// GET THE USERID AND INSERT FEELING AND PLACE
 		
 		$sql="SELECT IdUser FROM users 
 					WHERE twt_key = '" . $id .  "'";
	
		$result = mysql_query ( $sql, $con );
		$fetch = mysql_fetch_assoc ( $result );
 		
 		$user = $fetch[IdUser];
	
	
		$sql="INSERT INTO raw_data 
	 					SET place = '" . utf8_decode($pla) . "',
	 					    IdUser = '" . $user . "',
	 						feeling = '" .  utf8_decode($fee) . "'";
	 						
		$result = mysql_query ( $sql, $con );
 		
 	
	} else {   // THERE IS A USER, ONLY INSERT FEELING AND PLACE
		$user = $fetch[IdUser];
	
	
		$sql="INSERT INTO raw_data 
	 					SET place = '" . utf8_decode($pla)  . "',
	 					    IdUser = '" . $user . "',
	 						feeling = '" .  utf8_decode($fee) . "'";
	 						
		$result = mysql_query ( $sql, $con );
		
		//echo $fetch[gap_key];
		$_SESSION['gapkey']= $fetch[gap_key];
	}
	