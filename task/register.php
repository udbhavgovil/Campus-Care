<?php

if (isset($_POST['email'])==0)
	header('location:index.html');
	else
	{
$server="localhost";
$user="root";
$pass="";
$db="task";
$con = mysqli_connect($server,$user,$pass,$db);
if (mysqli_connect_errno())
echo"Couldnot Connect to Server!!!";

else {

	$email = $_POST['email'];
	$domain = $_POST['domain'];
	$pwd = $_POST['pass'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$code = rand()%1000000;
		// echo $fname;
		// echo $lname;
		// echo $email;
		// echo $domain;
		// echo $pwd;
		// echo $code;
		// $query = "select * from user";
		// $r =mysqli_query($con,$query);
		// $r1 = mysqli_fetch_array($r);
		// echo $r1['email'];
		// echo $r1['pass'];
	$query = "insert into temporary_acc values ('$fname','$lname','$email','$domain','$pwd','$code') ";
	mysqli_query($con,$query);

	$sub = "Email Verification";
	$msg = "Your OTP is " + $code ;
	$headers = 'From:udbhavgovil@gmail.com' . '\r\n';
	mail($email, $sub, $msg, $headers); 
	echo "<script>alert('A code is sent to your email enter it next step to confirm your email...');
	window.location.assign('verification.php');
	</script>";
	//header ('location:verification.php');


	
}
}
?>