<?php

	session_start();

	require( 'config.php' );


	$con = mysql_connect ( SERV, USER, WRD ); 
	mysql_select_db ( MOD );
	
	
	$marker = array();
	
	
	$sql="SELECT distinct coords FROM raw_data 
 					ORDER BY date DESC ";
	$result = mysql_query ( $sql, $con );

	$i=0;
	while ($fetch = mysql_fetch_assoc ( $result )){

		$marker[$i][place]=utf8_decode($fetch[coords]); // IN THE 0 IS THE PLACE, THE REST FOR THE FEELINGS
		$j=1;
		$sql="SELECT distinct feeling FROM raw_data 
 					WHERE coords =  '".$fetch[coords] . "' ORDER BY date DESC LIMIT 0,10 ";
		$res = mysql_query ( $sql, $con );
		while ($fetch_feeling = mysql_fetch_assoc ( $res )){

			
			$marker[$i][$j]=htmlentities($fetch_feeling[feeling]);
			$j++;
		}
		$i++;
	}

	
	echo json_encode($marker );//JSON_FORCE_OBJECT
	


	
return;	