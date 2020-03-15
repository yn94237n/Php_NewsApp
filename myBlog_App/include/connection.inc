<?php
	
	


	#set up link to the database server
	
	#$conn = @mysql_connect("localhost","root","") or die ("Sorry -- could not connect to db");
	
	#select the database to work on
	

$servername = 'localhost';

$user = 'root';
$pass = '';

$dbname = 'myblog_app_db';


$conn = new mysqli($servername, $user, $pass, $dbname) or die("Could not connect: ");


#echo "Connected successfully";

#$rs = @mysqli_select_db($conn, $dbname) or die("Sorry - cannot find the database"); 

if(mysqli_connect_errno($conn))
{
    echo "Failed to connect";
}
																	
?>