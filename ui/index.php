<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
	<head>

	<link rel="shortcut icon" href="favicon.ico"> </link>
	
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        
    <link rel="stylesheet" href="css/homepage.css" type="text/css" charset="utf-8"/>
		
	<title>Apex - The Route to ROOT</title>

		<script src="./lib/jquery.js"></script>
		
		<script src="./lib/lightbox.js"></script>
		
		<script src="./lib/jquery.cookies.2.2.0.js"></script>
	
		<script src="./lib/cufon-yui.js" type="text/javascript"></script>
	
		<script src="./resource/BabelSans_500.font.js" type="text/javascript"></script>
	
		<script src="./lib/jquery.easing.1.3.js" type="text/javascript"></script>
	
		<script type="text/javascript">
	
			$(function() {


if(navigator.appName == 'Microsoft Internet Explorer')
{
alert('This website supports only Mozilla Firefox and Google Chrome.');
exit();
}	

		Cufon.replace('a, span').CSS.ready(function() {
					var $menu 		= $("#slidingMenu");
					
					/**
					* the first item in the menu, 
					* which is selected by default
					*/
					var $selected	= $menu.find('li:first');
					
					/**
					* this is the absolute element,
					* that is going to move across the menu items
					* which is selected by default
					*/
					var $selected	= $menu.find('li:first');
					
					/**
					* this is the absolute element,
					* that is going to move across the menu items
					* it has the width of the selected item
					* and the top is the distance from the item to the top
					*/
					var $moving		= $('<li />',{
						className	: 'move',
						top			: $selected[0].offsetTop + 'px',
						width		: $selected[0].offsetWidth + 'px'
					});
					
					/**
					* each sliding div (descriptions) will have the same top
					* as the corresponding item in the menu
					*/
					$('#slidingMenuDesc > div').each(function(i){
						var $this = $(this);
						$this.css('top',$menu.find('li:nth-child('+parseInt(i+2)+')')[0].offsetTop + 'px');
					});
					
					/**
					* append the absolute div to the menu;
					* when we mouse out from the menu 
					* the absolute div moves to the top (like innitially);
					* when hovering the items of the menu, we move it to its position 
					*/
					$menu.bind('mouseleave',function(){
							moveTo($selected,400);
						  })
						 .append($moving)
						 .find('li')
						 .not('.move')
						 .bind('mouseenter',function(){
							var $this = $(this);
							var offsetLeft = $this.offset().left - 20;
							//slide in the description
							$('#slidingMenuDesc > div:nth-child('+ parseInt($this.index()) +')').stop(true).animate({'width':offsetLeft+'px'},400, 'easeOutExpo');
							//move the absolute div to this item
							moveTo($this,400);
						  })
						  .bind('mouseleave',function(){
							var $this = $(this);
							var offsetLeft = $this.offset().left - 20;
							//slide out the description
							$('#slidingMenuDesc > div:nth-child('+ parseInt($this.index()) +')').stop(true).animate({'width':'0px'},400, 'easeOutExpo');
						  });;
					
					/**
					* moves the absolute div, 
					* with a certain speed, 
					* to the position of $elem
					*/
					function moveTo($elem,speed){
						$moving.stop(true).animate({
							top		: $elem[0].offsetTop + 'px',
							width	: $elem[0].offsetWidth + 'px'
						}, speed, 'easeOutExpo');
					}
				}) ;

			});
	
		</script>
		

<link rel="stylesheet" href="./css/lightbox.css" type="text/css" media="screen" title="no title" charset="utf-8">


<script type="text/javascript" charset="utf-8">

