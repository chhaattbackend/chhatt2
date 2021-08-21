<?php
$servername = "localhost";
$username = "u778537867_uat";
$password = "Umairali100";
$dbname = "u778537867_uat";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

for($j=0;$j<=3000;$j++){
$base='923';
$randomNum = substr(str_shuffle("0123456789"), 0, 9);

$completenumber=$base.$randomNum;
// sql to delete a record
$sql = "UPDATE users set phone=".$completenumber.", mobile=".$completenumber." WHERE id=".$j."";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}

}


$conn->close();
?>
