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
	
	
	$success_msg='';$error_msg="";
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
   
	   // 
		$target_dir = "../pics/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // set image name
        $image=time().".".$imageFileType;
        $filepath = "../pics/" . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $filepath);

        // sql statment
		 $name =$_POST['name'];
		 $description =$_POST['description'];
		 $categoryID =$_POST['category'];

		
         $sql = "INSERT INTO item (name, logo , description , categoryID) 
                VALUES ('$name','$image','$description','$categoryID')";
			//echo $sql; exit;
         if ($conn->query($sql) === TRUE) {
             $success_msg = "<span>New activity created successfully</span>";
         } else {
             $error_msg = "<span>Something went wrong try again later.</span>";
         }

         //$conn->close();
    }
 ?>

<!DOCTYPE HTML>
<!--How to Insert Data into a MySQL Database using PHP - W3docs-->	
<html>

	<head>
	<meta charset="UTF-8">
	<title>Add activity</title>
	<link rel="stylesheet" type="text/css" href="../style/style.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body>
    <div id="body">
    <div id="header">
      <div id="logo">
		<img src="../style/logo.png" width="150" height="150" alt="logo of dir">
      </div>
      <div id="menubar">
        <ul id="menu">
          <li ><a href="index.php">Home</a></li>
          <li><a href="about.php">About us</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
	  <div id ="control">
	  <p> Welcome <a class="fa fa-user"></a> <?php echo $_SESSION["username"] ?></p>
	  </div>
    </div>
	
	<div id="PageContent">
      <div id="content" >
         <h1>Add activity</h1> <br><br>
		 
		 	<form  method="post"  enctype="multipart/form-data">

			<p><?php if(!empty($success_msg))echo $success_msg; ?></p>
			<p><?php if(!empty($error_msg))echo $error_msg; ?></p>

			<div>
				<label>Activity name:</label>
				<input required type="text" name="name">
			</div><br>
			
			<div >
				<label>Activity picture:</label>
				<input required  type="file" name="image">
			</div><br>

			<div>
				<label>Description</label>
				<textarea name="description" rows="5"></textarea>
			</div><br>
			
			<div>
				<label>Category</label>
				 <select name="category">
				    <?php
						$sql1 = "SELECT  * FROM category";
						$result = $conn->query($sql1);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo "<option value=". $row['ID'] . ">". $row['name'] . "</option>";
							}
						} else {
							echo "<option>0 Category in DB</option>";
						}
						
					   $conn->close();

					?>
				 </select>
			</div><br>
			
			<div class="form-group">
				<input type="submit" class="button"  value="Add Item">
				<input type="reset" class="button" value="Reset">
					  <a class="button" href="index.php">Back to admin homepage </a>
			</div>	
		</form>


		</div>
    </div>
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