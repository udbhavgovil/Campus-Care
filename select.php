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
			 $ec=$_SESSION['elective_code'];
		$q="select Distinct sub_code from course_elective where elective_code='$ec' ";
		$r=mysqli_query($con,$q);
		?>
		<form name="choice" method="GET" action="submit.php">
		<table align="center" border="3px" class ="table">
		<tr>
		<td>Elective Code</td>
		<td>Course Code</td>
		<td>Course Name</td>
		<td>Credits</td>
		<td>Choice</td>
		</tr>
		<?php
		$i=0;
		while($w = mysqli_fetch_array($r,MYSQL_ASSOC))
		{
			$sc=$w['sub_code'];
			$q="select * from course_elective where sub_code='$sc'";
			$r1=mysqli_query($con,$q);
			
			while($a=mysqli_fetch_array($r1,MYSQL_ASSOC))
			{
			?>
			<tr><td><?php echo $sc;?></td>
			<td><?php echo $a['Course_id'];?></td>
			<td><?php echo $a['Course_name'];?></td>
			<td><?php echo $a['credit'];?></td>
			<td><input type="radio" name="<?php echo $i?>" value="<?php echo $a['Course_id'];?>"readonly></td>
			
			<?php			
			}
			$i++;
		}
		?>
		</table>
		</br></br>
		<div class="wrapper">
		<input name="Add" type="submit" value="Submit" align="center"></td>
		</div>
		</form>
	</body>
</html>