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
	
	$success_msg='';$title_err="";
	
	
	$id=$_GET['id'];
	$name ; $logo ; $description ; $categoryID;
	
	$sql = "SELECT  * FROM item where id =".$id;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$name=$row['name'];
			$logo=$row['LOGO'];
			$description=$row['description'];
			$categoryID=$row['CategoryID'];
		}
	} 

	$image=$logo;
	

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
	    if($_FILES["image"]["name"] != ""){  
			

			$target_dir = "../pics/";
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			// set image name
			$image=time().".".$imageFileType;
			$filepath = "../pics/" . $image;
			move_uploaded_file($_FILES["image"]["tmp_name"], $filepath);
			
			// delete old image
			 $old_image=$logo;
			 $filepath = "../pics/".$old_image;

			 if (file_exists($filepath)) {
				unlink($filepath);
			 }
		}
        // sql statment
		 $name =$_POST['name'];
		 $description =$_POST['description'];
		 $categoryID =$_POST['category'];

		
         $sql = "update item set name='$name',
							logo='$image',
							description='$description',
							categoryID='$categoryID' where id=".$id;
				

         if ($conn->query($sql) === TRUE) {
             $success_msg = "<span>Record Updated successfully</span>";
         } else {
             $error_msg = "<span>Something went wrong try again later.</span>";
         }

         //$conn->close();
    }

 ?>
 
 <!DOCTYPE HTML>

<html>
<head>
  <meta charset="uft-8">
  <title>Edit activity</title>
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
		<div id="content">
         <h1>Edit activity</h1> <br><br>

		<form  method="post"  enctype="multipart/form-data">

			<p><?php if(!empty($success_msg))echo $success_msg; ?></p>
			<p><?php if(!empty($error_msg))echo $error_msg; ?></p>

			<div>
				<label>Activity name:</label>
				<input required type="text" name="name" value="<?php echo $name;?>">
			</div><br>
			
			<div>
			<img src="<?php echo "../pics/".$image;?>" alt="activity image" width="190"><br>
				<label>Activity picture:</label>
				<input type="file" name="image">
			</div><br>
			
			<div>
				<label>Description</label>
				<textarea name="description" rows="5" ><?php echo $description;?></textarea>
			</div>
			
			<div>
				<label>Category</label>
				 <select name="category">
				    <?php
						$sql= "SELECT  * FROM category";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								if($row['id'] == $categoryID)
									echo "<option selected value=". $row['ID'] . ">". $row['name'] . "</option>";
								else
									echo "<option value=". $row['ID'] . ">". $row['name'] . "</option>";
							}
						} else {
							echo "<option>0 Category ini DB</option>";
						}
						
						$conn->close();
					?>
				 </select>
			</div>
			

			<div class="form-group">
				<input type="submit" class="button"  value="Update Activity">
				<input type="reset" class="button" value="Reset">
			</div>
		</form>
		 
		 
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