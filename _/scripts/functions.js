function resizePanel() {
					width = $(window).width();
					height = $(window).height();

					mask_width = width * $(".item").length;

					$("#debug").html(width  + " " + height + " " + mask_width);

					$("#wrapper, .item").css({width: width, height: height});
					$("#mask").css({ width: mask_width, height: height });
					//$("#wrapper").scrollTo($("a.selected").attr("href"), 0);
				}

				/*       CHECK MAIL AND CREATE ACCOUNT          */
				function loginmail(){
					//alert ("LOGIN MAIL");

					var email = $("#input-email").val();
					var passwd = $("#input-passwd").val();

					/*      CHECK NOT EMPTY      */
					if  (email == '' || passwd==''){
						//	alert ("Missing data");  	// ONLY IN PRODUCTION
						//	$("#wrapper").scrollTo("#item2", 200);    // ONLY IN PRODUCTION
						//	return false;                             // ONLY IN PRODUCTION
					} else {

						/*  CHECK EMAIL  */ 
						if( !isValidEmailAddress( email ) ) {
							alert ('Not valid email');
							$("#input-email").focus();
						} else {

							phpUrl = "http://gapelia.com/development/email.php?email="+email+"&passwd="+$.md5(passwd);  // ONLY IN PRODUCTION
							$.get(phpUrl)
							.done( function(data) { 
								if (data== 0) {
									alert('Existing mail');
									$("#wrapper").scrollTo("#item3b", 200);
								} else {
									//alert('Account created');
									$.cookie("gapelia", data, { expires: 1*1000*60*60*24*365 } );   // expires 1 year - time in miliseconds - http://www.electrictoolbox.com/jquery-cookies/

									/*     INSERT IN DB WITH GAP_KEY AND USER      */
									//alert (feeling);
									//alert (place);
									/* STORE PLACE AND FEELING*/
									phpUrl = "http://gapelia.com/development/insertDB.php?feeling="+feeling+"&place="+place+"&key="+data;  // ONLY IN PRODUCTION
									$.get(phpUrl)
									.done(function(data) {
										window.location = 'map.php';
											
									});

									
								}
							});

							
						}
				
						
					}

					
					$("#wrapper").scrollTo("#item3", 200);

					return false;
				}


	
				/*       CHECK MAIL AND CHECK ACCOUNT          */
				function checkmail(){
					//alert ("CHECK MAIL");

					var emailb = $("#input-emailb").val();
					var passwdb = $("#input-passwdb").val();

					/*      CHECK NOT EMPTY      */
					if  (emailb == '' || passwdb ==''){
							alert ("Missing data");  	// ONLY IN PRODUCTION
							$("#input-emailb").focus();
							return false;

					} else {

						/*  CHECK EMAIL  */ 
						if( !isValidEmailAddress( emailb ) ) {
							alert ('Not valid email');
							$("#input-emaibl").focus();
						} else {

							phpUrl = "http://gapelia.com/development/checkemail.php?emailb="+emailb+"&passwdb="+$.md5(passwdb);  // ONLY IN PRODUCTION
							//alert (phpUrl);
							$.get(phpUrl)
							.done( function(data) { 
								if (data== 0) {
									alert('Error mail');
									$("#input-email").focus();
								} else {
									//alert('Access!');
									$.cookie("gapelia", data,{ expires: 1*1000*60*60*24 }  );   // http://www.electrictoolbox.com/jquery-cookies/
									window.location = 'map.php';
								}
							});
						}
					}

					return false;
				}


				
				/* VALIDATE EMAIL */
				function IsEmail(email) {
					  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					  return regex.test(email);
					}

				function isValidEmailAddress(emailAddress) {
				    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
				    return pattern.test(emailAddress);
				};