<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style type="text/css">

div#display
{
	background: #ce89f6;
	border: 10px inset #ffddcc;
	width: 950px;
	height: 800px;
	padding: 40px;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translateX(-50%) translateY(-50%);
	margin: 0px auto;
}

*
{
	box-sizing: border-box;
}

@media screen and (max-width:799px)
		{
			#display
			{
				width:100%;
				position: absolute;
			}
		}

@media screen and (max-width:320px)
		{
			#display
			{
				width:320px;
			}
		}

body
{
	background: #9f14e5;
}

img 
{
	display:inline;
    border-radius: 8px;
    border: 5px outset #a20bf9;
    border-radius: 60px;
    padding: 5px;
    margin-right: 35%;
    margin-left: 65%;
    margin-bottom: 2%;
    width: 250px;
    height: 250px;
}

h1
{	
	display: inline;
	font-family: times new roman;
	color: black;
	text-shadow: 2px 2px #f808ff, 0 0 25px yellow, 0 0 5px white;
	text-align: center;
	font-size: 45px;
}

h2
{
	color: "#ce88ff"; 
	font-size:40px;
	text-align: center; 
	font-family: cambria; 
	text-shadow: 1px 1px 2px red, 0 0 25px yellow, 0 0 5px white;
}

h4
{	
	display: inline;
	font-family: cambria;
	color: yellow;
	text-shadow: 2px 2px #ff0088;
	text-align: left;
	font-size: 35px;
}

h3
{	
	display: inline;
	font-family: cambria;
	color: brown;
	text-shadow: 2px 2px #ff8800;
	text-align: center;
	font-size: 50px;
}

p
{	
	display: inline;
	font-family: cambria;
	color: green;
	text-shadow: 2px 2px #00ff88, 0 0 10px yellow, 0 0 5px black;
	text-align: left;
	font-size: 45px;
}

.button
{
position: absolute;
top: 30%;
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
top: 30%;
left: 10%;

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

div#form
{
	position: absolute;
	top: 7%;
	left: 10%;
}

</style>

<body onload="head()">
   
<div id="display">
<h2 id="heading"></h2>
<a href="http://localhost/test/logout.php">
<button type="button" class="button" onclick="logout()">Logout</button>
</a>

<a href="http://localhost/test/edituser.php">
<button type="button" class="button1">Edit</button>
</a>

<div id="form">
<b><br><br><br><br><br>
<form method="post" action="http://localhost/test/search.php">
<input type="text" name="search" onKeyUp="ajaxFunction(this.value);">
<input type="submit" name="submit" value="Search">
<span id="displayDiv"></span>
<br>
<div id="msg"></div>
</form>
</div>

<?php 
session_start();

$uname= $_POST['uname'] ;
$password= $_POST['password'];
$sal;

$password= hash("sha256", $password);

$conn= mysql_connect("localhost","root","");

if(!$conn)
	die("Connection Failed!!".mysql_error());

mysql_select_db("delta") or die("Database doesn't exists!!");

$sql ="SELECT * FROM mybase WHERE Username='$uname' OR Phone='$uname' AND Password='$password' ";
$retval = mysql_query( $sql, $conn ) or die ("User not found!!");

$count=mysql_num_rows($retval);

$var;
$n;
$g;
$sal;

if(!$retval ) 
{
      die("Could not get data!");
}

if($count==1)
{
	while($row = mysql_fetch_assoc($retval)) 
	{
		$var= $row['Location']; 
		$n= $row['Name'];  
		$g= $row['Gender'];

		if($g=="Male")
			$sal="Master";
		else if($g=="Female")
			$sal="Miss";

		$name = $row['Name'];
		$uname = $row['Username'];
		$gender = $row['Gender'];
		$email = $row['EMail'];
		$phone = $row['Phone'];
		$about = $row['About'];
		$password = $row['Password'];
		$location = $row['Location'];


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

		$_SESSION['name'] = $name;
		$_SESSION['uname'] = $uname;
		$_SESSION['gender'] = $gender;
		$_SESSION['email'] = $email;
		$_SESSION['phone'] = $phone;
		$_SESSION['about'] = $about;
		$_SESSION['password'] = $password;
		$_SESSION['location'] = $location;
	}
}

else 
{
	sleep(1);
	header('Location: http://localhost/test/my_base.html#!');
}

mysql_close($conn);
?>

<img src="<?php echo $var; ?>" alt="Profile Picture">

<?php
$conn= mysql_connect("localhost","root","");
mysql_select_db("delta") or die("Database doesn't exists!!");
$sql ="SELECT * FROM mybase WHERE Username='$uname' OR Phone='$uname' AND Password='$password' ";
$retval = mysql_query( $sql, $conn ) or die (mysql_error());

while($row = mysql_fetch_assoc($retval)) 
	{
		echo "<h1>Username:<p> {$row['Username']}</p><br>".    	
        	"Name: <p> {$row['Name']} </p> <br> ".
        	"Gender:<p> {$row['Gender']}</p><br>".
        	"E-Mail:<p> {$row['EMail']}</p> <br>" .
        	"Phone Number:<p> {$row['Phone']}</p><br>".
        	"About:<p> {$row['About']}</p></h1><br><br>";
	}

	    
mysql_close($conn);
        
?>

</div>

<title><?php  echo "Welcome "." $uname" ?></title>

<script type="text/javascript">

function head()
{
	document.getElementById("heading").innerHTML= "<?php echo "Welcome to My-Base.........."." $sal "." $n !!" ?>";
}

function logout()
{
	document.getElementById("display").innerHTML= "<h4>Logged Out Successfully.......</h4>";
}

function ajaxFunction(str)
{
	var httpxml;
	try
	{
 		httpxml=new XMLHttpRequest();
   	}

	catch (e)
   	{
  		try
    	{
    		httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    	}
  
  		catch (e)
    	{
    		try
      		{
      			httpxml=new ActiveXObject("Microsoft.XMLHTTP");
      		}
    
    		catch (e)
      		{	
      			alert("Your browser does not support AJAX!");
      			return false;
      		}
    	}
  	}

	function stateChanged() 
    {
    	if(httpxml.readyState==4)
      	{
			document.getElementById("displayDiv").innerHTML=httpxml.responseText;
			document.getElementById("msg").style.display='none';
		}
    }

	var url="livesearch.php";
	url=url+"?txt="+str;
	url=url+"&sid="+Math.random();
	httpxml.onreadystatechange=stateChanged;
	httpxml.open("GET",url,true);
	httpxml.send(null);
}

</script>   
 
</head>
<body>

</body>
</html>