<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Gapelia</title>
	</head>

	<body>
	<link href="css/global.css" rel="stylesheet" type="text/css" /> 
	<link rel="stylesheet" href="css/styles.css">
	<script>
	var feeling ='';
	var place = '';
	var res;
	var id='';
	var con = 0;
	</script>
	
	
		<div id="wrapper">
			<div id="mask">

				<div id="item1" class="item">
					<div class="content">

						<div id="page-01-text"></div>
						<a id="page-01-button" class="panel" href="#item2"></a>

						<a class="logo" href=""></a>

					</div>
				</div>

				<div id="item2" class="item">
					<div class="content">

						<div id="page-02-text-01"></div>
						<a href="#item1">BACK</a>
						<form>
							<input id="place" placeholder="ANYWHERE IN THE WORLD..." type="text" /><br/>
							<input id="feeling" placeholder="FEELING ANY EMOTION..." type="text" />
							
						</form>

						<div id="page-02-text-02"></div>
						<a id="new_btn" class="submit panel" href="#item3"></a>
<!--						<a href="#" id="button">Click me</a>-->
						<a id="skip_btn" class="skip" href="">SKIP</a>
						
						<a class="logo" href=""></a>
						
						<div id="modal">
							<div id="heading">
								new Gapelian?
							</div>
						
							<div id="content">
													
								<a id="YES" href="#" class="button green close"><img src="images/tick.png">I am a new Gapelian</a>
						
								<a id="NO" href="#" class="button red close"><img src="images/cross.png">I am a returning Gapelian</a>
							</div>
						</div>

					</div>
				</div>

				<div id="item3" class="item">
					<div class="content">

						<div id="page-03-text"></div>
						<a href="#item2">BACK</a>
						<form>
							<div class="left">
								<span id="img-name"></span>
									<input id="input-email"  type="email" name="email" placeholder="NEW EMAIL" required><br/>
								
								<span id="img-email"></span>
									<input id="input-passwd" placeholder="NEW PASSWORD" type="password" required/>
									<a id="mail" class="submit login" href=""></a>
							</div>

							<div class="right">

<!--			<input placeholder="LOGIN WITH FACEBOOK" type="text"/>-->
			<a id="fcb" class="login" href=""><span id="img-fb"></span></a><br/>
<!--			<input placeholder="LOGIN WITH TWITTER" type="text"/>-->
			<a id="twt" class="login" href=""><span id="img-tw"></span></a>
							</div>
						</form>

<!--						<a class="submit panel" href="#item4"></a>-->

						<a class="logo" href=""></a>

					</div>
				</div>

				<div id="item3b" class="item">
					<div class="content">
						
						<div id="page-03-textb"></div>
						<a href="#item2">BACK</a>
						<form>
							<div class="left">
								<span id="img-nameb"></span>
									<input id="input-emailb" placeholder="OLD EMAIL" type="email" required/><br/>
								<span id="img-emailb"></span>
									<input id="input-passwdb" placeholder="OLD PASSWORD" type="password" required/>
							</div>

							<div class="right">
<!--								<input placeholder="LOGIN WITH FACEBOOK" type="text"/>-->
								<a id="fcb" class="login" href=""><span id="img-fb"></span></a><br/>
