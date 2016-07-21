<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style type="text/css">

div#search
{
	background: #ceceff;
	border: 10px inset red;
	width: 800px;
	height:650px;
	padding: 40px;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translateX(-50%) translateY(-50%);
}

body
{
	background: #8866ff;
}

img 
{
	display:inline;
    border-radius: 8px;
    border: 5px outset #a20bf9;
    border-radius: 60px;
    padding: 5px;
    margin-right: 50%;
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
top: 20%;
left: 70%;

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

</style>

<div id="search">

<?php

session_start();
$search=$_POST['search'];

$search = stripslashes($search);
$search = mysql_real_escape_string($search);

$conn= mysql_connect("localhost","root","");

if(!$conn)
	die("Connection Failed!!".mysql_error());

mysql_select_db("delta") or die("Database doesn't exists!!");

$sql ="SELECT * FROM mybase WHERE Username='$search' OR Name='$search' OR Phone='$search' OR EMail='$search'";
$retval = mysql_query( $sql, $conn ) or die (mysql_error());

$count=mysql_num_rows($retval);


if(! $retval ) 
{
      die('Could not get data:'.mysql_error());
}

$var;
$n;

if($count==1)
{
	while($row = mysql_fetch_assoc($retval)) 
	{
		$var= $row['Location']; 
		$n= $row['Username'];  
	}
}

else if($count==0)
{
	$message = "User not found!!";
	echo "<script type='text/javascript'>alert('$message');</script>";
	//header("location:javascript://history.go(-1)");
	//header('Location: http://localhost/test/log.php');
}

else
{
	$message = "Multiple entries found!!";
	echo "<script type='text/javascript'>alert('$message');</script>";
}

mysql_close($conn);
?>

<img src="<?php echo $var; ?>" alt="Profile Picture"; ">

<?php
$conn= mysql_connect("localhost","root","");
mysql_select_db("delta") or die("Database doesn't exists!!");
$sql ="SELECT * FROM mybase WHERE Username='$search' OR Name='$search' OR Phone='$search' OR EMail='$search'";
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
<button type="button" class="button" onclick="back()">Back</button>

<script type="text/javascript">

function back()
{
	history.go(-1);
}
</script>
</div>
</head>
</html>