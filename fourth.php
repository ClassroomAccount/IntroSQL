
<!--Do SELECT then read result set field properties -->
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
</style>
</head>
<body>
	<table>
        <?php
// Connect to MySQL, select database
$con = mysqli_connect ( "frodo.bentley.edu", "cs380", "cs380", "cs380" );

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
    exit("Connect Error");
}
    
// Perform SQL query
$query = "SELECT * FROM course;";
$result = mysqli_query($con, $query) or  die('Query failed: ' . mysqli_errno($con));

//process SELECT result set
//field names, data type and length
$finfo = mysqli_fetch_fields($result);
foreach ($finfo as $val) {
	echo " $val->name,  ";
	echo " $val->type,  ";
	echo " $val->length";
	echo "<br>";
}
echo "<br>";

//loop over result set. Print field values for each record
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	
	//inner loop. Print each field value for a record
	foreach ($line as $field_value) {
		echo "$field_value,  ";
	}
	echo "<br>";
}


// close connection
mysqli_close ($con );

?>
 </table>
    </body>
    </html>

