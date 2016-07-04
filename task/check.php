<?php
$server="localhost";
$user="root";
$pass="";
$db="task";
$con = mysqli_connect($server,$user,$pass,$db);
if (mysqli_connect_errno())
echo"Couldnot Connect to Server!!!";
else
{
	
	$domain = $_POST["domain"];
	$email = $_POST['email'];
	$pwrd = $_POST['pass'];
	$query = "select * from user where email='$email' and pass='$pwrd' and domain ='$domain'";
	$result = mysqli_query($con,$query);
	$count = mysqli_fetch_array($result,MYSQL_ASSOC);
	if (mysqli_num_rows($result)==0)
	{
		echo "<script> alert('Wrong Password or Email'); 
		window.location.assign('index.html');
		</script>" ;

	}
	else

	{
		
		echo "<script>alert('Congratulations you are in to the next round')
		window.location.assign('index.html');
		</script>";
	}	

}
?>