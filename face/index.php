<?php

// http://www.cuarzomundo.net/blog/utilizando-login-twitter-en-pagina-web/

// FACEBOOK
//App ID/API Key
//578454235517060
//Código secreto de la aplicación
//80f5c41062211b34019cc379abadda18
//App Namespace
//gapeliapp
//Sandbox Mode
//Activado
//Listed Platforms
//Sitio web con Facebook Login



require("twitteroauth.php");
session_start();
if(empty($_SESSION['oauth_uid'])){
	//Mensaje para decirle al usuario que de click a un enlace -> auth.php
 	echo 'click a un enlace -> auth.php'; 
}else{
	$twitteroauth = new TwitterOAuth('-------','-------------------', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	$user_info = $twitteroauth->get('account/verify_credentials');
	if(isset($user_info->error)){
		header("Location: auth.php");
	} else {
		//contenido a mostrar
		echo 'a mostrar contenido';
	}
}