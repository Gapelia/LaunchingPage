<?
require("twitteroauth.php");
session_start();

 if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){  
	$twitteroauth = new TwitterOAuth('-----','---------------------------', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']); 
	$_SESSION['access_token'] = $access_token; 
	$user_info = $twitteroauth->get('account/verify_credentials');
	if(isset($user_info->error)){
		session_destroy();
		unset($_SESSION);
		unset($_SESSION['oauth_token_secret']);
		unset($_SESSION['oauth_secret']);
		unset($_SESSION['oauth_token']);
		unset($_SESSION['access_token']);
		if($user_info->error=="Rate limit exceeded. Clients may not make more than 350 requests per hour.")
		{ echo "Demasiadas conexiones"; exit(); }
		header('Location: auth.php'); 
	} else {
		mysql_connect();
		mysql_select_db();
		$query_info = mysql_query("SELECT * FROM users WHERE oauth_uid = ". $user_info->id);
		$info_user = mysql_fetch_array($query_info);
		if(empty($info_user)){
		mysql_query("INSERT INTO users VALUES ('','".$user_info->id."', '".$user_info->screen_name."','')");  
		$query_info = mysql_query("SELECT * FROM users WHERE oauth_uid = ". $user_info->id); 
		$info_user = mysql_fetch_array($query_info);
		} 
		$_SESSION['oauth_uid'] = $info_user['oauth_uid'];
		$_SESSION['oauth_token'] = $access_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $access_token['oauth_token_secret'];
	header('Location: index.php'); 
	}
} else {  
	header('Location: auth.php');  
 }
?>