//////////////////////////////////////////////////////////////////////////////
/////////////   LOGIN FORM

    
$(function() {
            
            
$('#signin').click(function(e)
{
        $("#sign_up").lightbox_me({centered: true, onLoad: function() {
				

if((navigator.userAgent).search("Chrome")==-1)
{
	$("#name").focus();
}

				if($.cookies.get("remember") == "remember")
				{
						
						document.getElementById('name').value = $.cookies.get("username");
						document.getElementById("password").focus();
						
				}
	


}
});
				
e.preventDefault();
		
}); //end of .click







$('#joiningrequest').click(function(e)
{

$('#sign_up').trigger('close'); 

       $("#joiningdiv").lightbox_me({centered: true, onLoad: function() {
				

if((navigator.userAgent).search("Chrome")==-1)
{
	$("#newname").focus();
}
		
}

});
				
e.preventDefault();
		
}); //end of .click












            


$('#name').keypress(function(e) {
	
	var e=window.event || e ;

	if(e.keyCode == '13')
	{
	$("#password").focus();
	}

	});
            
            

            
$('#password').keypress(function(e) {
	
	var e=window.event || e ;

	if(e.keyCode == '13')
	{
	

$("#submitbutton").click();	

}

	});
            
          
}); //end of document on ready binding
            

/////////////////////////////////////////////////////////////////////////////////////		
            


function altInvisibleRememberBoxValue()
{

var val = document.getElementById('invisibleRememberBox').value;

if( val.toString() == "remember")
{
document.getElementById('invisibleRememberBox').value = "not";
}
else
{
document.getElementById('invisibleRememberBox').value = "remember";
}

}

</script>

		
	
<script language="javascript" type="text/javascript">
 
var ajaxRequest;

function ajaxFunction(){
	  
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		
				alert("Your browser broke!");
				return false;
			}
		
	
}

ajaxFunction();


ajaxRequest.onreadystatechange=function(){
 if (ajaxRequest.readyState==4){
  if (ajaxRequest.status==200){
   document.getElementById("result").innerHTML=ajaxRequest.responseText;
  $('#result').css('display','inline-block');	
  $('#throbber').hide();
  $('#submitbutton').show();
  
  if(document.getElementById("result").innerHTML == 'AcceptedAdmin')
  {
	  
	  window.location = "admin.php";
  }
  
  
  if(document.getElementById("result").innerHTML == 'Accepted.')
  {
	  window.location = "./generic_page/page.php";
  }
  
  
  if(document.getElementById("result").innerHTML == 'Username and Password didn\'t match !')
  {
	  failed_retry();
  }
  
  if(document.getElementById("result").innerHTML == 'Invalid Username !')
  {
	  failed_retry();
  }

if(document.getElementById("result").innerHTML == 'Locked !')
{
alert("Account Locked. Contact your SysAdmin ! ");
}

}
  else{
   alert("An error has occured while making the request");
  }
 }
}


function makeRequest()
{

$('#submitbutton').hide();
$('#throbber').show();


var namevalue=encodeURIComponent(document.getElementById("name").value);
var passvalue=encodeURIComponent(document.getElementById("password").value);
var remembervalue = encodeURIComponent(document.getElementById("invisibleRememberBox").value);
var attempts = encodeURIComponent(document.getElementById("invisibleAttempts").value);

passvalue = SHA1(passvalue);

var parameters="name="+namevalue+"&password="+passvalue+"&remember="+remembervalue+"&attempts="+attempts;

ajaxRequest.open("POST", "authenticator.php", true);
ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
ajaxRequest.send(parameters);

}




function makeRequest2()
{

$('#newsubmitbutton').hide();
$('#newthrobber').show();


var namevalue=encodeURIComponent(document.getElementById("newname").value);
var passvalue=encodeURIComponent(document.getElementById("newpassword").value);
var emailvalue = encodeURIComponent(document.getElementById("newemail").value);
var phonevalue = encodeURIComponent(document.getElementById("newphone").value);

var parameters="name="+namevalue+"&password="+passvalue+"&newemail="+emailvalue+"&newphone="+phonevalue;

ajaxRequest2.open("POST", "joiningrequestupdater.php", true);
ajaxRequest2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
ajaxRequest2.send(parameters);

}






