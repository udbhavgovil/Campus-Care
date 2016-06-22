<?php
	// Check if session is not registered, redirect back to main page. 
	session_start();
	if(!isset($_SESSION['username'])) {
		header("location:index.php");
	}
?>

<html>
	<head>
		<link href="style.css" rel="stylesheet" type="text/css">
		<title>Welcome <?php echo $_SESSION['Student_name'];?>
		</title>
		<link rel="stylesheet" type="text/css" href="banner.css">
		<link rel="stylesheet" type="text/css" href="gallerystylesheet.css">
		<link rel="stylesheet" type="text/css" href="homebar.css">
	</head>
	<body bgcolor="AAEEFF" onload="setInterval(change_color ,3000)">
		<img class="banner" src="banner.jpg">
		<img class="bannerlow" src="bannerlow.jpg">
		<img class="jiitlogo" src="logo.png">
		<p align="right">Welcome  <?php echo $_SESSION['Student_name'];?> <br/>
		<a href="logout.php" align="right">Logout</a></p>
		<?php
		$con = mysqli_connect('mysql8.000webhost.com', 'a5556259_udbhav', '123456', 'a5556259_uni');
			 if (mysqli_connect_errno()) 
			 {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			 }
		$ec=$_SESSION['elective_code'];
		$q1="select * from waiting_queue where elective_code='$ec' order by sno, CGPA desc";
		$r=mysqli_query($con,$q1);
		$y=mysqli_fetch_array($r);
		if ($y['stu_id']==$_SESSION['username'])
		{	$_SESSION['check']=0;
			header('location:select.php');}
		else
		{
			?>
			<h4 align="Center" >You are in waiting Queue </h4>
			<h4 align="Center" >Do not refresh !!! </h4>
		<?php	$s=30;
			header("Refresh: $s; url=waiting.php");
			
			
		}
		?>
	</body>
</html>