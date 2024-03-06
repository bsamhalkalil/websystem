<?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "webproject";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="UTF-8">
	<title>Activity Page</title>
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
		<h2>Escape your routine with us</h2>
		<?php
			$id=$_GET['id'];
			if($id=="") header("location: index.php");
			
			$sql = "SELECT * FROM item where id=".$id;
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
	
			  while($row = $result->fetch_assoc()) {
				echo '<h1>'.$row['name'].'</h1><br><img width="520" src="pics/'.$row['LOGO'].'"/><h3>&nbsp;About this activity<br><a class="fa fa-calendar"></a>1/1/2023<br><a class="fa fa-hourglass"></a>8:30AM<br><a class="fa fa-crosshairs"></a>Riyadh<br></h3><br><br>
					  <p>'.$row['description'].'</p>
					';
			 }
			} else {
			  echo "0 results";
			}
		
		?>
		
		<br><br><br><br>
		<!-- CodePen 5-star Rating Calculation -->
		<?php
				$sql = "SELECT SUM(rating) as sum, COUNT(rating) as count FROM review where item_id=".$id;
				$totoal_review=0;
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				 $result = $result->fetch_assoc() ;
				  if($result['count'] > 0)
			     $totoal_review=ceil($result['sum']/$result['count']);
				}
		?>		
		<p><strong>Customer reviews</strong></p>
		<p>Overall rating<a class="fa fa-users"></a></p>
		 <div class="rate">
			<input <?php if($totoal_review == "5") echo"checked"; ?> type="radio" id="star5" name="rate" value="5" />
			<label for="star5" title="text">5 stars</label>
			<input <?php if($totoal_review == "4") echo"checked"; ?>  type="radio" id="star4" name="rate" value="4" />
			<label for="star4" title="text">4 stars</label>
			<input <?php if($totoal_review == "3") echo"checked"; ?> type="radio" id="star3" name="rate" value="3" />
			<label for="star3" title="text">3 stars</label>
			<input <?php if($totoal_review == "2") echo"checked"; ?>  type="radio" id="star2" name="rate" value="2" />
			<label for="star2" title="text">2 stars</label>
			<input <?php if($totoal_review == "1") echo"checked"; ?>  type="radio" id="star1" name="rate" value="1" />
			<label for="star1" title="text">1 star</label>
		  </div><br><br><br>
			<div id = "revtable">
		    <table>
			<?php
				$sql = "SELECT * FROM review where item_id=".$id;
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				  while($row = $result->fetch_assoc()) {
					echo '<tr>
							   <th width="100">Reviewer name:</th>
							   <td>'.$row['name'].'</td>
						   </tr>
						   <tr>
							   <th>What reviewer said about the place</th>
							   <td>'.$row['body'].'</td>
						   </tr>
							<tr>
							   <th>Reviewer rate this place:</th>
							   <td>'.$row['rating'].'</td>
						   </tr>
						   <tr><td colspan="2" style="border-color:#a0ab81;"></td></tr>
						   ';
				 }
				} else {
				  echo "0 results";
				}
				$conn->close();
			?>
			</table><br><br><br></div>
		
		
		<h2>Write your review</h2><br>
		<form method="post" action="itemreview.php">
		<input type="hidden" name="item_id" value="<?php echo $id;?>">
		<div>
		<label>Name</label>
		<input required type="text" name="name"  placeholder="Enter your name.." class="form-control">
		</div>
		<div>
		<label>Review</label>
		<textarea name="body" placeholder="Enter your review.." cols=110 rows=5></textarea>
		</div>
		<div>
		<label>Rating</label>
		<select name="rating">
		<option value="1">5/1</option>
		<option value="2">5/2</option>
		<option value="3">5/3</option>
		<option value="4">5/4</option>
		<option value="5">5/5</option>
		</select>
		</div>
		<p>
		<input class="button" type="submit" value="send"/>
	    </p>
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
