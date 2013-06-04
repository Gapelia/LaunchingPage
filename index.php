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

		<link href="css/global.css" rel="stylesheet"/>
		<link href="css/styles.css" rel="stylesheet"/>

		<link href="images/favicon.ico" rel="shortcut icon"/>

		<style>
			.content .logo-fb, .content .logo-tb {
				width: 90px; height: 90px;

				background-position: center center;
				background-repeat: no-repeat;
				background-size: 32px 32px;
				border-radius: 5000px;
				bottom: 20.7%;
				box-sizing: border-box;
				color: transparent;
				display: inline-block;
				font-size: 0;
				line-height: 0;
				padding: 4rem 0;
				position: absolute;
				text-align: center;
			}

			.content .logo-fb:hover, .content .logo-tb:hover { opacity: 0.7; }

			.content .logo-fb {
				background-color: #3d75a0;
				background-image: url("images/social-facebook.png");
				border: 3px solid #1c4e76;
				left: 38%;
			}

			.content .logo-tb {
				background-color: #2e4b67;
				background-image: url("images/social-tumblr.png");
				border: 3px solid #253d53;
				right: 39%;
			}

			.go-back {
				margin: 1rem; padding: 0.5rem;

				background-color: #191919;
				box-sizing: border-box;
				color: #fefefe;
				opacity: 0.5;
			}

			.close {
				color: #fefefe;
				font-size: 20px;
			}

			/***************************************************************/

			.pac-container {
				margin: 1rem 0 0 0; padding: 1rem 0.8rem;

				background-color: #fefefe;
				border: 0;
				border-radius: 10px;
				box-sizing: border-box;
				font-family: "Open Sans", Arial, sans-serif;
				font-size: 13px;
			}

			.pac-item {
				margin: 0 0 0.5rem 0;
			}
		</style>

		<script>
			var feeling="";
			var place= "";
			var res;
			var id="";
			var con= 0;
		</script>

	</head>

	<body>

		<div id="wrapper">
			<div id="mask">

				<!--/ first page /-->

				<div id="item1" class="item">
					<div class="content">

						<div id="page-01-text"></div>
						<a id="page-01-button" class="panel" href="#item2"></a>

						<a class="logo" href=""></a>
						<!--/ <a class="logo-fb" href="https://www.facebook.com/pages/Gapelia/461725877232129?id=461725877232129&sk=app_190322544333196" target="_blank">fb</a> /-->
						<a class="logo-fb" href="https://www.facebook.com/pages/Gapelia/461725877232129?id=461725877232129&amp;sk=app_190322544333196" target="_blank">fb</a>
						<a class="logo-tb" href="http://gapelia.tumblr.com" target="_blank">t</a>

					</div>
				</div>

				<!--/ second page /-->

				<div id="item2" class="item">
					<div class="content">

						<div id="page-02-text-01"></div>
						<a href="http://localhost/g-launch#item1" class="go-back">BACK</a>

						<form id="form-01" method="post">
							<input id="place" placeholder="ANYWHERE IN THE WORLD..." type="text"/><br/>
							<input id="feeling" placeholder="FEELING ANY EMOTION..." type="text"/>
							<!--/ <input type="submit" style="width: 0; height: 0; border: none; padding: 0;" hidefocus="true"/> /-->
						</form>

						<div id="page-02-text-02"></div>
						<a id="new_btn" class="submit panel" href="#item3"></a><!--/ <a href="#" id="button">Click me</a> /-->
						<a id="skip_btn" class="skip" href="">SKIP</a>

						<a class="logo" href=""></a>
						<!--/ <a class="logo-fb" href="https://www.facebook.com/pages/Gapelia/461725877232129?id=461725877232129&sk=app_190322544333196" target="_blank">fb</a> /-->
						<a class="logo-fb" href="https://www.facebook.com/pages/Gapelia/461725877232129?id=461725877232129&amp;sk=app_190322544333196" target="_blank">fb</a>
						<a class="logo-tb" href="http://gapelia.tumblr.com" target="_blank">t</a>

						<div id="modal">
							<div id="content">
								<a id="YES" href="#">I want to be a Gapelian</a><br/>
								<a id="NO" href="#">I am a Gapelian</a><br/>
								<!--/ <a class="close" href="#">&times;</a> /-->
							</div>
						</div>

						<!--/
						<div id="modal">
							<div id="heading">New Gapelian?</div>

							<div id="content">
								<a id="YES" href="#" class="button green close"><img src="images/tick.png" alt=""/>I am a new Gapelian</a>
								<a id="NO" href="#" class="button red close"><img src="images/cross.png" alt=""/>I am a returning Gapelian</a>
							</div>
						</div>
						/-->

					</div>
				</div>

				<!--/ third page /-->

				<div id="item3" class="item">
					<div class="content">

						<div id="page-03-text"></div>
						<a href="http://localhost/g-launch#item2" class="go-back">BACK</a>

						<form>
							<div class="left">
								<input id="input-email" name="email" type="email" placeholder="NEW EMAIL" required/><br/>
								<input id="input-passwd" name="password" type="password" placeholder="NEW PASSWORD" required/>

								<!--/ <a id="mail" class="submit login" href=""></a> /-->
							</div>

							<div class="right">
								<a href="" id="fcb-01" class="login-facebook login">Login with Facebook</a><br/>
								<a href="" id="twt-01" class="login-twitter login">Login with Twitter</a>
								<!--/ <a href="" class="login-google">Login with Google+</a> /-->
							</div>
						</form>

						<!--/ <a class="submit panel" href="#item4"></a> /-->

						<a class="logo" href=""></a>
						<!--/ <a class="logo-fb" href="https://www.facebook.com/pages/Gapelia/461725877232129?id=461725877232129&sk=app_190322544333196" target="_blank">fb</a> /-->
						<a class="logo-fb" href="https://www.facebook.com/pages/Gapelia/461725877232129?id=461725877232129&amp;sk=app_190322544333196" target="_blank">fb</a>
						<a class="logo-tb" href="http://gapelia.tumblr.com" target="_blank">t</a>

					</div>
				</div>

				<!--/ fourth page /-->

				<div id="item3b" class="item">
					<div class="content">

						<div id="page-03-textb"></div>
						<a href="http://localhost/g-launch#item2" class="go-back">BACK</a>

						<form>
							<div class="left">
								<input id="input-emailb" name="email" type="email" placeholder="EMAIL" required/><br/>
								<input id="input-passwdb" name="password" type="password" placeholder="PASSWORD" required/>
							</div>

							<div class="right">
								<a href="" id="fcb-02" class="login-facebook login">Login with Facebook</a><br/>
								<a href="" id="twt-02" class="login-twitter login">Login with Twitter</a>
								<!--/ <a href="" class="login-google">Login with Google+</a> /-->
							</div>
						</form>

						<!--/ <a id="mailb" class="submit login" href=""></a> /-->

						<a class="logo" href=""></a>
						<!--/ <a class="logo-fb" href="https://www.facebook.com/pages/Gapelia/461725877232129?id=461725877232129&sk=app_190322544333196" target="_blank">fb</a> /-->
						<a class="logo-fb" href="https://www.facebook.com/pages/Gapelia/461725877232129?id=461725877232129&amp;sk=app_190322544333196" target="_blank">fb</a>
						<a class="logo-tb" href="http://gapelia.tumblr.com" target="_blank">t</a>

					</div>
				</div>

			</div>
		</div>

		<script src="http://code.jquery.com/jquery-1.8.1.min.js"></script>

		<script>
			$(document).ready(function() {
				$(".logo").show();
				$(".logo-fb").hide();
				$(".logo-tb").hide();
				event.preventDefault();

				$(".logo").click(function() {
					$(".logo-fb").fadeToggle();
					$(".logo-tb").fadeToggle();
					event.preventDefault();
				});
			});
		</script>

		<script>
			/*
			$(document).ready(function () {
				$("#form-01").on("submit", function (e) {
					e.preventDefault();
				});

				$("#feeling").on("keydown", function (e) {
					if (e.which === 13) {
						$("#form-01").trigger("submit");
						return false;
					}
				});
			});
			*/

			$("#feeling").on("keydown", function(e) {
				if (e.which === 13) {
					$(this).parent("form").submit(); 
				}
			});

			$("form").on("submit", function(e) {
				var self = $(this);

				e.PreventDefault();
				return false;
			});
		</script>

		<script src="http://www.itsyndicate.ca/gssi/jquery/jquery.crypt.js"></script>

		<script src="scripts/jquery.scrollTo.js"></script>
		<script src="scripts/md5.js"></script>
		<script src="scripts/cookie.js"></script>
		<script src="scripts/functions.js"></script>
		<script src="scripts/jquery.reveal.js"></script>

		<script>
			function logoff() {
				$.removeCookie("gapelia");

				// log off
				phpUrl = "http://gapelia.com/development/logoff.php"; 
				$.get(phpUrl);
			}

			$(document).ready(function() {
				/*
				// button which will activate our modal
				$("#new_btn").click(function(e) {
					if (gapeliano === 1) {
						// the item which will be opened with reveal
						$("#modal").reveal({
							animation: "fade",						// fade, fadeAndPop, none
							animationspeed: 600,					// how fast animtions are
							closeonbackgroundclick: true,	// if you click background will modal close?
							dismissmodalclass: "close"		// the class of a button or element that will close an open modal
						});
					}

					alert(gapeliano);
					return false;
				});

				if (gapeliano) {
					$("#wrapper").scrollTo("#item3", 200); // create account
					return false;
				}

				else {
					$("#wrapper").scrollTo("#item3b", 200); // create account by mail
					return false;
				}
				*/

				$("#YES").click(function() {
					$("#wrapper").scrollTo("#item3", 600); // create account
				});

				$("#NO").click(function() {
					$("#wrapper").scrollTo("#item3b", 600);  // log by mail
				});

				$("a.panel").click(function() {
					$("a.panel").removeClass("selected");
					$(this).addClass("selected");

					current = $(this);

					if (current.attr("href") == "#item2" ) {
						$("#wrapper").scrollTo("#item2", 600);

						// if connected, or cookie exists, skip this process
						if (con==1 || $.cookie("gapelia")!= null) {
							//	alert("CONECTADO SKIP APPEARS");
							$("#skip_btn").css("display", "block");
						}

						return false;
					}

					// if user is new, create account
					else if (current.attr("href") == "#item3" ) {
						// user submits after completing place and feeling

						// get place and feeling
						place = $("#place").val();
						feeling = $("#feeling").val();

						// check not empty
						if  (place == "" || feeling=="") {
							// alert ("Missing data"); // only in production
							// $("#place").css("color", "red");

							$("#place").attr("placeholder", "ANYWHERE IN THE WORLD...").blur();
							$("#place").addClass("placehold");

							// $("#place").css("background-color", "red");
							// $("#feeling").css("color", "red");
							// $("#feeling").css("background-color", "red");

							$("#feeling").attr("placeholder", "FEELING ANY EMOTION...").blur();
							$("#feeling").addClass("placehold");

							return false; // only in production
						}

						else {
							geocoder = new google.maps.Geocoder();

							geocoder.geocode( { "address": place}, function(results, status) {
								if (status == google.maps.GeocoderStatus.OK) {
									// if place is correct, identify
									var cook = $.cookie("gapelia");

									// full cookie
									if (cook != "" && cook != null) {
										// get user ID
										phpUrl = "http://gapelia.com/development/loginID.php?cookie="+$.cookie("gapelia"); // only in production

										$.get(phpUrl).done(function(data) {
											if (data== 0) {
												alert("Identification Error, please login again");
												logoff();

												return false;
											}

											else {
												id = data;
												// store place and feeling with user
												position_place = results[0].geometry.location;
												pos_map = encodeURI(position_place);
												// alert(pos_map);

												phpUrl = "http://gapelia.com/development/insert.php?feeling="+feeling+"&place="+place+"&id="+id+"&coord="+pos_map; // only in production

												$.get(phpUrl).done(function(data) {
													window.location = "map.php"; // go to map
												});
											}
										});
									}

									// cookie empty
									else {
										position_place = results[0].geometry.location;
										pos_map = encodeURI(position_place);
										// alert(pos_map);

										// always store place and feeling
										phpUrl = "http://gapelia.com/development/insert.php?feeling="+feeling+"&place="+place+"&id="+id+"&coord="+pos_map; // only in production
										$.get(phpUrl);

										// first time open dialog
										// gapeliano=confirm("New Gapelian?");

										// the item which will be opened with reveal
										$("#modal").reveal({
											animation: "fade",						// fade, fadeAndPop, none
											animationspeed: 600,					// how fast animtions are
											closeonbackgroundclick: true,	// if you click background will modal close?
											dismissmodalclass: "close"		// the class of a button or element that will close an open modal
										});
									}
								}

								else {
									// alert("Place not found: " + status);

									$("#place").val("");
									$("#place").attr("placeholder", "Place not found").blur();
									$("#place").addClass("placehold");

									return false;
								}
							});
						}
					}

					else if (current.attr("href") == "#item3b") {
						// user has account
					}

					else {
						$("#wrapper").scrollTo($(this).attr("href"), 200);
						return false;
					}

					return false;
				});

				$(window).resize(function() {
					resizePanel();
				});

				// for intial set of logins
				$("a.login").click(function() {
					if ($(this).attr("id")=="fcb-01") {
						// alert ("LOGIN FCB");
						fb_login();
					}

					else if ($(this).attr("id")=="twt-01") {
						// alert ("LOGIN TWT");
						// get the auth URL

						geocoder = new google.maps.Geocoder();

						geocoder.geocode( { "address": place}, function(results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
								phpUrl = "http://gapelia.com/twitter/redirect.php?feeling="+feeling+"&place="+place;

								$.get(phpUrl).done(function(data) {
									if (data == "0") {
										alert("Could not connect to Twitter. Refresh the page or try again later.");
									}

									else {
										window.location = data;
									}
								});
							}
						});
					}

					else if ($(this).attr("id")=="mail") { loginmail(); }
					else if ($(this).attr("id")=="mailb") { checkmail(); }

					return false;
				});

				// for second set of logins, when a user returns
				$("a.login").click(function() {
					if ($(this).attr("id")=="fcb-02") {
						// alert ("LOGIN FCB");
						fb_login();
					}

					else if ($(this).attr("id")=="twt-02") {
						// alert ("LOGIN TWT");
						// get the auth URL

						geocoder = new google.maps.Geocoder();

						geocoder.geocode( { "address": place}, function(results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
								phpUrl = "http://gapelia.com/twitter/redirect.php?feeling="+feeling+"&place="+place;

								$.get(phpUrl).done(function(data) {
									if (data == "0") {
										alert("Could not connect to Twitter. Refresh the page or try again later.");
									}

									else {
										window.location = data;
									}
								});
							}
						});
					}

					else if ($(this).attr("id")=="mail") { loginmail(); }
					else if ($(this).attr("id")=="mailb") { checkmail(); }

					return false;
				});

				$("a.skip").click(function() {
					window.location = "map.php";
					return false;
				});

				return false;
			});
		</script>

		<script>
			function fb_login() {
				FB.login(function(response) {
					if (response.session) {
						if (response.perms) { console.log("perms"); }
						if (response.scope) { console.log("scope"); }

						else {
							// user is logged in, but did not grant any permissions
							alert("No Permissions...");
						}
					}

					else {
						// user is not logged in // alert("Please login to facebook");
						console.log(response);
					}
				}, { scope:"email" });
			}

			window.fbAsyncInit = function() {
				FB.init({
					// channelUrl					: "//www.gapelia.com/development/index.php", // Channel File
					// extendPermissions		: "email", // ask for email
					appId								: "578454235517060",
					status							: true, // check login status
					cookie							: true, // enable cookies to allow the server to access the session
					oauth								: true,
					xfbml								: true  // parse XFBML
				});

				FB.Event.subscribe("auth.authResponseChange", function(response) {
					if (response.status === "connected") {
						// alert ("connected");
						con = 1; // CONNECTED

						// get data
						FB.api("/me", function(response) {
							res = response;

							if (place != "" && feeling !="") {
								geocoder = new google.maps.Geocoder();

								geocoder.geocode( {"address": place}, function(results, status) {
									if (status == google.maps.GeocoderStatus.OK) {
										position_place = results[0].geometry.location;
										pos_map = encodeURI(position_place);

										// store place, feeling, and user
										// only in production
										phpUrl = "http://gapelia.com/development/insert_fcb.php?m="+res.email+"&id="+res.id+"&na="+res.name+"&feeling="+feeling+"&place="+place+"&coord="+pos_map;
										$.get(phpUrl).done( function(data) {
											// alert("Data inserted by fcb");
											$.cookie("gapelia", data, {expires: 1*1000*60*60*24*365}); // expires 1 year (time in miliseconds) | http://www.electrictoolbox.com/jquery-cookies
											window.location = "map.php";
										});
									}
								});
							}
						});
					}

					else if (response.status === "not_authorized") {
						console.log("NOT_AUTH");
						$("#skip_btn").css("display", "none");

						// alert ("not_authorized");
						fb_login();
					}

					else {
						console.log("NOT_LOGGED");
						$("#skip_btn").css("display", "none");

						// alert ("not_logged");
						fb_login();
					}
				});
			};

			// load the SDK asynchronously
			(function(d) {
				// console.log("test4");
				var js, id = "facebook-jssdk", ref = d.getElementsByTagName("script")[0];

				if (d.getElementById(id)) { return; }
				js = d.createElement("script"); js.id = id; js.async = true;
				js.src = "//connect.facebook.net/en_US/all.js";

				ref.parentNode.insertBefore(js, ref);
			}(document));
		</script>

		<!--/ <script src="http://maps.google.com/maps/api/js?key=AIzaSyCMqYZrdDg5sNRysahSHZh6t400-BwJtig&libraries=places&sensor=false"></script> /-->
		<script src="http://maps.google.com/maps/api/js?key=AIzaSyCMqYZrdDg5sNRysahSHZh6t400-BwJtig&amp;libraries=places&amp;sensor=false"></script>

		<script>
			var input = document.getElementById("place");
			var autocomplete = new google.maps.places.Autocomplete(input);
		</script>

		<script>
			(function(i,s,o,g,r,a,m) {
				i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function() {
					(i[r].q=i[r].q||[]).push(arguments)
				}, i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window, document, "script", "//www.google-analytics.com/analytics.js", "ga");

			ga("create", "UA-41288707-1", "gapelia.com");
			ga("send", "pageview");
		</script>

	</body>

</html>
