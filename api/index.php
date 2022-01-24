<?php
// Create connection
$conn = mysqli_connect("localhost","id17762561_root","9(Jp1lvf(*p=hBS[","id17762561_datastore");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>