var ajaxRequest2;

function ajaxFunction2(){

	  
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest2 = new XMLHttpRequest();
	} catch (e){
		
				alert("Your browser broke!");
				return false;
			}
		
	
}

ajaxFunction2();


ajaxRequest2.onreadystatechange=function(){
 if (ajaxRequest2.readyState==4){
  if (ajaxRequest2.status==200){
   document.getElementById("result2").innerHTML=ajaxRequest2.responseText;
  $('#result2').css('display','inline-block');	
  $('#newthrobber').hide();
  $('#newsubmitbutton').show();
  
  if(document.getElementById("result2").innerHTML == 'Phone exists !')
  {
	  
return false;	 
  }
   
  if(document.getElementById("result2").innerHTML == 'Username exists !')
  {
	 return false;
  }
  
  
  if(document.getElementById("result2").innerHTML == 'Request Submitted Successfully.')
  {

$('#newsubmitbutton').hide();
return true;
  }



 if(document.getElementById("result2").innerHTML == 'Every field is mandatory.')
  {

return false;
  }

  
document.getElementById("result2").innerHTML = "Fatal Error !";

 }






}
}










function failed_retry()
{
attempts  = document.getElementById('invisibleAttempts').value;
attempts++;
document.getElementById('invisibleAttempts').value = attempts;

if(attempts<3)
{
document.forms[0].reset();
document.getElementById('name').focus();
}
else
{
alert("Account Locked. Contact your SysAdmin ! ");
}
}

</script>
		
<style>

          span.reference{
              position:fixed;
              left:10px;
              bottom:10px;
              font-size:14px;
          }
          span.reference a{
              color:#aaa;
              text-decoration:none;
          }
          
          
          
#loginForm
{
background-color:#b0e0e6 ;
display:inline-block;
margin:auto;
width:50%;
}

</style>
	
<script>

$(function() {            
    $('#ad_1 > img').each(function(i,e){
        rotate($(this),500,3000,i);
    });
    function rotate(elem1,speed,timeout,i){
        elem1.animate({'marginLeft':'18px','width':'0px'},speed,function(){
            var other;
            if(elem1.parent().attr('id') == 'ad_1')	
                other = $('#ad_2').children('img').eq(i);
            else
                other = $('#ad_1').children('img').eq(i);
                other.animate({'marginLeft':'0px','width':'20px'},speed,function(){
                var f = function() { rotate(other,speed,timeout,i) };
                setTimeout(f,timeout);
            });
        });
    }
});


