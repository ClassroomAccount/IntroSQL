<?php
//Create a database, create a table, insert data into table, and read back data
//Use database on localhost 

// Connect to MySQL, select database
$con = mysqli_connect("localhost","root","","test");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
    exit("Connect Error");
} else
    echo 'Connected successfully' . '<br>';
    

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


//loop over result set. Print field values for each record
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	
	//inner loop. Print each field value for a record
	foreach ($line as $field_value) {
		echo "$field_value,  ";
	}
	echo "<br>";
}


//close connection
mysqli_close($con);

?>
