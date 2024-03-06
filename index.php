<?php
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
?>
<!DOCTYPE HTML>
<html>

	<head>
	<meta charset="UTF-8">
	<title>HomePage</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
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
	<br><h1>&nbsp;Lets find your adventure..</h1><br>
		<!--How to display image from database using php stack over flow-->	
	    <?php
			$sql = "SELECT * FROM item order by id desc";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			  while($row = $result->fetch_assoc()) {
				echo 	'<div class = "gallery"><a href="item.php?id='.$row['id'].'"><img src="pics/'.$row['LOGO'].'" alt="'.$row['name'].'" ></a>
						<div class="desc">'.$row['name'].'</div>
						</div>';
			 }
			} else {
			  echo "0 results";
			}
			$conn->close();
		
		?>
		
	   </div>
	</div><br>
	
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
