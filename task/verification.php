
<!DOCTYPE html>

<html>
<head>
	<title>Email Verifcation</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link href='https://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
		<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
		<!-- js script version 2.2.4 online link-->
		<script src="js/bootstrap.js"></script>
  		<script src="js/bootstrap.min.js"></script>
  		<script src ="js/script.js"></script>
</head>
<body>
<?php 
if (!isset($_GET['code']))
{
	?>
<div class="verifybox">
<form name="verify" action= "<?php echo $_SERVER['PHP_SELF']; ?> " method="GET">
<div class="form-group">
<label >Email</label>
<input type="email" name="email" class="form-control"  placeholder="Email">
</div>
<div class="form-group">
<label >OTP</label>
<input type="number" name="code" class="form-control"  placeholder="OTP">
</div>
<input type="submit" value ="Verify" class="btn btn-success">
</form>
</div>
<?php
}

if (isset($_GET['code']))
{
	$server="localhost";
	$user="root";
	$pass="";
	$db="task";
	$con = mysqli_connect($server,$user,$pass,$db);
	if (mysqli_connect_errno())
	echo"Couldnot Connect to Server!!!";
    $email = $_GET['email'];
    $code = $_GET['code'];
    $query = "select * from temporary_acc where email = '$email'";
    $result = mysqli_query($con,$query);
    $code_db = mysqli_fetch_array($result);
    if ($code == $code_db['code'])
    {
 
		$domain = $code_db['domain'];
		$pwd = $code_db['pass'];
		$fname = $code_db['fname'];
		$lname = $code_db['lname'];
		$query = "insert into user values ('$fname','$lname','$email','$pwd','$domain')";
		mysqli_query($con,$query);
    	$query = "delete from temporary_acc where email = '$emial'";
    	mysqli_query($con,$query);
    	echo "<script> alert('Congratulations Your Email is Verified');
    	window.location.assign('index.html');
    	</script>";
    	//header('location:index.html');
    }
    else
    	echo "<script> alert('Wrong Code!!!'')</script>";

}
?>
</body>
</html>
