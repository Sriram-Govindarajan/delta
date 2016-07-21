<!DOCTYPE html>
<html>
<head>


<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style type="text/css">

body
{
	background: rgb(200,190,255);
}

div#form
{
	background: black;
	border: 10px inset red;
	width: 600px;
	height:860px;
	padding: 30px;
	position: absolute;
	top: 50%;
	left:50%;
	transform: translateX(-50%) translateY(-50%);
}

@media screen and (max-width:599px)
{
    #form
    {
        width: 100%;
    }
}


@media screen and (max-width:320px)
{
    #form
    {
        width:320px;
    }
}

p
{
	
	font-family: cambria;
	color: yellow;
}

h4
{
	font-family: cambria;
	color: green;
}

h1
{	
	
	font-family: times new roman;
	color: violet;
	text-align: center;
	font-size: 25px;
}

h2
{	
	font-family: jokerman;
	color: blue;
	text-align: left;
	font-size: 25px;
}

h3
{	
	display: inline;
	font-family: cambria;
	color: hotpink;
	font-size: 15px;
}

img 
{
	position: absolute;
    border-radius: 8px;
    border: 5px outset #a20bf9;
    border-radius: 60px;
    padding: 5px;
    right: 8%;
    top: 12%;
    width: 250px;
    height: 250px;
}

input[type="radio"]:checked:before {
    content: "";
    display: block;
    position: relative;
    top: 3px;
    left: 3px;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: blue;
}

