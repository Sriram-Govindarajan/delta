<?php

session_start();
mysql_connect("localhost", "root", "") or die("cannot connect");
mysql_select_db("delta")or die("cannot select Database");
$in= $_GET['txt'];
if(!ctype_alnum($in))
{
	exit;
}

if(strlen($in)>0 and strlen($in) <20 )
{
	$sql="select * from mybase WHERE Username like '%$in%' OR Phone like '%$in%' OR Name like '%$in%' OR EMail like '%$in%'";
	$result=mysql_query($sql);
	
	if(mysql_num_rows($result)==0)
		echo " NOT EXISTING"; 
	
	$row=mysql_fetch_array($result);
	echo $row['Username'];
}

?>