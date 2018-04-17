<?php
$conn = mysqli_connect("localhost","mw2p77l3yc","Kumamoto@12");
if($conn){
//echo("Database :: Connection Successful </br>");
}
else{
die("Error in SQL Connection".mysqli_connect_error($conn));
}
if(mysqli_select_db($conn, 'piwik')){
//echo("Database :: Select Successful </br>".mysqli_connect_error($conn));
}
else{
die("Error Selecting Database ");
}
?>