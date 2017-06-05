<?php

require_once '../login.php';


// Accesses the login information to connect to the MySQL server using your credentials and database
$db_server = mysql_connect($host, $username, $password);
// This provides the error message that will appear if your credentials or database are invalid
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db("accounts")
	or die("Unable to select database: " . mysql_error());
	
// Store the query string from 2.2.3.A Step 17

$firstname = $_POST['message']['First'];

$lastname = $_POST['message']['Last'];

$company = $_POST['message']['Company'];

$email = $_POST['fromEmail'];

$phone = $_POST['message']['Phone'];

$url = $_POST['message']['Website'];

$help = $_POST['message']['Message'];

$create = "INSERT INTO information(firstname, lastname, company, email, phone, url, help) VALUES('" . $firstname . "', '" . $lastname . "', '" . $company . "', '" . $email . "', '" . $phone . "', '" . $url . "', '" . $help . "')";

mysql_query($create);


header('Location: index.html#anchorline');

?>