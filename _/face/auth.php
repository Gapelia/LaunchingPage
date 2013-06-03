<?
require("twitteroauth.php");
session_start();

$twitteroauth = new TwitterOAuth('--------','--------------------------');
$request_token = $twitteroauth->getRequestToken('http://url-de-la-pagina.web/callback.php');

$_SESSION['oauth_token'] = $request_token['oauth_token'];  
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
if($twitteroauth->http_code==200){
	$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']); 
	header('Location: '. $url);
} else {
	die('Something wrong happened.');
}
?>
