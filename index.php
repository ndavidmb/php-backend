<?php 
include("./connection.php");
$conn = conectar();

$name="David";
$query = "INSERT INTO paciente(name) VALUES ('$name')";
$res = mysqli_query($conn, $query);
if(!$res) {
	die("Query failed");
}

echo "Saved";
?>
