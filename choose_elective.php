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
		<link rel="stylesheet" type="text/css" href="banner.css">
		<link rel="stylesheet" type="text/css" href="homebar.css">
		<title>Welcome <?php echo $_SESSION['Student_name'];?>
		</title>
	</head>
	<body background="1019286_abstract_orange_tiles_background_.jpg">
		<img class="banner" src="banner.jpg">
		<img class="bannerlow" src="bannerlow.jpg">
		<img class="jiitlogo" src="logo.png">
		
		<p align="right">Welcome  <?php echo $_SESSION['Student_name'];?> <br/>
		<a href="logout.php" align="right">Logout</a></p>
		<br/>
		<?php 
			$con = mysqli_connect('mysql8.000webhost.com', 'a5556259_udbhav', '123456', 'a5556259_uni');
			 if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			 }
			$sid=$_SESSION['username'];
			$q = "select * from student where stu_id='$sid'";
			$r = mysqli_query($con,$q);
			$result = mysqli_fetch_array($r,MYSQLI_ASSOC);
			$yc = $result['elective_check'];
			$sem = $result['sem'];
			//echo $sem;
			$q1 = "select * from course_elective where Sem='$sem'";
			$result2 = mysqli_query($con,$q1);
			$count= mysqli_num_rows($result2);
			
			if($yc==0 || $count=0)
				echo("\t\tThe Subject Selection process is not started or You have already submitted the choice");
			else
				{
			
			?>
			
			<h3 align="center">Instruction</h3>
			<p >
		<h4 align="Center" id="instr" > <li> You will have 2 min to submit your choice.</li></h4>
		<h4 align="Center" id="inst1r"> <li> Be carefull !!! Choice ones submitted cannot be changed under any circumstance.</li></h4>
		<h4 align="Center"id="inst11r"> <li> Do not refresh page !!! Page refresh automatically... </li></h4>
		</p>
			</br><form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
			<div class="wrapper"><input type="submit" value="Next" class="button">	
			</div>
			</form>
			
			<?php
					
				if ($_SERVER["REQUEST_METHOD"] == "POST"){
					$y=mysqli_fetch_array($result2,MYSQLI_ASSOC);
					$e_c=$y['elective_code'];
					$_SESSION['elective_code']=$e_c;
					$q3="select * from semaphore where elective_code='$e_c'";
					$result3=mysqli_query($con,$q3);
					$r = mysqli_fetch_array($result3,MYSQLI_ASSOC);
					
					
						while($r['mutex']==0)
						{
							$q3="select * from semaphore where elective_code='$e_c'";
					$result3=mysqli_query($con,$q3);
					echo("Adding you to waiting Queue\n");
					sleep(5);
					echo("");
					$r = mysqli_fetch_array($result3,MYSQLI_ASSOC);
					
						}
						$u="update Semaphore set mutex=0 where elective_code='$e_c'";
						mysqli_query($con,$u);
						$sno=$r['sno'];
						$c=$r['count'];		
						if($c==0)
						{	
						$sno=$sno+1;
						$u="update Semaphore set count=4 where elective_code='$e_c'";
						$u1="update Semaphore set sno=sno+1 where elective_code='$e_c'";
						mysqli_query($con,$u1);
						}
						else	
						$u="update Semaphore set count=count-1 where elective_code='$e_c'";
						$CGPA=$_SESSION['CGPA'];
						$i="insert into waiting_queue values ('$sno','$sid','$CGPA','$e_c' )";
						mysqli_query($con,$u);
						//echo "check";
						mysqli_query($con,$i);
						$u="update Semaphore set mutex=1 where elective_code='$e_c'";
						mysqli_query($con,$u);
						header("location:waiting.php");
						
					}}
				
			?>
			 
	</body>
</html>