function SHA1 (msg) {
 
	function rotate_left(n,s) {
		var t4 = ( n<<s ) | (n>>>(32-s));
		return t4;
	};
 
	function lsb_hex(val) {
		var str="";
		var i;
		var vh;
		var vl;
 
		for( i=0; i<=6; i+=2 ) {
			vh = (val>>>(i*4+4))&0x0f;
			vl = (val>>>(i*4))&0x0f;
			str += vh.toString(16) + vl.toString(16);
		}
		return str;
	};
 
	function cvt_hex(val) {
		var str="";
		var i;
		var v;
 
		for( i=7; i>=0; i-- ) {
			v = (val>>>(i*4))&0x0f;
			str += v.toString(16);
		}
		return str;
	};
 
 
	function Utf8Encode(string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";
 
		for (var n = 0; n < string.length; n++) {
 
			var c = string.charCodeAt(n);
 
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
 
		}
 
		return utftext;
	};
 
	var blockstart;
	var i, j;
	var W = new Array(80);
	var H0 = 0x67452301;
	var H1 = 0xEFCDAB89;
	var H2 = 0x98BADCFE;
	var H3 = 0x10325476;
	var H4 = 0xC3D2E1F0;
	var A, B, C, D, E;
	var temp;
 
	msg = Utf8Encode(msg);
 
	var msg_len = msg.length;
 
	var word_array = new Array();
	for( i=0; i<msg_len-3; i+=4 ) {
		j = msg.charCodeAt(i)<<24 | msg.charCodeAt(i+1)<<16 |
		msg.charCodeAt(i+2)<<8 | msg.charCodeAt(i+3);
		word_array.push( j );
	}
 
	switch( msg_len % 4 ) {
		case 0:
			i = 0x080000000;
		break;
		case 1:
			i = msg.charCodeAt(msg_len-1)<<24 | 0x0800000;
		break;
 
		case 2:
			i = msg.charCodeAt(msg_len-2)<<24 | msg.charCodeAt(msg_len-1)<<16 | 0x08000;
		break;
 
		case 3:
			i = msg.charCodeAt(msg_len-3)<<24 | msg.charCodeAt(msg_len-2)<<16 | msg.charCodeAt(msg_len-1)<<8	| 0x80;
		break;
	}
 
	word_array.push( i );
 
	while( (word_array.length % 16) != 14 ) word_array.push( 0 );
 
	word_array.push( msg_len>>>29 );
	word_array.push( (msg_len<<3)&0x0ffffffff );
 
 
	for ( blockstart=0; blockstart<word_array.length; blockstart+=16 ) {
 
		for( i=0; i<16; i++ ) W[i] = word_array[blockstart+i];
		for( i=16; i<=79; i++ ) W[i] = rotate_left(W[i-3] ^ W[i-8] ^ W[i-14] ^ W[i-16], 1);
 
		A = H0;
		B = H1;
		C = H2;
		D = H3;
		E = H4;
 
		for( i= 0; i<=19; i++ ) {
			temp = (rotate_left(A,5) + ((B&C) | (~B&D)) + E + W[i] + 0x5A827999) & 0x0ffffffff;
			E = D;
			D = C;
			C = rotate_left(B,30);
			B = A;
			A = temp;
		}
 
		for( i=20; i<=39; i++ ) {
			temp = (rotate_left(A,5) + (B ^ C ^ D) + E + W[i] + 0x6ED9EBA1) & 0x0ffffffff;
			E = D;
			D = C;
			C = rotate_left(B,30);
			B = A;
			A = temp;
		}
 
		for( i=40; i<=59; i++ ) {
			temp = (rotate_left(A,5) + ((B&C) | (B&D) | (C&D)) + E + W[i] + 0x8F1BBCDC) & 0x0ffffffff;
			E = D;
			D = C;
			C = rotate_left(B,30);
			B = A;
			A = temp;
		}
 
		for( i=60; i<=79; i++ ) {
			temp = (rotate_left(A,5) + (B ^ C ^ D) + E + W[i] + 0xCA62C1D6) & 0x0ffffffff;
			E = D;
			D = C;
			C = rotate_left(B,30);
			B = A;
			A = temp;
		}
 
		H0 = (H0 + A) & 0x0ffffffff;
		H1 = (H1 + B) & 0x0ffffffff;
		H2 = (H2 + C) & 0x0ffffffff;
		H3 = (H3 + D) & 0x0ffffffff;
		H4 = (H4 + E) & 0x0ffffffff;
 
	}
 
	var temp = cvt_hex(H0) + cvt_hex(H1) + cvt_hex(H2) + cvt_hex(H3) + cvt_hex(H4);
 
	return temp.toLowerCase();
 
}

</script>


	
</head>
<body>
		