<!--								<input placeholder="LOGIN WITH TWITTER" type="text"/>-->
								<a id="twt" class="login" href=""><span id="img-tw"></a></span>
							</div>
						</form>

						<a id="mailb" class="submit login" href=""></a>

						<a class="logo" href=""></a>

					</div>
				</div>


			</div>
		</div>




		<script src="http://code.jquery.com/jquery-1.8.1.min.js"></script>
		<script src="http://www.itsyndicate.ca/gssi/jquery/jquery.crypt.js"></script>
		<script src="scripts/jquery.scrollTo.js"></script>
		<script src="scripts/md5.js"></script>
		<script src="scripts/cookie.js"></script>
		<script src="scripts/functions.js"></script>
		<script src="scripts/jquery.reveal.js"></script>
		<script>

				function logoff(){
					$.removeCookie("gapelia");
					/*   LOG OFF  */   
					phpUrl = "http://gapelia.com/development/logoff.php"; 
					$.get(phpUrl);

				}

				
				
				$(document).ready(function() {


					$("#YES").click(function() {
						$("#wrapper").scrollTo("#item3", 200); // TO CREATE ACCOUNT
						
					});
					
					$("#NO").click(function() {
						$("#wrapper").scrollTo("#item3b", 200);  // TO LOG BY MAIL
					});
					
					$("a.panel").click(function() {

						$("a.panel").removeClass("selected");
						$(this).addClass("selected");

						current = $(this);

						if (current.attr("href") == "#item2" ) {

							$("#wrapper").scrollTo("#item2", 200);
							if ($.cookie("gapelia")!= null) { // IF CONNECTED OR COOKIE EXISTS SHOW SKIP PROCESS

								$("#skip_btn").css("display", "block");
							}

							return false;
							
						} else 	if (current.attr("href") == "#item3" ) {  // IF USER IS NEW, CREATE ACCOUNT

							// USER PRESS SUBMIT AFTER FILL IN PLACE AND FEELING

							/* GET PLACE AND FEELING*/
							place= $("#place").val();
							feeling = $("#feeling").val();

							/*   CHECK NOT EMPTY    */
							if  (place == '' || feeling==''){
								//	alert ("Missing data");  	// ONLY IN PRODUCTION

									$("#place").attr("placeholder", "ANYWHERE IN THE WORLD...").blur();
									$("#place").addClass('placehold');

									$("#feeling").attr("placeholder", "FEELING ANY EMOTION...").blur();
									$("#feeling").addClass('placehold');

								
									return false;                             // ONLY IN PRODUCTION
							} else {

								geocoder = new google.maps.Geocoder();

								  geocoder.geocode( { 'address': place}, function(results, status) {
								 		if (status == google.maps.GeocoderStatus.OK) {

								 			/* IF PLACE IS CORRECT */

								 			/*     TRY TO IDENTIFY      */
											var cook = $.cookie("gapelia");

											if (cook != '' && cook != null){ // COOKIE NOT EMPTY

												

												/*   GET USER ID  */   
												phpUrl = "http://gapelia.com/development/loginID.php?cookie="+$.cookie("gapelia");  // ONLY IN PRODUCTION

												$.get(phpUrl)
												.done(function(data) { 
													if (data== 0) {
														alert('Identification Error, please login again');
														logoff();
														return false;
													} else {
														id = data;
														/* STORE PLACE AND FEELING WITH USER*/
														position_place = results[0].geometry.location;
														pos_map = encodeURI(position_place);

														
														phpUrl = "http://gapelia.com/development/insert.php?feeling="+feeling+"&place="+place+"&id="+id+"&coord="+pos_map;  // ONLY IN PRODUCTION
														$.get(phpUrl)
														.done(function(data){
															window.location = 'map.php'; // GO TO MAP
														});
														
													}
													
												});


											} else { // COOKIE  EMPTY

												position_place = results[0].geometry.location;
												pos_map = encodeURI(position_place);

												/* ALWAYS STORE PLACE AND FEELING*/
												phpUrl = "http://gapelia.com/development/insert.php?feeling="+feeling+"&place="+place+"&id="+id+"&coord="+pos_map;  // ONLY IN PRODUCTION
												$.get(phpUrl);


												/*   FIRST TIME? OPEN DIALOG */ 


												$('#modal').reveal({ // The item which will be opened with reveal
												  	animation: 'fade',                   // fade, fadeAndPop, none
													animationspeed: 600,                       // how fast animtions are
													closeonbackgroundclick: true,              // if you click background will modal close?
													dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
												});							

											}
										} else {
											//alert('Place not found: ' + status);
											$("#place").val('');
											
												$("#place").attr("placeholder", "Place not found").blur();
												$("#place").addClass('placehold');
										
											
									     	
									     	return false;
									    }
								  });
							}
						} else if (current.attr("href") == "#item3b"){  // IF USER IS NOT NEW, HAS ACCOUNT



						} else {
						
								$("#wrapper").scrollTo($(this).attr("href"), 200);

								return false;
						}

						return false;
						
					});

					$(window).resize(function() {
						resizePanel();
					});


					$("a.login").click(function() {

						if ($(this).attr("id")=="fcb"){

							fb_login();
										               
						} else if ($(this).attr("id")=="twt"){

							// GET THE AUTH URL
							
							geocoder = new google.maps.Geocoder();

								  geocoder.geocode( { 'address': place}, function(results, status) {
								 		if (status == google.maps.GeocoderStatus.OK) {
							
										phpUrl = "http://gapelia.com/twitter/redirect.php?feeling="+feeling+"&place="+place;  
										$.get(phpUrl)
										.done(function(data) { 
											if (data == '0'){
													alert('Could not connect to Twitter. Refresh the page or try again later.');
											} else {
												window.location = data;
											}
											
											});
								 		}
								  });
						} else if ($(this).attr("id")=="mail"){
							loginmail();
						} else if ($(this).attr("id")=="mailb"){
							checkmail();
						}
							
						return false;

					});

					$("a.skip").click(function() {
						window.location = 'map.php'; 	
						return false;

					});

				return false;
					
				});
