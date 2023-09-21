<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(images/login.png);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
								<!-- <div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div> -->
			      	</div>
							<form action="login.php" method="post" class="signin-form" >
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Username</label>
			      			<input type="text" name="username" class="form-control" placeholder="Username" required>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" name="password" class="form-control" placeholder="Password" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" name="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<!-- <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
										</label> -->
									</div>
									<div class="w-50 text-md-right">
										<a href="#">Forgot Password</a>
									</div>
		            </div>
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

  <?php
  session_start();
 
 $Invalid_login = 0 ;

  $conn = mysqli_connect("localhost","root","","cms");
  if(!$conn)
  {
    die("Connection not establish".mysqli_connect_error());
  }
  else
  {
    if(isset($_POST['submit']))
    {
      $name = $_POST['username'];
      $password = $_POST['password'];


	//   $sql="SELECT * FROM semlist where status is active ";
	//   $res=mysqli_query($conn,$sql);
	//   $row = mysqli_fetch_assoc($res);

	//   $_SESSION("semname=$row");

        //Fetch database data
      $sql = "SELECT * FROM admin_login";
      $result = mysqli_query($conn,$sql);
     
      // Store database data in variable 
    
     while($row = mysqli_fetch_assoc($result)){

      if($name == $row['user'] && $password == $row['pass'])
      {
		// $_SESSION['teachercode'] = $row['teachercode'];
        $_SESSION['username'] = $row['user'];
        $_SESSION['password'] = $row['pass'];
		// $sql = "SELECT * FROM semlist WHERE `status` = 'active'";
		// $res = mysqli_query($conn, $sql);
		// $row = mysqli_fetch_assoc($res);
		// $semname = $row['semname'];
		// $_SESSION['semname'] = $semname;
        header('Location: ../Admin\html\addsem.php');
      }
      else{
        $Invalid_login = 1;
      }
    }

    if($Invalid_login == 1)
      { 
        echo '<script type ="text/JavaScript">';  
        echo 'alert("Invalid Login...")';  
        echo '</script>';
      }
	  else{
		echo '<script type ="text/JavaScript">';  
        echo 'alert("Login Successfull...")';  
        echo '</script>';
	  }
    }
  }

  mysqli_close($conn);

  ?>

	</body>
</html>

