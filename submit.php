<?php
	// Check if session is not registered, redirect back to main page. 
	session_start();
	if(!isset($_SESSION['username'])) {
		header("location:index.php");
	}
		else if(!isset($_SESSION['check']))
			header('location:student_main.php');
?>

<html>
	<head>
		
		<title>Welcome <?php echo $_SESSION['Student_name'];?>
		</title>
		<link rel="stylesheet" type="text/css" href="banner.css">
		
		<link href="style.css" rel="stylesheet" type="text/css">
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
		$i=0;
		$t='reg_subject';
		$sid=$_SESSION['username'];
		$e="UPDATE student set elective_check=0 where stu_id='$sid'";
		mysqli_query($con,$e);
		while(isset($_GET[$i]))
		{
			$cid=$_GET[$i];
			$q = "UPDATE course_elective set seats = seats-1 where Course_id='$cid'";
			mysqli_query($con,$q);
			$q="insert into reg_subject values ('$sid','$cid')";
			mysqli_query($con,$q);
			$i++;
			
		}
		$w="delete from waiting_queue where stu_id='$sid'";
		mysqli_query($con,$w);
		?>
		<h4 align="center" >Subject Register</h4>             //  151839
		<table align="center" border="2px" class ="table">  //Kunjan31%
		<tr><td>Course Id</td>
			<td>Course Name</td>
		</tr>
		<?php
		
		$q="select * from reg_subject where Stu_id='$sid'";
		$r= mysqli_query($con,$q);
		while($l= mysqli_fetch_array($r,MYSQL_ASSOC))
		{
			$a=$l['Course_name'];
			$e="select * from course_elective where course_id='$a'";
			$z=mysqli_query($con,$e);
			$q=mysqli_fetch_array($z,MYSQL_ASSOC);
			
		?>
		<tr><td><?php echo $q['Course_id']?></td><td><?php echo $q['Course_name']?></td></tr>
		<?php
		}
		session_unset();
		session_destroy();
		?>
		</table>
		<div class="wrapper">
			<a href="teacher.php"> <input class="button" name="newThread" type="button" value="Next" align="center" action='logut.php'></a>
		</div>
		
	</body>
</html>