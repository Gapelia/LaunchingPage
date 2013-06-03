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
				height: 100%;
			}

			#map_canvas { height: 100%; }
		</style>

	</head>

	<body>

		<button id="logoff" onclick="logoff()" >Logoff</button>
		<a href="index.php">BACK</a>

		<br/>
		<br/>

		<div id="map_canvas" style="width: 100%; height: 90%;"></div>

		<br/>

		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

		<script src="scripts/cookie.js"></script>
		<script src="http://maps.google.com/maps/api/js?key=AIzaSyCMqYZrdDg5sNRysahSHZh6t400-BwJtig&libraries=places&sensor=false"></script>

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

						alert('cookie Identification Error, please login again');
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

						alert('SESSION Identification Error, please login again');
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

				var mapOptions = {
					center: new google.maps.LatLng(40.420088, -3.688),
					zoom: 2,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};

				var map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);

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

						var marker = new google.maps.Marker({
							position: position_place,
							map: map,
							title: 'Be Curious'
						});

						google.maps.event.addListener(marker, 'click', function() {
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