<?php

	session_start();

	require( 'config.php' );


	$con = mysql_connect ( SERV, USER, WRD ); 
	mysql_select_db ( MOD );
	
	
	$marker = array();
	
	
	$sql="SELECT distinct coords FROM raw_data 
 					ORDER BY date DESC ";
	$result = mysql_query ( $sql, $con );
	//print_r($result);
	$i=0;
	while ($fetch = mysql_fetch_assoc ( $result )){
		//echo '<br>';
		//print_r($fetch[place]);
		$marker[$i][place]=utf8_decode($fetch[coords]); // IN THE 0 IS THE PLACE, THE REST FOR THE FEELINGS
		$j=1;
		$sql="SELECT distinct feeling FROM raw_data 
 					WHERE coords =  '".$fetch[coords] . "' ORDER BY date DESC LIMIT 0,10 ";
		$res = mysql_query ( $sql, $con );
		while ($fetch_feeling = mysql_fetch_assoc ( $res )){
			//echo '<br>';
			//print_r($fetch_feeling[feeling]);
			
			$marker[$i][$j]=htmlentities($fetch_feeling[feeling]);
			$j++;
		}
		$i++;
	}
	//echo '<br>';
	//print_r($marker);
	//$marker = array_map('htmlentities',$marker);
	//$json = html_entity_decode(json_encode($marker));
	//echo $json;
	
	echo json_encode($marker );//JSON_FORCE_OBJECT
	
	//echo '<br>';
//	
//	if (mysql_errno()) {
//		echo 0;
//	} else {
//		echo $fetch[place];
//	}	

	
return;	