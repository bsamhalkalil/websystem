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

//codeshack Review System with PHP, MySQL, and AJAX

$item_id=$_POST['item_id'];
$name=$_POST['name'];
$body=$_POST['body'];
$rating=$_POST['rating'];

$sql = "INSERT INTO `review` ( `item_id`, `name`, `body`, `rating`) 
        VALUES ( '$item_id', '$name', '$body', '$rating');";

if ($conn->query($sql) === TRUE) {
  echo "New record inserted successfully";
	header("Location: item.php?id=".$item_id."&msg=ok");
	die();
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>