</script>
		
		
		<script>


		function fb_login(){

			FB.login(function(response) {

	              if (response.session) {
                    if (response.perms) {
                    	console.log('perms');
	                    }
					if (response.scope) {
						console.log('scope');
                    } else {
                      // user is logged in, but did not grant any permissions
                      alert("No Permission..");

                    }
                  } else {
                    // user is not logged in
                    console.log(response);
                	
					 }
	              }, {scope:'email'}
               );



			}

		
			  window.fbAsyncInit = function() {
				  FB.init({
				    appId      : '578454235517060', // App ID
				    status     : true, // check login status
				    cookie     : true, // enable cookies to allow the server to access the session
				    oauth      : true,
				    xfbml      : true  // parse XFBML
				  });
			  
				  FB.Event.subscribe('auth.authResponseChange', function(response) {
				    if (response.status === 'connected') {
						 // CONNECTED
						 con=1;
					      // GET DATA 
					      FB.api('/me', function(response) {
					        res = response;
	
					        if  (place  != '' && feeling !=''){ 

					        	geocoder = new google.maps.Geocoder();

								  geocoder.geocode( { 'address': place}, function(results, status) {
								 		if (status == google.maps.GeocoderStatus.OK) {
								 			position_place = results[0].geometry.location;
											pos_map = encodeURI(position_place);

						        
											  /* STORE PLACE, FEELING AND FCB USER*/
												phpUrl = "http://gapelia.com/development/insert_fcb.php?m="+res.email+"&id="+res.id+"&na="+res.name+"&feeling="+feeling+"&place="+place+"&coord="+pos_map;  // ONLY IN PRODUCTION
												$.get(phpUrl)
												.done( function(data) { 

														$.cookie("gapelia", data, { expires: 1*1000*60*60*24*365 } );   // expires 1 year - time in miliseconds - http://www.electrictoolbox.com/jquery-cookies/
														window.location = 'map.php';
												});
								 		} 
					        		});
					        	}
					      });
				    } else if (response.status === 'not_authorized') {
				
					      console.log('NOT_AUTH');
					      $("#skip_btn").css("display", "none");
					      fb_login();
				    } else {
				
					      console.log('NOT_LOGGED');
					      $("#skip_btn").css("display", "none");
							  fb_login();
				    }
				  });
			  };
			
			  // Load the SDK asynchronously
			  (function(d){
				  //console.log('test4');
			   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
			   if (d.getElementById(id)) {return;}
			   js = d.createElement('script'); js.id = id; js.async = true;
			   js.src = "//connect.facebook.net/en_US/all.js";
			   ref.parentNode.insertBefore(js, ref);
			  }(document));


</script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCMqYZrdDg5sNRysahSHZh6t400-BwJtig&libraries=places&sensor=false"></script>
<script>
	var input = document.getElementById('place');
	var autocomplete = new google.maps.places.Autocomplete(input);

</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-41288707-1', 'gapelia.com');
  ga('send', 'pageview');

</script>		
	</body>

</html>
