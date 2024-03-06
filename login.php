<?php

	session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	  header("location: AdminPages/index.php");
	  exit;
	}
 
// connect to dataBase
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "webproject";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	} 
	 
// Define variables and initialize with empty values
	$username = $password = "";
	$username_err = $password_err = "";
 
// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		if(empty($username_err) && empty($password_err)) {
			// Prepare a select statement
			$sql = "SELECT * FROM admin WHERE username = '$username' ";

			$result = $conn->query($sql);


			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$saved_password = $row['password'];

				if ($password === $saved_password) {
					// Store data in session variables
					$_SESSION["loggedin"] = true;
					$_SESSION["id"] = $id;
					$_SESSION["username"] = $username;

					// Redirect user to welcome page
					header("location: AdminPages/index.php");
				} else {
					// Display an error message if password is not valid
					$password_err = "The password you entered was not valid.";
				}
			} else {
				$username_err = "No account found with that username.";
			}
		}

		// Close connection
		$conn->close();
	}
?>

<!DOCTYPE HTML>
<html>

	<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style/style.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	<body>
	<div id="body">
    <div id="header">
      <div id="logo">
		<img src="style/logo.png" width="150" height="150" alt="logo of dir">
      </div>
	  
      <div id="menubar">
        <ul id="menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About us</a></li>
		  <li><a href="login.php">Log-in</a></li>
        </ul>
      </div>
    </div>
	
	<div id="PageContent">
      <div id="content">
		<br><br><h1>Login</h1><br><br>
	
		 <form method="post" action="login.php">
			  <label>username:</label><br>
			  <input required type="text"  name="username" placeholder="your username"/><br>
			   <p><?php echo $username_err; ?></p>
	
			   <br><label>password:</label><br>
			  <input required type="password" name="password"/><br>
			   <p><?php echo $password_err; ?></p><br><br><br>
			
		   <input class="button" type="submit" value="Submit"/>
		   <input class="button" type="Reset" value="Clear"/><br>

		 </form>
		
	   </div>
    </div>
	<br>
    <div id="footer">
      <p>
	  &nbsp; Contact us 
	  <a href="tel:6031112298" class="fa fa-phone"></a>
	  <a href="https://twitter.com/login" class="fa fa-twitter"></a>
	  <a href="https://www.instagram.com/" class="fa fa-instagram"></a>
	   &nbsp;&nbsp;&nbsp;&nbsp; &copy; 2023 Gather Out. Made in Saudi.
	  </p>
	   </div>
    </div>
</body>
</html>