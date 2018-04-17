<?
$conn = mysqli_connect("host","username","password");
if($conn){
//echo("Database :: Connection Successful </br>");
}
else{
die("Error in SQL Connection".mysqli_connect_error($conn));
}
if(mysqli_select_db($conn, 'db_name')){
//echo("Database :: Select Successful </br>".mysqli_connect_error($conn));
}
else{
die("Error Selecting Database ");
}
?>
