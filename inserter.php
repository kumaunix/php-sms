<?
session_start();
require 'dbconnect.php';
$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$message = $_POST['message'];
$conv_id = $_POST['conv_id'];
//$view = $_POST['view'];
$time_send = $_POST['time'];
$filename = $_POST['file'];


$data =("INSERT INTO sms (`sender`, `receiver`, `message`, `conv_id`, `view`, `time`,`file`) VALUES('$sender','$receiver', '$message','$conv_id', 'Unseen', '$time_send','$filename') ");
$sql = mysqli_query($conn, $data)or die ("ERROR :".mysqli_error($conn));
/*echo '<meta http-equiv="refresh" content="0.2" >';*/


?>