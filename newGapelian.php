<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8"/>
		<title>Gapelia</title>

		<!--/ GAPELIA
			 ______   ______   ______  ______   __       __   ______
			/\  ___\ /\  __ \ /\  == \/\  ___\ /\ \     /\ \ /\  __ \
			\ \ \__ \\ \  __ \\ \  _-/\ \  __\ \ \ \____\ \ \\ \  __ \
			 \ \_____\\ \_\ \_\\ \_\   \ \_____\\ \_____\\ \_\\ \_\ \_\
				\/_____/ \/_/\/_/ \/_/    \/_____/ \/_____/ \/_/ \/_/\/_/

			//////// 01000111011000010111000001100101011011000110100101100001

		/-->

		<meta name="description" content=""/>
		<meta name="keywords" content=""/>
		<meta name="author" content="Gapelia"/>

		<link href="http://gapelia.com/css/style.css" rel="stylesheet"/>
		<link href="http://gapelia.com/images/favicon.PNG" rel="shortcut icon"/>

		<style>
			#social-banner {
				width: 100%; height: auto;
				background-color: rgba(254, 254, 254, 0.3);
				bottom: 0;
				box-sizing: border-box;
				color: #191919;
				font-size: 14px;
				font-weight: 800;
				padding: 0.2rem 0;
				position: absolute;
				text-align: center;
			}

			#social-banner a {
				color: #191919;
				text-decoration: none;
			}

			#social-banner a:hover { opacity: 0.7; }

			/**************************************/

			#third-page form { width: 65%; }
		</style>

	</head>

	<body id="third-page">

		<div class="content">
			<h1>You can be first in line,<br/>sign up to reserve a seat</h1>

			<form action="/mail/" method="POST" id="form-map">
				<button id="login-google" class="login-google login">Sign up with Google</button><br/>
				<button id="login-facebook" class="login-facebook login">Sign up with Facebook</button>
			</form>

			<br class="clear"/>

			<h3>*We promise not to spam you, pinky promise</h3>

			<div id="logo-wrapper">
				<a id="logo" href=""></a><p class="logo-tagline">Be curious</p>
			</div>
		</div>

		<div id="social-banner">
			<a href="https://www.facebook.com/pages/Gapelia/461725877232129?id=461725877232129&amp;sk=app_190322544333196" target="_blank">Facebook</a> &middot;
			<a href="http://gapelia.tumblr.com" target="_blank">Tumblr</a>
		</div>

		<script src="http://gapelia.com/scripts/jquery-1.8.1.min.js"></script>
		<script src="http://www.itsyndicate.ca/gssi/jquery/jquery.crypt.js"></script>
		<script src="http://gapelia.com/scripts/jquery.scrollTo.js"></script>
		<script src="http://gapelia.com/scripts/md5.js"></script>
		<script src="http://gapelia.com/scripts/cookie.js"></script>
		<script src="http://gapelia.com/scripts/jquery.reveal.js"></script>
		<script src="https://raw.github.com/placemarker/jQuery-MD5/master/jquery.md5.js"></script>
		<script src="https://raw.github.com/carhartl/jquery-cookie/master/jquery.cookie.js"></script>

		<script>
			function setCookies() {
				$.cookie("place", "<?php print $_POST["place"] ?>", {path: '/'});
				$.cookie("feeling", "<?php print $_POST["feeling"] ?>", {path: '/'});
				$.cookie("with", "<?php print $_POST["with"] ?>", {path: '/'});
				$.cookie("coord", "<?php print $_POST["coord"] ?>", {path: '/'});
			}
                        
                        function IsEmail(email) {
                            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                            return regex.test(email);
                        }
                        
			$(document).ready(function () {
				$("#mail").click(function () {
					setCookies();
                                        var em = $("#email").val();
                                        var pw = $("#password").val();
                                        var isMail = IsEmail(em);
                                        if (!isMail || (pw == undefined) || (pw == "")) {
                                            alert("Please enter a valid email and password");
                                            return false;
                                        }
					$("#loginType").val("mail");
					$("#password").val($.md5($("#password").val()));
					$("#form-map").attr("action", "/mail/");
					$("#form-map").submit();
				});
				$("#login-facebook").click(function () {
					setCookies();
					$("#loginType").val("facebook");
					$("#form-map").attr("action", "/facebook/");
					$("#form-map").submit();
				});
				$("#login-google").click(function () {
					setCookies();
					$("#loginType").val("google");
					$("#form-map").attr("action", "/google/");
					$("#form-map").submit();
				});
			});
		</script>

		<script src="http://maps.google.com/maps/api/js?key=AIzaSyCMqYZrdDg5sNRysahSHZh6t400-BwJtig&amp;libraries=places&amp;sensor=false"></script>

		<script>
			(function (i, s, o, g, r, a, m) {
				i["GoogleAnalyticsObject"] = r;
				i[r] = i[r] || function () {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
				a = s.createElement(o), m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m)
			})(window, document, "script", "//www.google-analytics.com/analytics.js", "ga");
			ga("create", "UA-41288707-1", "gapelia.com");
			ga("send", "pageview");
		</script>

	</body>

</html>
