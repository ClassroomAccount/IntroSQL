<?php
// This example uses SQL to find the tables in a database,
// and then describe each of the tables.

// Connect to MySQL, select database
$con = mysqli_connect ( "frodo.bentley.edu", "cs380", "cs380", "cs380" );

// Check connection
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
    exit("Connect Error");
} else
    echo 'Connected successfully' . '<br>';
    

// show tables in database
$statement = "SHOW TABLES;";
$result = mysqli_query ( $con, $statement ) or die ( 'create database failed: ' . mysqli_errno ( $con ) );

$finfo = mysqli_fetch_fields ( $result );
foreach ( $finfo as $val ) {
	echo " $val->name:  ";
}
echo "<br>";

// create an array to store each table name
$tables = array ();

// loop over result set. Print field values for each record
while ( $line = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
	
	// inner loop. Print each field value for a record
	foreach ( $line as $table_name ) {
		array_push ($tables, $table_name );  //save table name in array
		echo "$table_name";
	}
	echo "<br>";
}

//iterate over $tables array
for($i = 0; $i < sizeof ( $tables ); $i ++) {
	echo $tables [$i] . "<br>";
	
	//get info about table
	$statement = "DESCRIBE " . $tables [$i] . ";";
	$result = mysqli_query ( $con, $statement ) or die ( 'describe database failed: ' . mysqli_errno ( $con ) );
	
	// loop over result set. Print description of each table field
	while ( $line = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		
		//Print each field description
		foreach ( $line as $table_name ) {
			echo "$table_name,  ";
		}
		echo "<br>";
	}
	echo "<br><br><br>";
} // end for
  
// close connection
mysqli_close ( $con );

?>