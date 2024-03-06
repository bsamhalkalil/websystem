<?php
	session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
	if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
	  header("location: ../login.php");
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
 ?>

<!DOCTYPE HTML>
<html>

	<head>
	<meta charset="UTF-8">
	<title>Welcome admin</title>
	<link rel="stylesheet" type="text/css" href="../style/style.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body>
	<div id="body">
    <div id="header">
      <div id="logo">
	  <img src="../style/logo.png"  width="150" height="150" alt="logo of dir">
      </div>
	  
      <div id="menubar">
        <ul id="menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About us</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
	  
	  <div id ="control">
	  <p> Welcome <a class="fa fa-user"></a> <?php echo $_SESSION["username"] ?></p>
	  </div>
	  
    </div>
	
	<div id="PageContent">
      <div id="content">
	    <br><h2><a class="fa fa-gear"></a>Admin Access</h2> 
	    <br><br><h1 style = "text-align:center;"> Welcome to control panel .. <?php echo $_SESSION["username"] ?></h1><br><br>
		<h2 style = "text-align:center;">Add activity<a href="Additems.php"> ></a></h2><br>
		<h2 style = "text-align:center;">&nbsp;&nbsp;Delete activity<a href="deleteitems.php"> ></a></h2><br>
		<h2 style = "text-align:center;">Edit activity<a href="edititems.php"> ></a></h2><br><br><br>
         <h1 style = "text-align:center;">Current activites</h1> 
		 <br><br>
		<table class="table table-bordered">
        <thead>
        <tr>
            <th>Activity ID</th>
            <th>Name</th>
            <th>Logo</th>
			<th>Description	</th>
            <th>Category ID</th>
        </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT  * FROM item ORDER BY id ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                    <td>". $row['id'] . "</td>
                                    <td>". $row['name'] . "</td>
                                    <td> <img style='width: 100px;' src='../pics/".$row['LOGO']."' /> </td>
                                    <td>". $row['description']."</td>
									<td>". $row['CategoryID']."</td>
                              </tr>";
                    }
                } else {
                    echo "0 results";
                }

                $conn->close();
            ?>
        </tbody>
    </table>
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
