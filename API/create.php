<?php
//accept any request from any where
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//allow only POST method for any request to this file
header('Access-Control-Allow-Methods : POST');

// get the data from the body of the post request 
// then convert it to json 
$post = json_decode(file_get_contents('php://input', false, $context));

$title = $post['ip'];
$price = $post['date'];

//Database connection configuration 
$DB_USER  = "user";
$DB_PASSWORD = "password";
$DB_DATABASE = "database";
$DB_SERVER = "server";

$con = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASSWORD ,$DB_DATABASE) or die(mysqli_connect_error());

$result = mysqli_query($con,"INSERT INTO products (ip, date) 
                             VALUES('$ip','$date')");
mysqli_close($con);    

//The Response
if ($result)   
    {
    header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
    echo json_encode(array('massage' => 'record inserted', 'message' => 'Success'));
    
    }
else 
    {
    header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');

    echo json_encode(array('massage' => 'record not inserted', 'message' => 'Failed'));
    }