<noscript>
document.write('<span style="color:white;font-size:3em;margin-left:20px;">Turn On Javascript and Cookies in your browser!</span>'); 
</noscript>

        
		<div id="slidingMenuDesc" class="slidingMenuDesc">
		
			<div><span>Go back to grapes-3.tifr.res.in</span></div>
			<div><span>Access ROOT data !</span></div>
			<div><span>Need some help? </span></div>
			<div><span>Any suggestions or queries ? </span></div>
			
		</div>
	
		<ul id="slidingMenu" class="slidingMenu">
			<li><a href="javascript:void(0);"></a></li>
			<li><a href="http://grapes-3.tifr.res.in/" >Home</a></li>
			<li><a href="javascript:void(0);" id="signin">Sign-In</a></li>
			<li><a href="/Apex/Others/Help.html">User Guide</a></li>
			<li><a href="/Apex/Others/Contact.html">Contact Info</a></li>
			
		</ul>
		

        <div class="container">
            <div class="ad">
                <div id="ad_1" class="ad_1">
                    <img class="slice_1" src="ads/tifr-logo_01.jpg"/>
                    <img class="slice_2" src="ads/tifr-logo_02.jpg"/>
                    <img class="slice_3" src="ads/tifr-logo_03.jpg"/>
                    <img class="slice_4" src="ads/tifr-logo_04.jpg"/>
                    <img class="slice_5" src="ads/tifr-logo_05.jpg"/>
                    <img class="slice_6" src="ads/tifr-logo_06.jpg"/>
                    <img class="slice_7" src="ads/tifr-logo_07.jpg"/>
                    <img class="slice_8" src="ads/tifr-logo_08.jpg"/>
                    <img class="slice_9" src="ads/tifr-logo_09.jpg"/>
                    <img class="slice_10" src="ads/tifr-logo_10.jpg"/>
                    <img class="slice_11" src="ads/tifr-logo_11.jpg"/>
                    <img class="slice_12" src="ads/tifr-logo_12.jpg"/>
                    <img class="slice_13" src="ads/tifr-logo_13.jpg"/>
                    <img class="slice_14" src="ads/tifr-logo_14.jpg"/>
                    <img class="slice_15" src="ads/tifr-logo_15.jpg"/>
                    <img class="slice_16" src="ads/tifr-logo_16.jpg"/>
                    <img class="slice_17" src="ads/tifr-logo_17.jpg"/>
                    <img class="slice_18" src="ads/tifr-logo_18.jpg"/>
                    <img class="slice_19" src="ads/tifr-logo_19.jpg"/>
                    <img class="slice_20" src="ads/tifr-logo_20.jpg"/>
                    <img class="slice_21" src="ads/tifr-logo_21.jpg"/>
                    <img class="slice_22" src="ads/tifr-logo_22.jpg"/>
                </div>

                <div id="ad_2" class="ad_2">
                    <img class="slice_1" src="ads/apex-logo_01.jpg"/>
                    <img class="slice_2" src="ads/apex-logo_02.jpg"/>
                    <img class="slice_3" src="ads/apex-logo_03.jpg"/>
                    <img class="slice_4" src="ads/apex-logo_04.jpg"/>
                    <img class="slice_5" src="ads/apex-logo_05.jpg"/>
                    <img class="slice_6" src="ads/apex-logo_06.jpg"/>
                    <img class="slice_7" src="ads/apex-logo_07.jpg"/>
                    <img class="slice_8" src="ads/apex-logo_08.jpg"/>
                    <img class="slice_9" src="ads/apex-logo_09.jpg"/>
                    <img class="slice_10" src="ads/apex-logo_10.jpg"/>
                    <img class="slice_11" src="ads/apex-logo_11.jpg"/>
                    <img class="slice_12" src="ads/apex-logo_12.jpg"/>
                    <img class="slice_13" src="ads/apex-logo_13.jpg"/>
                    <img class="slice_14" src="ads/apex-logo_14.jpg"/>
                    <img class="slice_15" src="ads/apex-logo_15.jpg"/>
                    <img class="slice_16" src="ads/apex-logo_16.jpg"/>
                    <img class="slice_17" src="ads/apex-logo_17.jpg"/>
                    <img class="slice_18" src="ads/apex-logo_18.jpg"/>
                    <img class="slice_19" src="ads/apex-logo_19.jpg"/>
                    <img class="slice_20" src="ads/apex-logo_20.jpg"/>
                    <img class="slice_21" src="ads/apex-logo_21.jpg"/>
                    <img class="slice_22" src="ads/apex-logo_22.jpg"/>
                </div>
            </div>
        </div>
 
 

        	

					
