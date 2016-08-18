<?php
session_start();
if(isset($_POST['submit']) && $_POST['submit'] != '')
{
	$selects = array('-- Please Select --','Book One On One Training Session','Information About One On One Training','Information on Goalie Schools','Information on Winter Clinics','General Questions - Topic Not Listed','On Ice Training Session Information','Employment Enquiry');
	$_SESSION['fname'] = $_POST['fname'];
	$_SESSION['lname'] = $_POST['lname'];
	$_SESSION['sname'] = $_POST['sname'];
	$_SESSION['city'] = $_POST['city'];
	$_SESSION['phone'] = $_POST['phone'];
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['message'] = $_POST['message'];
	$_SESSION['dropvalue']= $_POST['select'];
	$_SESSION['select'] = $selects[$_POST['select']];
	if(isset($_FILES['doc1']['name']) && $_FILES['doc1']['name'] != '')
	{
		$_SESSION['doc1'] = $_FILES['doc1']['name'];
		$info = $_FILES['doc1']['name'];
	   	$target = 'attachment/'.$info;
		move_uploaded_file($_FILES['doc1']['tmp_name'], $target);
	}
	if(isset($_FILES['doc2']['name']) && $_FILES['doc2']['name'] != '')
	{
		$_SESSION['doc2'] = $_FILES['doc2']['name'];
		$info = $_FILES['doc2']['name'];
	   	$target = 'attachment/'.$info;
		move_uploaded_file($_FILES['doc2']['tmp_name'], $target);
	}
  session_write_close();
	header("location:contact1.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Keywords" content="Goalie schools, goaltender programs, goalie training, summer goalie camps, pro goalie coaches, goaltender coaching, goalie school, goaltender school, ice hockey goalie school, goalie ice camps, goalie training, goaltender training, Puckstoppers goalie school, best goalie school, goal camp, ice hockey goalie camps, goalie instruction, pro goalie instructors, Rick Heinz, goalie camps Ontario, goaltender schools Canada, goalie camp advice,">

<meta name="Description" content="Among the longest running goalie schools and goaltender training programs in the world with pro goalie instructors with years of goaltending training and goalie instruction experience. Year round goalie training by professional goalie coaches.">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Puckstoppers - Contact Us</title>
<link href="untitled.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style8 {font-family: Arial, Helvetica, sans-serif; font-size: 17px; font-weight: bold; color: #FEC90A; }
.style2 {color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
}
.style2 {font-family: Arial, Helvetica, sans-serif}
.style45 {color: #AE1421;
	font-family: "Bank Gothic";
	font-size: 20px;
}
body {
	background-repeat: repeat-x;
}
.style105 {font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #000000; }
.style66 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #3a3a3a;
	font-size: 20px;
}
.style110 {font-size: 13px; font-family: Arial, Helvetica, sans-serif; }
.style111 {font-size: 11px}
.form-div{ float:left; margin:10px;font-family: Arial, Helvetica, sans-serif; font-size:13px;}
.form{width:535px; float:left; margin:7px 0 0 20px;}
.video-div{ float:right; width:380px; margin-left:10px;}
.textbox{ width:200px; border:1px solid #9C9C9C; border-radius: 4px; height:20px; }
.submit{ width:100px; height:30px; background-color:#000000; color:#ffffff; border:none; cursor:pointer;}
-->
</style>
<script>
function validate()
{
	if(document.getElementById("fname").value == '')
	{
		alert("Please Enter Your First Name");
		document.getElementById("fname").focus();
		return false;
	}
	if(document.getElementById("lname").value == '')
	{
		alert("Please Enter Your Last Name");
		document.getElementById("lname").focus();
		return false;
	}
	if(document.getElementById("city").value == '')
	{
		alert("Please Enter Your City");
		document.getElementById("city").focus();
		return false;
	}
	if(document.getElementById("email").value == '')
	{
		alert("Please Enter Your Email Address");
		document.getElementById("email").focus();
		return false;
	}
	else if (div_echeck(document.getElementById('email').value)==false){
			alert("Invalid Email Address");
			document.getElementById("email").focus();
			return false;
		}
	if(document.getElementById("selected").value != '1')
	{
		if(document.getElementById("message").value == '')
		{
			alert("Please Enter Your Message");
			document.getElementById("message").focus();
			return false;
		}
	}
	if(document.getElementById("selected").value == '' || document.getElementById("selected").value == '-1')
	{
		alert("Please Select An Option");
		document.getElementById("selected").focus();
		return false;
	}
	if(document.getElementById("check").checked == false)
	{
		alert("Please Check I HAVE READ THE INFORMATION ABOVE");
		return false;
	}
	return true;
}
function div_echeck(str)
	{
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
			return false
		}
		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
			return false
		}
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
			return false
		}
		 if (str.indexOf(at,(lat+1))!=-1){
			return false
		 }
		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
			return false
		 }
		 if (str.indexOf(dot,(lat+2))==-1){
			 return false
		 }
		 if (str.indexOf(" ")!=-1){
				return false
		 }
		 return true
	}

	function display_text1(val)
	{
		//alert("select_"+val);
		var text = document.getElementById("select_"+val).innerHTML;
		//alert(text);
		document.getElementById("select_div").innerHTML = text;
		document.getElementById("select_div").style.display = 'block';
	}
	function display_text(val)
	{
		if(val != 0)
		{
			var dataString = 'display_text='+val;
			$.ajax({
				type: "POST",
				url: "text.php",
				data: dataString,
				success: function(data){
					if(data)
					{
						document.getElementById("select_div").innerHTML = data;
						document.getElementById("select_div").style.display = 'block';
						//return false;
					}
				}
			});
		}
	}
