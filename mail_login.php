<?php
 
require 'config.php';
require 'gmail_mail.php';

// Get DB connection
$con = mysql_connect ( SERV, USER, WRD ); 
mysql_select_db ( MOD );

$email = $_POST['email'];
$password = $_POST['password'];

// Get cookie details
$place = $_COOKIE['place'];
$feeling = $_COOKIE['feeling'];
$with = $_COOKIE['with'];
$coord = $_COOKIE['coord'];

try {
    // Save to DB
    $sql="SELECT email, gap_key FROM users2 WHERE ext_key = '" . $password .  "'";
    //error_log($sql);
    $result = mysql_query ( $sql, $con );
    $fetch = mysql_fetch_assoc ( $result );

    if ($fetch=='') { // IF NO USER, INSERT NEW USER
        $gapKey= uniqid();
        $sql="INSERT INTO users2 
            SET email = '" . $email . "',
                gap_key = '" . $gapKey . "',
                ext_key = '" . $password . "',
                name = 'na',
                raw = 'na' ";
        $result = mysql_query ( $sql, $con );
    } else {
        $gapKey = $fetch['gap_key'];
    }

    $sql = "INSERT INTO raw_data2 SET place = '". $place ."', 
                gap_key = '". $gapKey ."', 
                coords = '". $coord . "', 
                feeling = '". $feeling ."', 
                with_whom = '". $with . "' ";
    $result = mysql_query ( $sql, $con );
} catch (Exception $e) {
    error_log($e);
}

// Set some new cookies
setcookie('gapKey', $gapKey, time() + (86400 * 365), "/"); // 86400 = 1 day
setcookie('name', $email, time() + (86400 * 365), "/");

    
// Mail
$filterWith = filter_var( $with, FILTER_VALIDATE_EMAIL );
if ($filterWith !== false) {
    mailIt($filterWith, $email, $place, $feeling);
}

// Redirect to map now
header("Location: http://www.gapelia.com/gapelian/map/");

?>