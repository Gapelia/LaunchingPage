<?php
    require 'config.php';
    require 'gmail_mail.php';
    
    if (!isset($_COOKIE["gapKey"])) {
        header("Location: http://www.gapelia.com/");
    }

    // Get all details from POST data
    $gapKey = $_COOKIE["gapKey"];
    $name = '';
    
    $skip = '';
    if (isset($_POST['skip'])) {
        $skip = $_POST['skip'];
    }
    $place = '';
    $feeling = '';
    $with = '';
    $coord = '';
    $email = '';
    
    if (isset($_POST['skip']) && $skip == "true") {
        $place = $_POST['place'];
        $feeling = $_POST['feeling'];
        $with = $_POST['with'];
        $coord = $_POST['coord'];
        
        // Get DB connection
        $con = mysql_connect ( SERV, USER, WRD ); 
        mysql_select_db ( MOD );
        
        try {
            $sql = "INSERT INTO raw_data2 SET place = '". $place ."', 
                        gap_key = '". $gapKey ."', 
                        coords = '". $coord . "', 
                        feeling = '". $feeling ."', 
                        with_whom = '". $with . "' ";
            $result = mysql_query ( $sql, $con );
            
            $sql="SELECT email, name FROM users2 WHERE gap_key = '" . $gapKey .  "'";
            $result = mysql_query ( $sql, $con );
            $fetch = mysql_fetch_assoc ( $result );
            $email = $fetch ['email'];
        } catch (Exception $e) {
            error_log($e);
        }
        
        // Mail
        $filterWith = filter_var( $with, FILTER_VALIDATE_EMAIL );
        if ($filterWith !== false) {
            mailIt($filterWith, $email, $place, $feeling);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8"/>
		<title>Gapelia</title>

		<link href="http://gapelia.com/css/global.css" rel="stylesheet"/>

		<style>
			html { height: 100%; }

			body {
				margin: 0; padding: 0;

				font-family: "Open Sans", Arial, sans-serif;
				height: 100%;
			}

			a { cursor: pointer; }
			#map_canvas { height: 100%; }

			header {
				width: 100%; height: auto;

				background-color: #326699;
				box-sizing: border-box;
				padding: 1rem;
			}

			#logo, #tagline, #social-links {
				display: inline-block;
				vertical-align: middle;
			}

			#logo {
				width: 100px; height: 100px;

				background-image: url("http://gapelia.com/images/logo.png");
				background-size: 100px 100px;
				color: transparent;
				font-size: 0;
				line-height: 0;
			}

			#tagline, #tagline-ii {
				color: #fefefe;
				font-size: 16px;
			}

			#tagline {
				width: 500px; height: 60px;

				background-image: url("http://gapelia.com/images/gapelia-imminent.png");
				background-size: 500px 60px;
				color: transparent;
				font-size: 0;
				line-height: 0;
				margin: 0 0 0 1rem;
			}

			#tagline-ii {
				float: left;
				margin: 2.5rem 1rem 0 0;
			}

			#tagline-ii, ul { vertical-align: middle; }

			#social-links {
				float: right;
				width: auto;
			}

			#social-links ul {
				margin: 0.7rem 0 0 0; padding: 0;
			}

			#social-links a {
				width: 100%; height: 100%;

				color: transparent;
				display: block;
				font-size: 0;
				line-height: 0;
				text-decoration: none;
			}

			#social-links li {
				width: 50px; height: 50px;

				display: inline-block;
				margin: 0 10px 0 0;
			}

			#social-links li:last-child { margin: 0; }

			#share-email { background-image: url("http://gapelia.com/images/map-email.png"); }
			#share-facebook { background-image: url("http://gapelia.com/images/map-facebook.png"); }
			#share-pinterest { background-image: url("http://gapelia.com/images/map-pinterest.png"); }
			#share-twitter { background-image: url("http://gapelia.com/images/map-twitter.png"); }

			#cta {
				width: 100%; height: auto;

				background-color: #fefefe;
				border-bottom: 1px solid #326699;
				text-align: center;
			}

			#cta p { margin: 0.5rem 0; }

			#map-meta {
				margin: 0 auto; padding: 0.3rem;
				top: 0; right: 0;

				background-color: rgba(25, 25, 25, 0.2);
				box-sizing: border-box;
				color: rgba(254, 254, 254, 0.1);
				font-size: 12px;
				position: absolute;
				text-align: center;
				text-transform: uppercase;
				width: auto;
			}

			#map-meta span {
				margin: 0 0.3rem 0 -0.5rem; padding: 0.3rem;

				background-color: #326699;
				color: #fefefe;
			}

			#map-meta a {
				color: #fefefe;
				cursor: pointer;
				text-decoration: none;
			}

			#map_canvas img { max-width: none; }
		</style>

	</head>

	<body>

		<header>
			<h1 id="logo">Gapelia</h1>
			<p id="tagline">Gapelia | Coming Soon</p>

			<div id="social-links">
				<ul>
					<li id="share-email"><a href="mailto:?subject=Have a look at this!&amp;body=Gapelia helps you teleport and discover dreams! http://gapelia.com" target="_blank">Email</a></li>
					<li id="share-facebook"><a href="https://www.facebook.com/dialog/feed?app_id=578454235517060&amp;link=http://gapelia.com&amp;picture=http://gapelia.com/images/FB.jpg&amp;name=Gapelia | Discover teleportation&amp;description=Discover your dreams and teleport to them, instantly!*&amp;redirect_uri=http://gapelia.com" target="_blank">Facebook</a></li>
					<li id="share-twitter"><a href="https://twitter.com/share?original_referer=http://gapelia.com;source=tweetbutton&amp;text=is uncovering their dreams at http://gapelia.com (via @gapelia)." target="_blank">Twitter</a></li>
				</ul>
			</div>

			<div id="map-meta">
				<span>Share how the world thinks</span> <a id="logoff" href="/" onclick="logoff()">Logoff</a> | <a href="/">BACK</a>
			</div>
		</header>

		<div id="cta">
			<p>The Map of Feelings</p>
		</div>

		<div id="map_canvas" style="width: 100%; height: 100%;"></div>

		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="http://gapelia.com/scripts/cookie.js"></script>
		<script src="http://maps.google.com/maps/api/js?key=AIzaSyCMqYZrdDg5sNRysahSHZh6t400-BwJtig&libraries=places&sensor=false"></script>
		<script src="http://platform.tumblr.com/v1/share.js"></script>

		<script>
			function logoff() { $.removeCookie("gapKey"); }
			$(document).ready(function() { initialize(); });
		</script>

		<script>
			function initialize() {
				google.maps.visualRefresh = true;
				var mapOptions = {
					// center: new google.maps.LatLng(40.420088, -3.688),
					center: new google.maps.LatLng(31.633333, -9.600000),
					zoom: 3,
					mapTypeControl: true,
					// draggable: false,
					scaleControl: true,
					scrollwheel: true,
					navigationControl: false,
					streetViewControl: false,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};

				var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

				var styledMapOptions = {
					map: map,
					name: "gapelia_style"
				}

				var stylez = [{
					"featureType": "administrative",
					"stylers": [{
						"visibility": "off"
					}]
				}, {
					"featureType": "landscape",
					"stylers": [{
						"visibility": "off"
					}]
				}, {
					"featureType": "poi",
					"stylers": [{
						"visibility": "off"
					}]
				}, {
					"featureType": "road",
					"stylers": [{
						"visibility": "off"
					}]
				}, {
					"featureType": "transit",
					"stylers": [{
						"visibility": "off"
					}]
				}, {
					"featureType": "water",
					"elementType": "labels",
					"stylers": [{
						"visibility": "off"
					}]
				}, {
					"featureType": "water",
					"elementType": "geometry",
					"stylers": [{
						"lightness": 100
					}, {
						"visibility": "on"
					}, {
						"color": "#b2d5fe"
					}]
				}, {
					"featureType": "landscape",
					"elementType": "geometry.fill",
					"stylers": [{
						"visibility": "on"
					}, {
						"color": "#326699"
					}, {
						"lightness": 0
					}]
				}];
				var styled_map = new google.maps.StyledMapType(stylez, styledMapOptions);

				map.mapTypes.set('styled_map', styled_map);
				map.setMapTypeId('styled_map');
				phpUrl = "http://gapelia.com/places/";


				$.getJSON(phpUrl, function (data) {
					var markers = [];
					var infowindows = [];
					var position_place = [];
					var position_feeling = [];
					for (var i = 0; i < data.length; ++i) {
						hasPlace = false;
						position_feeling[i] = '';
						$.each(data[i], function (key, value) {
							if (key == "place") {
								if (value !== undefined && value !== "") {
									hasPlace = true;
									var value_dec = decodeURIComponent(value);
									var lines = value_dec.split(',');
									lat = lines[0].substring(1);
									lon = lines[1].replace(")", " ");

									var address = new google.maps.LatLng(lat, lon);
									position_place[i] = address;
								}
							} else {
								if (value !== undefined && value !== "") {
									position_feeling[i] = value + '<br>' + position_feeling[i];
								}
							}
						});

						if (hasPlace) {

							//var iconBase = "https://maps.google.com/mapfiles/kml/shapes/";
							var iconBase = "http://gapelia.com/images/";

							markers[i] = new google.maps.Marker({
								map: map,
								position: position_place[i],
								title: "Be Curious",
								icon: iconBase + "marker.png",
								clickable: true
							});

							infowindows[i] = new google.maps.InfoWindow({
								content: "Feelings here: " + position_feeling[i]
							});
							google.maps.event.addListener(markers[i], 'click', function (i) {
								return function () {
									infowindows[i].open(map, markers[i]);
								}
							}(i));
						}
					}
				});
			}
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
