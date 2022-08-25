<?php
//drop table if exists, create table, drop table

// Connect to MySQL, select database
$con = mysqli_connect("frodo.bentley.edu","cs380","cs380","cs380");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
    exit("Connect Error");
} else
    echo 'Connected successfully' . '<br>';
    
    //delete table if there
    $statement = "DROP TABLE IF EXISTS customer;";
    mysqli_query($con, $statement) or die('drop database failed: '.mysqli_errno($con));
    
    //create a customer table
    $statement = "CREATE TABLE customer(customerID INTEGER, firstname VARCHAR(20), lastname VARCHAR(25),
                       age INTEGER, PRIMARY KEY(customerID));";
    mysqli_query($con, $statement) or die('create table failed: '.mysqli_errno($con));
    
    //do something to table
    
    //delete table
    $statement = "DROP TABLE customer;";
    mysqli_query($con, $statement) or die('drop database failed: '.mysqli_errno($con));
    
    echo "Successful!";

    mysqli_close ($con);
?>