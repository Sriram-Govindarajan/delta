<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>

div#display
{
	width:1800px;
	margin: 0px auto;
}

@media screen and (max-width:1799px)
{
	#display
	{
		width:100%;
	}
}

@media screen and (max-width:500px)
{
	#display
	{
		width:500px;
	}
}

body
{
	background: rgb(200,190,255);
}

h1
{	
	
	font-family: times new roman;
	color: black;
	text-shadow: 2px 2px #f808ff;
	text-align: center;
	font-size: 45px;
}

.button
{
position: absolute;
top: 20%;
left: 30%;

background-color: white;
border: 5px inset rgb(153,0,204);
color: black;
padding: 10px;
text-align: center;
font-size: 15px;
margin: 3px;
cursor: pointer;
transition-duration: 0.5sec;
}

.button:hover
{
background-color: rgb(225,225,225);
color: black;
border: 5px outset rgb(200,100,100);
font-size: 15px;
}

.button1
{
position: absolute;
top: 20%;
right: 30%;

background-color: white;
border: 5px inset rgb(153,0,204);
color: black;
padding: 10px;
text-align: center;
font-size: 15px;
margin: 3px;
cursor: pointer;
transition-duration: 0.5sec;
}

.button1:hover
{
background-color: rgb(225,225,225);
color: black;
border: 5px outset rgb(200,100,100);
font-size: 15px;
}

</style>
<script type="text/javascript">	
function back()
{
	history.go(-1);
}
</script>

<div id="display">

<?php

session_start();

$name= $_POST["name"];
$gender= $_POST["gender"];
$phone= $_POST["phone"];
$email= $_POST["email"];
$uname= $_POST["uname"];
$about=$_POST["about"];
$password=$_POST["password"];
$sal;
$location='uploads/'.$uname.'.jpg';

$uname = stripslashes($uname);
$password = stripslashes($password);
$name = stripslashes($name);
$email = stripslashes($email);
$gender = stripslashes($gender);
$phone = stripslashes($phone);
$about = stripslashes($about);
$location = stripslashes($location);

$uname = mysql_real_escape_string($uname);
$password = mysql_real_escape_string($password);
$name = mysql_real_escape_string($name);
$email = mysql_real_escape_string($email);
$gender = mysql_real_escape_string($gender);
$phone = mysql_real_escape_string($phone);
$about = mysql_real_escape_string($about);
$location = mysql_real_escape_string($location);

$check=0;

	if($password=="")
		die('<h1>input passsword</h1>');
	if( strlen($password) < 5 || strlen($password) >15)
		die('<h1>Password must be within 5-15 characters<h1>');
	if(!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])[0-9A-Za-z _@&]{5,15}$/', $password)) 
    	die('<h1>The password does not meet the requirements!</h1>');

$password= hash("sha256", $password);

if($password == $_SESSION['password'])
{
	$check=0;
}

else
{
	$check=1;
}
	
	if($gender=="Male")
		$sal="Master";
	else if($gender=="Female")
		$sal="Miss";

	if($name=="")
		die('<h1>input name</h1>');
	if( strlen($name) < 2 || strlen($name) >20)
		die('<h1>Name must be within 2-20 characters</h1>');
	if(preg_match("/[^A-Za-z. ]/",$name))
		die("<h1>Invalid Character in Name</h1>");

	if($uname=="")
		die('<h1>input username</h1>');
	if( strlen($uname) < 5 || strlen($uname) >15)
		die('<h1>username must be within 5-15 characters</h1>');
	if(preg_match("/[^-A-Za-z0-9.&,@: _]/",$uname))
		die("<h1>Invalid Character in Username</h1>");
	if(!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[@])[-0-9A-Za-z.,: _@&]{5,15}$/', $uname)) 
    	die('<h1>The username does not meet the requirements!</h1>');
  
	if($email=="")
		die('<h1>input email</h1>');
	if(preg_match("/[^-A-Za-z0-9\@\ ,_.]/",$email))
		die("<h1>Invalid Characters in Email</h1>");
   
	if($phone=="")
		die('<h1>input phone number</h1>');
	if(preg_match("/[^0-9]/",$phone))
		die("<h1>Invalid Characters in phone</h1>");
	if($phone[0]==0)
		die("<h1>Phone number cannot start with zero</h1>");   
  
	if($_FILES['newpropic']['size']!=0)
	{
		if(!move_uploaded_file($_FILES['newpropic']['tmp_name'],'uploads/'.$uname.'.jpg'))
		{
			die("error uploading the file.");
		}
	

		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["newpropic"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		if($_FILES['newpropic']['error']>0)
			die('<h1>An error in file</h1>');
		if($_FILES['newpropic']['size']>3*1024*1024)
			die('<h1>Filesize greater than 3MB</h1>');

		if($imageFileType == "jpg" )
    	{
    		$location='uploads/'.$uname.'.jpg';
    	}

    	elseif ($imageFileType== "png") 
    	{
    		$location='uploads/'.$uname.'.png';
    	}

    	elseif ($imageFileType== "jpeg") 
    	{
    		$location='uploads/'.$uname.'.jpeg';
    	}

    	elseif ($imageFileType=="gif") 
    	{
    		$location='uploads/'.$uname.'.gif';
    	}

		if(isset($_POST["submit"])) 
		{
    		$check = getimagesize($_FILES["newpropic"]["tmp_name"]);
    		if($check === false) 
    		{
        		die('<h1>Please ensure that you are uploading an image</h1>');
    		}

			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
			{
    			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    		}
		}
	}



mysql_connect("localhost","root","");
mysql_select_db("delta");
$edit=mysql_query("UPDATE mybase SET Name='$name', EMail='$email', Password='$password', Gender='$gender', Phone='$phone', About='$about', Location='$location' WHERE Username='$uname'");

if ($edit === TRUE) 
{
    echo "<h1>Record for ".$sal." ".$name." has been edited successfully!!</h1>";

    $_SESSION['name'] = $name;
	$_SESSION['uname'] = $uname;
	$_SESSION['gender'] = $gender;
	$_SESSION['email'] = $email;
	$_SESSION['phone'] = $phone;
	$_SESSION['about'] = $about;
	$_SESSION['password'] = $password;
	$_SESSION['location'] = $location;

} 

else 
{
    echo "<h1>Error editing!!!<h1>";
}

?>

<a href="http://localhost//test/logout.php">
<button type="button" class="button1">Log Out</button>
</a>

<button type="button" class="button" onclick="back()">Back</button>

</head>
</html>