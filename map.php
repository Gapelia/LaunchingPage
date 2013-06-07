<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8"/>
		<title>Gapelia</title>

		<link href="css/global.css" rel="stylesheet"/>

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

				background-image: url("images/logo.png");
				background-size: 100px 100px;
				color: transparent;
				font-size: 0;
				line-height: 0;
			}

			#tagline, #tagline-ii {
				color: #fefefe;
				font-size: 16px;
			}

			#tagline { margin: 0 0 0 1rem; }

			#tagline-ii {
				float: left;
				margin: 2.5rem 1rem 0 0;
			}

			#tagline-ii, ul {
				vertical-align: middle;
			}

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

			#share-email { background-image: url("images/map-email.png"); }
			#share-facebook { background-image: url("images/map-facebook.png"); }
			#share-pinterest { background-image: url("images/map-pinterest.png"); }
			#share-twitter { background-image: url("images/map-twitter.png"); }

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
		</style>

	</head>

	<body>

		<!--/
		<div id="fb-root"></div>

		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;

				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=578454235517060";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, "script", "facebook-jssdk"));
		</script>

		<div class="fb-like" data-href="https://www.facebook.com/pages/Gapelia/461725877232129" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false"></div>
		/-->

		<header>
			<h1 id="logo">Gapelia</h1>
			<p id="tagline">Gapelia | Coming Soon</p>

			<div id="social-links">
				<!--/ <p id="tagline-ii">Share how the world thinks</p> /-->

				<ul>
					<li id="share-email"><a href="mailto:?subject=Have a look at this!&amp;body=Gapelia helps you teleport and discover dreams! http://gapelia.com" target="_blank">Email</a></li>

					<li id="share-facebook"><a href="https://www.facebook.com/dialog/feed?app_id=578454235517060&amp;link=http://gapelia.com&amp;picture=http://gapelia.com/images/FB.jpg&amp;name=Gapelia | Discover teleportation&amp;description=Discover your dreams and teleport to them, instantly!*&amp;redirect_uri=http://gapelia.com" target="_blank">Facebook</a></li>

					<!--/
					<li id="share-pinterest"><a "http://www.tumblr.com/share/photo?source=http%3A%2F%2Ffarm6.static.flickr.com%2F5030%2F5601726196_08725e1979_z.jpg&caption=%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20This%20example%20uses%20the%20basic%20Tumblr%20Button%20in%20the%20article's%20footer%20to%20let%20Tumblr%20users%20easily%20promote%20this%20article%20on%20their%20blogs.%0A%20%20%20%20%20%20%20%20%20%20%20%20&click_thru=http%3A%2F%2Fwww.flickr.com%2Fphotos%2Fjfisher%2F5601726196" title="Share on Tumblr" target="_blank">Pinterest</a></li>
					/-->

					<li id="share-twitter"><a href="https://twitter.com/share?original_referer=http://gapelia.com;source=tweetbutton&amp;text=is uncovering their dreams at http://gapelia.com (via @gapelia)." target="_blank">Twitter</a></li>

					<!--/ <a href="https://m.google.com/app/plus/x/?v=compose&amp;content=I just love the spaced-out electronica grooves that FRSH%2BBTS (http://twitter.com/FRSHBTS) comes up with! Check it: the_permalink()" target="_blank">Google+</a> /-->
				</ul>
			</div>

			<div id="map-meta">
				<span>Share how the world thinks</span> <a id="logoff" href="index.php" onclick="logoff()">Logoff</a> | <a href="index.php">BACK</a>
				<!--/ <a id="logoff" onclick="logoff()">Logoff</a> | <a href="index.php">BACK</a> /-->
			</div>

		</header>

		<div id="cta">
			<p>The Map of Feelings</p>
		</div>

		<div id="map_canvas" style="width: 100%; height: 100%;"></div>

		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

		<script src="scripts/cookie.js"></script>
		<script src="http://maps.google.com/maps/api/js?key=AIzaSyCMqYZrdDg5sNRysahSHZh6t400-BwJtig&libraries=places&sensor=false"></script>

		<script>
			var tumblr_photo_source = document.getElementById("source").src;
			var tumblr_photo_caption = document.getElementById("caption").innerHTML;
			var tumblr_photo_click_thru = document.getElementById("click_thru").href;

			var tumblr_button = document.createElement("a");
			tumblr_button.setAttribute("href", "http://www.tumblr.com/share/photo?source=" + encodeURIComponent(tumblr_photo_source) + "&caption=" + encodeURIComponent(tumblr_photo_caption) + "&click_thru=" + encodeURIComponent(tumblr_photo_click_thru));
			tumblr_button.setAttribute("title", "Share on Tumblr");
			tumblr_button.setAttribute("style", "display:inline-block; text-indent:-9999px; overflow:hidden; width:129px; height:20px; background:url('http://platform.tumblr.com/v1/share_3.png') top left no-repeat transparent;");
			tumblr_button.innerHTML = "Share on Tumblr";
			document.getElementById("footer").appendChild(tumblr_button);
		</script>

		<script src="http://platform.tumblr.com/v1/share.js"></script>

		<script>
			function logoff() {
				$.removeCookie("gapelia");

				// log off server session
				phpUrl = "http://gapelia.com/development/logoff.php";
				$.get(phpUrl);
			}

			$(document).ready(function() {
				var cook = $.cookie("gapelia");

				// if there is a cookie from email or Facebook
				if (cook != '' && cook != null) {
					// get user ID
					phpUrl = "http://gapelia.com/development/loginID.php?cookie="+$.cookie("gapelia"); 

					$.get(phpUrl).done(function(data) {
						if (data== 0) {
							// alert($.cookie("gapelia"));

							alert("Please login again");
							logoff();

							// window.location = 'index.php';
						}

						initialize();
					});
				}

				// no cookie
				else {
					// get session GAP key from TWT
					phpUrl = "http://gapelia.com/development/gap_key.php";  

					$.get(phpUrl).done(function(data) {
						if (data== 0) {
							// alert("cookie"+data);

							alert("Please login again");
							logoff();

							// window.location = 'index.php';
						}

						else {
							$.cookie("gapelia", data, { expires: 1*1000*60*60*24*365 } );
							initialize();
						}
					});
				}
			});
		</script>

		<script>
			function initialize() {
				google.maps.visualRefresh = true;

				/*
				var iconBase = "https://maps.google.com/mapfiles/kml/shapes/";

				var marker = new google.maps.Marker({
					position: myLatLng,
					map: map,
					icon: iconBase + "schools_maps.png",
					shadow: iconBase + "schools_maps.shadow.png"
				});
				*/

				var stylez = [ { "featureType": "administrative", "stylers": [ { "visibility": "off" } ] },{ "featureType": "landscape", "stylers": [ { "visibility": "off" } ] },{ "featureType": "poi", "stylers": [ { "visibility": "off" } ] },{ "featureType": "road", "stylers": [ { "visibility": "off" } ] },{ "featureType": "transit", "stylers": [ { "visibility": "off" } ] },{ "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ] },{ "featureType": "water", "elementType": "geometry", "stylers": [ { "lightness": 100 }, { "visibility": "on" }, { "color": "#b2d5fe" } ] },{ "featureType": "landscape", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#326699" }, { "lightness": 0 } ] } ];

				var mapOptions = {
					// center: new google.maps.LatLng(40.420088, -3.688),
					center: new google.maps.LatLng(31.633333, -9.600000),
					zoom: 3,
					mapTypeControl: false,
					// draggable: false,
					scaleControl: false,
					scrollwheel: false,
					navigationControl: false,
					streetViewControl: false,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};

				var map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);

				var styledMapOptions = {
					map: map,
					name: "tips4phpHip-Hop"
				}

				var testmap =  new google.maps.StyledMapType(stylez,styledMapOptions);

				map.mapTypes.set('tips4php', testmap);
				map.setMapTypeId('tips4php');

				// google.maps.event.addDomListener(window, 'load', initialize);
				// get all places

				phpUrl = "http://gapelia.com/development/places.php";

				$.getJSON(phpUrl, function(data) {
					var items = [];
					var geocoder;

					$.each(data, function(key, val) {
						pos = decodeURI(val.place);

						var lines = pos.split(',');
						lat = lines[0].substring(1);
						lon = lines[1].replace(")", " ");

						var address = new google.maps.LatLng(lat,lon);
						position_place = address;
						position_feeling ='';

						$.each(val,function(key2, val2) {
							if (key2!='place') {
								position_feeling =  val2 + '<br>' + position_feeling ;
							}
						});

						var infowindow = new google.maps.InfoWindow({
							content: position_feeling
						});

						// var iconBase = "https://maps.google.com/mapfiles/kml/shapes/";
						var iconBase = "http://gapelia.com/images/";

						var marker = new google.maps.Marker({
							position: position_place,
							map: map,
							title: "Be Curious",
							icon: iconBase + "marker.png",
							shadow: iconBase + ""
							// icon: iconBase + "schools_maps.png",
							// shadow: iconBase + "schools_maps.shadow.png"
						});

						google.maps.event.addListener(marker, "click", function() {
							infowindow.open(map,marker);
						});
					});
				});
			}

			// https://developers.google.com/maps/documentation/javascript/examples/map-coordinates?hl=es
			// http://www.masquewordpress.com/como-usar-google-maps-geocoder-api-v3
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