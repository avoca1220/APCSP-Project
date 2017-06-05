<?php
    
require_once '../login.php';

// Accesses the login information to connect to the MySQL server using your credentials and database
$db_server = mysql_connect($host, $username, $password);
// This provides the error message that will appear if your credentials or database are invalid
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
        
mysql_select_db("accounts")
or die("Unable to select database: " . mysql_error());
        
$id = $_GET['val'];        
        

$query = "SELECT * FROM information";

if ($id == "id"){
    $query .= " ORDER BY id";
} elseif ($id == "name"){
    $query .= " ORDER BY lastname";
} elseif ($id == "company"){
    $query .= " ORDER BY company";
}


$result = mysql_query($query);


echo "<table class='record_table' width=100%><tr><th>First Name</th><th>Last Name</th><th>Company</th><th>Email</th><th>Phone</th><th>Website</th><th>Customer ID</th></tr>";

//iterate over all the rows

$count = 1;

echo "
<script>
    $(document).ready(function(){
        $('.record_table tr').click(function(event) {
            $(':checkbox', this).trigger('click');
        });
    });
    
    function checkChecked(checkbox){
        
        idnum = checkbox.id.substring(8);
        
        table = document.getElementById('table' + idnum);
            
        if (checkbox.checked){
        
            table.className = 'selected';
        }
        else{
            
            table.className = 'not-selected';
        }
    };
    
    function deleteVals(){
        tables = document.getElementsByClassName('selected');
        
        
        for(i=0; i<tables.length; i++){
            numid = tables[i].id.substring(5);
            id = document.getElementById('id'+numid);
            accountId = id.getAttribute('data')
            
            $('#placeHolder').load('delete.php?val=' + accountId);
            
        }
    }
</script>   
";


while($row = mysql_fetch_assoc($result)){
    //iterate over all the fields
    echo "<tr id='table" . $count . "'>";
    echo "<td>" . $row['firstname'] . "</td>";
    echo "<td>" . $row['lastname'] . "</td>";
    echo "<td>" . $row['company'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['phone'] . "</td>";
    echo "<td>" . $row['url'] . "</td>";
    echo "<td id='id" . $count . "' data='" . $row['id'] . "'>" . $row['id'] . "</td>";
    echo "<td class='trigger'><input id = checkbox" . $count . " type='checkbox' onclick='checkChecked(this)'/></td>";
    echo "</tr>";
    
    echo "
    <script>
        
        elements = document.getElementsByClassName('trigger');
        
        elements[$count - 1].style.display = 'none';
            
            

        
    </script>
";
    
    $count = $count + 1;
}

echo "</table>";

?>