.button
{
position: absolute;
bottom: 2%;
right: 10%;

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
</head>

<body>

<?php

session_start();

$name= $_SESSION['name'];
$uname= $_SESSION['uname'];
$password= $_SESSION['password'];
$gender= $_SESSION['gender'];
$phone= $_SESSION['phone'];
$email= $_SESSION['email'];
$about= $_SESSION['about'];
$location= $_SESSION['location'];

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

?>

<script>


function check(form)
{
	var letters = /^[-A-Za-z.&, ]+$/;
	var uname = /^[-A-Za-z_0-9.&,@: ]+$/;
	var mail = /^[-.,@A-Za-z_0-9]+$/;
	var pass = /^[A-Za-z_0-9@& ]+$/;
	
	if(!letters.test(form.name.value))
	{
		alert("Please enter valid characters!!");
		form.name.focus();
		return false;
	}

	if(!letters.test(form.about.value))
	{
		alert("Please enter valid characters!!");
		form.about.focus();
		return false;
	}

	if(!mail.test(form.email.value))
	{
		alert("Please enter valid characters!!");
		form.email.focus();
		return false;
	}

	if(form.pwd.value != form.pwd2.value)
	{
		alert("Please enter the same passwords!!");
		form.re_password.focus();
		return false;
	}

	if(!pass.test(form.password.value))
	{
		alert("Please enter a valid password!!");
		form.password.focus();
		return false;
	}

	if(form.pwd.value.length<5) 
	{
        alert("Password must contain atleast 5 characters only!");
        form.password.focus();
        return false;
    }

    if(form.pwd.value.length>15) 
	{
        alert("Password must contain atmost 15 characters only!");
        form.password.focus();
        return false;
    }
      
    if(form.pwd.value == form.uname.value) 
    {
        alert("Password must be different from Username!");
        form.pwd.focus();
        return false;
    }

    if(form.pwd.value == form.name.value) 
    {
        alert("Password must be different from Name!");
        form.pwd.focus();
        return false;
    }

    if(form.pwd.value == form.phone.value) 
    {
        alert("Password must be different from Phone Number!");
        form.pwd.focus();
        return false;
    }
      
    re = /[0-9]/;
    if(!re.test(form.pwd.value)) 
    {
        alert("Password must contain at least one number (0-9)!");
        form.pwd.focus();
        return false;
    }
      
    re = /[a-z]/;
    if(!re.test(form.pwd.value)) 
    {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        form.pwd.focus();
        return false;
    }
      

    re = /[A-Z]/;
    if(!re.test(form.pwd.value)) 
    {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        form.pwd.focus();
        return false;
    }

	return true;
}

function checkPass()
{
    var pass1 = document.getElementById('pwd');
    var pass2 = document.getElementById('pwd2');
    var message2 = document.getElementById('confirmMessage');
    var message1 = document.getElementById('Message');
    var pass = /^[A-Za-z_0-9 @&]+$/;

    if(pass1.value == pass2.value)
    {
        pass2.style.backgroundColor = "#66cc66";
        message2.style.color = "#66cc66";
        message2.innerHTML = "Passwords Match!";
    }
    else
    {
        pass2.style.backgroundColor = "#ff6666";
        message2.style.color = "#ff6666";
        message2.innerHTML = "Passwords Do Not Match!";
    }

    

    if(pass2.value == "")
    {
        pass2.style.backgroundColor = "#ff6666";
        message2.style.color = "#ff6666";
        message2.innerHTML = "Enter Password!";
    }

    if(!pass.test(pass1.value))
	{
		pass1.style.backgroundColor = "hotpink";
		message1.style.color = "hotpink";
        message1.innerHTML = "Password is not valid!";
	}

	else
	{
		pass1.style.backgroundColor = "#c8beff";
		message1.style.color = "#c8beff";
        message1.innerHTML = "Password is valid!";
	}

	if(pass1.value.length<5 && pass1.value.length>0) 
	{
        pass1.style.backgroundColor = "hotpink";
		message1.style.color = "hotpink";
        message1.innerHTML = "Password is too short!!";
    }

    else if(pass1.value == "")
    {
        pass1.style.backgroundColor = "#ff6666";
        message1.style.color = "#ff6666";
        message1.innerHTML = "Enter Password!";
    }

    else if(pass1.value.length>15) 
	{
        pass1.style.backgroundColor = "hotpink";
		message1.style.color = "hotpink";
        message1.innerHTML = "Password is too long!!";
    }
}  

function checkname()
{
	var name= document.getElementById("name");
	var letter= /^[A-Za-z. ]+$/;
	var mes= document.getElementById("mes");

	if(!letter.test(name.value))
	{
		name.style.backgroundColor = "#ff6666";
        mes.style.color = "#ff6666";
        mes.innerHTML = "Invalid name!!";
	}

	else
	{
		name.style.backgroundColor = "#66cc66";
        mes.style.color = "#66cc66";
        mes.innerHTML = "Valid name!";
	}
}

function back()
{
    history.go(-1);
}
</script>

<div id="form">

<button type="button" class="button" onclick="back()">Back</button>

<h1 id="student"> Edit Details of <?php echo $name; ?></h1>

<form action="http://localhost/test/edit.php" method="post" enctype="multipart/form-data" id="myForm"  onsubmit= "return check(this);">

<img src="<?php echo $location; ?>" style="height:200px; width:200px;" alt="Existing profile picture">

<p>Name<span style="color:red">*</span></p>
<input type="text" name="name" id="name" value="<?php echo $name; ?>" onkeyup="checkname(); return false;" required>
<span id="mes" class="confirmMessage"></span>

<p>E-Mail<span style="color:red">*</span></p>
<input type="email"  name="email" value="<?php echo $email; ?>" required>

<p>Username<span style="color:red">*</span></p>
<input type="text" name="uname" id="uname" value="<?php echo $uname; ?>" readonly/>

<p>Password<span style="color:red">*</span></p>
<input type="password" name="password" id="pwd" value="<?php echo $password; ?>" onkeyup="checkPass(); return false;" required>
<span id="Message" class="confirmMessage"></span>

<p>Re-Type Password<span style="color:red">*</span></p>
<input type="password" name="re_password" id="pwd2" value="<?php echo $password; ?>" onkeyup="checkPass(); return false;" required>
<span id="confirmMessage" class="confirmMessage"></span>
<br><br>
<input type="checkbox" onchange="document.getElementById('pwd').type=this.checked?'text':'password'; document.getElementById('pwd2').type=this.checked?'text':'password'"><h3>Show passwords</h3>

<p>Gender<span style="color:red">*</span></p>
<h4>
<input type="radio" name="gender" value="Male" checked="checked" autocomplete="off">Male<br>
</h4>
<h4>
<input type="radio" name="gender" value="Female"> Female<br>
</h4>
<h4>
<input type="radio" name="gender" value="Other"> Other
</h4>

<p>Phone number<span style="color:red">*</span></p>
<input type="number" name="phone" value="<?php echo $phone; ?>" min="7000000000" max="9999999999" required>  <!--these min & max values correspond to the existing mobile-number conditions only!!-->

<p>About yourself</p>
<textarea name="about" rows="1" cols="60" required><?php echo $about; ?></textarea>

<p>Profile Picture</p>
<h3>
<input type="file" name="newpropic" id="newpropic" accept="image/*">
</h3>
<br><br><br>

<input type="submit" value="Save Changes">
</form>
</div>

<title>
Edit <?php echo $uname; ?>
</title>

</body>
</html>