</script>
</head>

<body>
<div id="wrapper">
  <div id="header"><a href="index.html"><img src="images/Header SC.jpg" alt="logo" width="1000" height="200" border="0" usemap="#Map" /></a><a href="index.html">
    <map name="Map" id="Map">
      <area shape="rect" coords="22,149,92,194" href="http://www.vaughnhockey.com/" target="_blank" alt="Vaughn" />
      <area shape="rect" coords="112,147,191,195" href="http://www.fishermansfriend.com/" target="_blank" alt="Fishermans Friend" />
      <area shape="rect" coords="212,148,305,195" href="http://www.sourcelondon.com/" target="_blank" alt="Source for Sports" />
      <area shape="rect" coords="323,144,384,196" href="http://www.hockeyprom.com/" target="_blank" alt="Hockeyprom" />
      <area shape="rect" coords="590,149,687,196" href="http://www.hockeygeeks.com/" target="_blank" alt="Hockey Geeks" />
      <area shape="rect" coords="711,149,771,196" href="http://www.jffhl.com/" target="_blank" alt="JFFHL " />
      <area shape="rect" coords="795,155,882,195" href="http://canadianmarketingacademy.com/" target="_blank" alt="CMA" />
      <area shape="rect" coords="907,150,975,194" href="http://www.vaughnhockey.com/" target="_blank" alt="Vaughn" />
    </map>
  </a></div>
  <div id="nav"><a href="index.html">HOME</a> <a href="trainingcentre.html">TRAINING CENTRE</a> <a href="programs.html">PROGRAMS</a> <a href="testimonials.html">TESTIMONIALS</a> <a href="signup.html">SIGNUP</a> <a href="articles.html">ARTICLES</a><a href="instructors.html">INSTRUCTORS</a> <a href="about.html">ABOUT</a> <a href="contact.html">CONTACT US</a></div>
  <div id="body">
    <p align="center" class="style45">&nbsp;</p>
    <table width="750" border="0" align="center" cellpadding="3" cellspacing="0">
      <tr>
        <td><div align="center"><span class="style66"> Puckstoppers - Contact Us</span></div></td>
      </tr>
      <tr>
        <td class="style105"><div align="center"><strong>Have Questions? Contact Us!</strong></div></td>
      </tr>
    </table>
	<form name="contact" method="post" action="contact.php" enctype="multipart/form-data">
	  <div class="form-div">
		<div class="form">
	      <fieldset>
		  	<legend style="border:1px solid #999999;"> STAGE 1 </legend>
				<table width="100%" border="0" cellspacing="0" cellpadding="5">
				  <tr>
					<td width="42%">First Name : </td>
					<td width="58%"><input type="text" name="fname" id="fname" class="textbox"/></td>
				  </tr>
				  <tr>
					<td>Last Name : </td>
					<td><input type="text" name="lname" id="lname" class="textbox"/></td>
				  </tr>
				  <tr>
					<td>Students Full Name : </td>
					<td><input type="text" name="sname" id="sname" class="textbox"/></td>
				  </tr>
				  <tr>
					<td>Your City : </td>
					<td><input type="text" name="city" id="city" class="textbox"/></td>
				  </tr>
				  <tr>
					<td>Best Phone : </td>
					<td><input type="text" name="phone" id="phone" class="textbox"/></td>
				  </tr>
				  <tr>
					<td>Email for us to reply to : </td>
					<td><input type="text" name="email" id="email" class="textbox" /></td>
				  </tr>
				  <tr>
					<td>Message : </td>
					<td>
					<textarea name="message" id="message" rows="3" col="12"></textarea>
					</td>
				  </tr>
				  <tr>
					<td>Subject Line : </td>
					<td>
						<select name="select" id="selected" onchange="display_text(this.value);">
							<option value="-1"> -- Please Select -- </option>
							<option value="1">Book One On One Training Session</option>
                            <option value="2">Information About One On One Training</option>
							<option value="3">Information on Goalie Schools</option>
							<option value="4">Information on Winter Clinics</option>
							<option value="5">General Questions - Topic Not Listed</option>
							<option value="6">On Ice Training Session Information</option>
							<option value="7">Employment Enquiry</option>
						</select>
					</td>
				  </tr>
				  <tr>
				  	<td colspan="2"><div id="select_div" style="display:none; line-height:23px; text-align:justify; margin:5px 0 5px 0;">&nbsp;</div></td>
				  </tr>
				  <tr>
					<td colspan="2" align="center"><input type="checkbox" name="check" id="check" style="padding:0; margin:0;"/> I HAVE READ THE INFORMATION ABOVE</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td><input type="submit" name="submit" value="SUBMIT" class="submit" onclick="return validate()"/></td>
				  </tr>
				</table>
		  </fieldset>
		</div>

		<div class="video-div">
			<p align="center" class="style110"><strong>PUCKSTOPPERS GOALTENDING SERVICES</strong><br />
			  (MAILING ADDRESS)</p>
			<p align="center" class="style110">Puckstoppers Goaltending Services<br />
			  487 Alston Road <br />
			  London, Ontario<br />
			  N6C 3B8</p>
			<p align="center" class="style110">&nbsp;</p>
			<table width="304" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="304" height="230"><iframe width="300" height="200" src="http://www.youtube.com/embed/NutB5BkbI0U" frameborder="0" allowfullscreen="allowfullscreen"></iframe></td>
			  </tr>
			  <tr>
				<td height="196"><iframe width="300" height="200" src="http://www.youtube.com/embed/zNCNe1blR8c" frameborder="0" allowfullscreen="allowfullscreen"></iframe></td>
			  </tr>
			</table>
		</div>
	</div>
	</form>
    <div style="clear:both;"></div>
    <p align="center" class="style110">Please be sure to check out the <a href="FAQ.html">FAQ</a> section before you email with questions. we find that about 95% of the questions we are asked, are answered on this website. </p>
    <p align="center" class="style110"><img src="images/ContactUs.jpg" alt="contact" width="205" height="133" /></p>
    <p align="center" class="style110">Email us: <strong>info@puckstoppers.com</strong></p>
    <p align="center" class="style110">Email is the best method of contact <br />
    All email messages are replied to within 24 hours (usually same day), Monday to Friday during normal business hours.</p>
    <p align="center" class="style110">Please be sure the 'Subject Line' is completed for all messages. Be very SPECIFIC when completing this information as our software sorts messages by 'Subject Line' and vague, incomplete or non specific Subject Lines will encounter delayed response times. <br />
    Do not send us old messages with new requests, always send a new email for all questions and requests to ensure a quick response. </p>
    <p align="center" class="style110">&nbsp;</p>
    <p align="center" class="style110"><img src="images/ContactUs2.jpg" alt="contact2" width="164" height="143" /></p>
    <p align="center" class="style110">Please Note: <span class="style111">ALL INCOMING CALLS ARE DIRECTED and answered by VOICE MAIL. Return calls are made when we are available (may be 24 to 48 hours), which is why we recommend email for all communications or to set up a phone consultation time. </span></p>
    <p align="center" class="style110">Phone: <strong>519-668-7414</strong>          </p>
    <p align="center" class="style110">Fax: Please CALL prior to sending a Fax or for faster submission, Scan &amp; Email your information </p>
    <p align="center" class="style110">&nbsp;</p>
    <p align="center" class="style110">&nbsp;</p>
    <p align="center" class="style110">Click here to view our <a href="http://www.lpfsportsconcepts.com/help.php?section=business"><strong>Privacy Policy</strong></a></p>
    <p align="center"> </p>
    <p align="center" class="style110">Puckstoppers Goaltending Services is a division of Level Playing Field Success Concepts, which can be reached using the same information above.</p>
    <p class="style110">&nbsp;</p>
    <p class="style110">&nbsp;</p>
    <p align="center" class="style110">&nbsp;</p>
    <p></p>
    <p align="center" class="style8"></p>
  </div>
  <div id="footer">
    <p align="center" class="style1">Copyright © 2013 Puckstoppers - Web Design by UpperEdge Media</p>
    <p align="center" class="style2"><a href="trainingcentre.html">Training Centre </a> |<a href="programs.html"> Programs </a> | <a href="testimonials.html">Testimonials </a> | <a href="signup.html">Signup </a> | <a href="articles.html">Articles </a> | <a href="instructors.html">Instructors </a> | <a href="about.html">About </a> | <a href="contact.html">Contact Us</a></p>
  </div>
  <body background="image.jpg" bgproperties="fixed">
</div>
</body>
</html>
<?php
if(isset($_SESSION['success']))
{
	$success=$_SESSION['success'];
	if($success=="1")
	{
		session_destroy();
		echo "<script type='text/javascript'>alert('Request Sent Successfully');</script>";
	}
	else
	{
		session_destroy();
		echo "<script type='text/javascript'>alert('Error occurred. Try again later!');</script>";
	}
}

?>
