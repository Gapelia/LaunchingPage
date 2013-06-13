<?
session_start();
session_destroy();
		unset($_SESSION);
		unset($_SESSION['oauth_token_secret']);
		unset($_SESSION['oauth_secret']);
		unset($_SESSION['oauth_token']);
		unset($_SESSION['access_token']);
		unset($_SESSION['oauth_uid']);
		header('Location: index.php');
		?>