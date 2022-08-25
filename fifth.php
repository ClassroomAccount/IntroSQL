<!--  this time we want result set values in a table  -->
<!DOCTYPE html>
<html>
<head>
<style>
td {
	background-color: yellow;
	color: red;
	border:1px solid blue;
	padding:5px;
}

table {margin-left:auto; margin-right:auto;}

th {color:green;}
</style>
</head>
<body>
	<table>

<?php
//Put it all together
//Create a database, create a table, insert data into table, and read back data
//Use database on localhost 
//Output records as html table rows

$NetAddress = "localhost";

// Connect to MySQL, select database
$con = mysqli_connect($NetAddress,"root","","test");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
    exit("Connect Error");
}

//delete database if there
$statement = "DROP DATABASE IF EXISTS CS380Store;";
mysqli_query($con, $statement) or die('drop database failed: '.mysqli_errno($con));

//create database and table
$statement = "CREATE DATABASE CS380Store;";
mysqli_query($con, $statement) or die('create database failed: '.mysqli_errno($con));

//select CS380Store as database in use
$statement = "USE CS380Store;";
mysqli_query($con, $statement) or die('use database failed: '.mysqli_errno($con));

//create a customer table
$statement = "CREATE TABLE customer(customerID INTEGER, firstname VARCHAR(20), lastname VARCHAR(25), 
                       age INTEGER, PRIMARY KEY(customerID));";
mysqli_query($con, $statement) or die('create table failed: '.mysqli_errno($con));

//insert data
$statement = "INSERT INTO customer VALUES (1, 'Joe', 'Deploy', 22),
                                          (4, 'Harry', 'Bentley', 99),
                                          (7, 'Alice', 'Cooper', 44);";
mysqli_query($con, $statement) or die('insert failed: '.mysqli_errno($con));
                                          

// Perform SQL query to see what's in table
$query = "SELECT * FROM customer;";
$result = mysqli_query($con, $query) or  die('Query failed: ' . mysqli_errno($con));

//process SELECT result set
//first, field names
$finfo = mysqli_fetch_fields($result);
echo "<tr>";
foreach ($finfo as $val) {	
	echo "<th> $val->name</th>  ";
}
echo "</tr>";

//loop over result set. Print field values for each record
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	echo "<tr>";
	//inner loop. Print each field value for a record
	foreach ($line as $field_value) {
		echo "<td> $field_value </td>  ";
	}
	echo "</tr>";
	
}

//close connection
mysqli_close($con);

?>

   </table>
</body>
</html>