<div id="sign_up">



<img src="resource/close_button.png" id="closebutton" onclick="$('#sign_up').trigger('close');" />
<p id="see_id" >Can we see some ID?</p>


<form id="login" method="post" action="authenticator.php">

<strong>

<label for="userNameBox">Username: </label>
<input type="text" name="userNameBox" id="name" tabindex="10" placeholder="or Enter Phone number" required>
<br />       
<br />
<label for="passWordBox">Password: </label>
&nbsp;<input type="password" name="passWordBox" id="password" tabindex="20" required>
<br />

</strong>

<div style="margin-top:10px;">

<label for="rememberMeCheckBox" style="font-size:0.8em;">Remember me on this PC ?</label>
<input type="checkbox" name="rememberMeCheckBox" id="rememberMeCheckBox" tabindex="75" value="remember" checked 
onClick ="altInvisibleRememberBoxValue();" >

</div>
	<center>
<p style="text-align:center;border-radius:10px;background-color:red;color:white;width:auto;padding:10px;display:none;margin-bottom:0px;" id="result"></p>
<p id="usertype"></p>
</center>

<input type="hidden" name="invisibleRememberBox" id = "invisibleRememberBox" value="remember" hidden />

<input type="hidden" name = "invisibleAttempts" id = "invisibleAttempts" value="0" />

<center>

<div style="position:relative;">
                        <a class="formbuttons"  href="javascript:void(0);" tabindex="90" onclick="document.forms[0].reset();$('#submitbutton').show();
$('#throbber').hide();" >Reset</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="formbuttons"  href="javascript:void(0);" tabindex="30" id="submitbutton" onclick="makeRequest();return false;" >Log In</a>
                                                                                            
                        <img style="display:none;" id="throbber" src="resource/ajax-loader.gif" />
</div>
                        
                        
</center>



<hr />

                <p style="display:inline;padding-top:10px;">Can't get in?</p>
                <br />
                
              
                <span ><a id="joiningrequest" href="javascript:void(0);">Click here</a> to send the admin a joining request !</span>
                


</form>

            </div>







<div id="joiningdiv">

<br />

<br />

<img src="resource/close_button.png" id="newclosebutton" onclick="$('#joiningdiv').trigger('close');" />

<form id="joinform" method="post" action="joiningrequestupdater.php">


<center>
<strong>

<label for="newuserNameBox">Username: </label>
<input type="text" name="newuserNameBox" id="newname" tabindex="10" placeholder="up to 20 characters" required>
<br />       
<br />
<label for="newpassWordBox">Password: </label>
&nbsp;<input type="password" name="newpassWordBox" id="newpassword" placeholder="more than 8 characters" tabindex="20" required>
<br />
<br />
<label for="newemailBox">E-mail: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="newemailBox" id="newemail" placeholder= "up to 40 characters" tabindex="30" required>
<br />       
<br />
<label for="newphoneBox">Phone: </label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="newphoneBox" placeholder="up to 14 digits" id="newphone" tabindex="40"  required>

</strong>
                        

<br />



<img style="display:none;" id="newthrobber" src="resource/ajax-loader.gif" />

 <a class="formbuttons"  href="javascript:void(0);" tabindex="50" id="newsubmitbutton" onclick="makeRequest2();return false;" >Submit</a>    

<br />
<p style="text-align:center;border-radius:10px;background-color:red;color:white;width:auto;padding:10px;display:none;margin-bottom:0px;" id="result2"></p>    
              
                        
</center>
             


</form>
</div>

		
	</body>
</html>






