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
                <link rel="icon" type="image/ico" href="http://www.gapelia.com/images/favicon.ico"/>

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

			/* Google input styling */

			.pac-container {
				margin: 1rem 0 0 0; padding: 1rem 0.8rem;

				background-color: #fefefe;
				border: 0;
				border-radius: 10px;
				box-sizing: border-box;
				font-family: "OpenSansRegular", "Open Sans", Arial, sans-serif;
				font-size: 13px;
			}

			.pac-item { margin: 0 0 0.5rem 0; }
			
			/*********************************/

			#second-page input { width: 40%; }
		</style>

		<script src="http://gapelia.com/scripts/jquery-1.8.1.min.js"></script>
		<script src="http://gapelia.com/scripts/md5.js"></script>
		<script src="http://gapelia.com/scripts/cookie.js"></script>
		<script src="http://gapelia.com/scripts/jquery.reveal.js"></script>
		<script src="http://www.malsup.com/jquery/block/jquery.blockUI.js"></script>

		<script>
			var feeling="";
			var place= "";
			var res;
			var id="";
			var con= 0;
		</script>

	</head>

	<body id="second-page">

		<form method="post" id="teleport-form">
			<div class="content">
				<h1>If you could be...</h1>

				<input id="place" name="place" placeholder="ANYWHERE IN THE WORLD..." type="text"/><br/>
				<input id="feeling" name="feeling" placeholder="FEELING ANY EMOTION..." type="text"/><br/>
				<input id="with" name="with" placeholder="WITH SOMEBODY (insert your friend's email)" type="text"/>
				<input id="coord" name="coord" type="hidden"/>
				<input id="skip" name="skip" type="hidden" value="false"/>

				<h3>What would you choose?</h3>

				<a class="submit panel" href="#" id="submitIt">
<!--                                    <input type="button" hidefocus="true" id="submitIt" value="Submit" style="font-size: 1.3em;" />-->
                                    <h2 style="color:#FFF;margin-top:-50px;">GO</h2>
                                </a>

				<div id="logo-wrapper">
					<a id="logo" href=""></a><p class="logo-tagline">Be curious</p>
				</div>
			</div>

			<div id="social-banner">
				<a href="https://www.facebook.com/pages/Gapelia/461725877232129?id=461725877232129&amp;sk=app_190322544333196" target="_blank">Facebook</a> &middot;
				<a href="http://gapelia.tumblr.com" target="_blank">Tumblr</a>
			</div>

			<div id="modal">
				<div class="container">
					<a id="YES" href="#">I want to be a Gapelian</a><br/>
					<a id="NO" href="#">Skip to Gapelian Map</a><br/>
				</div>
			</div>
		</form>

		<script>
                    function IsEmail(email) {
                            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                            return regex.test(email);
                        }
                        
                    $(document).ready(function () {  
                        // Set display values based on if already logged in
                        if ($.cookie('gapKey') == null) {
                            $("#YES").html("Login or Register and be a Gapelian");
                            $("#NO").css("display", "none");
                            $("#teleport-form").attr("action", "/gapelian/new/");
                        } else {
                            $("#YES").html("Login or Register with a different Id");
                            $("#NO").css("display", "inline-block");
                            $("#teleport-form").attr("action", "/gapelian/new/");
                        }
                        
                        // Change skip based on what is clicked
                        $("#YES").click(function () {
                            // This is not duplicate, follow logic
                            $("#teleport-form").attr("action", "/gapelian/new/");
                            $("#skip").val("false");
                            $("#teleport-form").submit();
                        });
                        $("#NO").click(function () {
                            $("#teleport-form").attr("action", "/gapelian/map/");
                            $("#skip").val("true");
                            $("#teleport-form").submit();
                        });
                        
                        $("#submitIt").click(function () {
                            place = ($("#place").val());
                            feeling = encodeURIComponent($("#feeling").val());
                            withwhom = $("#with").val();
                            if (place == "") {
                                alert("Please enter a valid place");
                                return false;
                            } 
                            if (feeling == "") {
                                alert("Please enter a valid feeling");
                                return false;
                            }
                            if (!IsEmail(withwhom)) {
                                $("#with").val("");
                            }
                            var submitIt = true;
                            geocoder = new google.maps.Geocoder();
                            geocoder.geocode({ "address": place }, 
                                function (results, status) {
                                    if (status == google.maps.GeocoderStatus.OK) {
                                        position_place = results[0].geometry.location;
                                        pos_map = encodeURIComponent(position_place);
                                        $("#coord").val(pos_map);
                                        $("#modal").reveal({
                                            animation: "fade",
                                            animationspeed: 600,
                                            closeonbackgroundclick: true,
                                            dismissmodalclass: "close"
                                        });
                                    } else {
                                        alert("Please enter a valid place");
                                        submitIt = false;
                                    }
                                });
                            return false;
                        });
                    });
		</script>

		<script src="http://maps.google.com/maps/api/js?key=AIzaSyCMqYZrdDg5sNRysahSHZh6t400-BwJtig&amp;libraries=places&amp;sensor=false"></script>

		<script>
			var input = document.getElementById("place");
			var autocomplete = new google.maps.places.Autocomplete(input);
		</script>

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
