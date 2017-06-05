<?php

require_once '../login.php';

// Accesses the login information to connect to the MySQL server using your credentials and database
$db_server = mysql_connect($host, $username, $password);
// This provides the error message that will appear if your credentials or database are invalid
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
        
mysql_select_db("accounts")
or die("Unable to select database: " . mysql_error());
        
$id = $_GET['val'];        
        

$query = "DELETE FROM information WHERE id=" . $id;

$result = mysql_query($query);

echo "
<script>
    loadval();
</script>
"

?>