<?php
session_start();
require 'dbconnect.php';
if(!isset($_SESSION['token']))
{
 $redirec_url = "url_here.php";	
 header("Location: $redirec_url");	
}

	
?>
<html>
<head>
	<title>Compose Mail | <?php echo $_SESSION['lname']; ?>, &nbsp;<?php echo $_SESSION['fname'];?></title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/compose.css">

</head>	
<body>
<center>
<br /><br />
<?php



if (empty($_POST['act1'])){
?>

<a href="index.php"><button>Return to Inbox</button></a>
</center>
<form action="" method="post">
<ul class="form-style-1">
   
    
    <li>
        <label>To<span class="required">*</span></label>
        <select name="rec" class="field-select" required="">
        <option></option>
 <?php
$sql = ("SELECT email, gname, lname, dept FROM users WHERE id!='".$_SESSION['id']."' ");
$mysql = mysqli_query($conn, $sql) or die ("SELECT COMPOSE".mysqli_error($conn));
while ($row = mysqli_fetch_array($mysql)){
	$rec = $row['gname'];
	$recv = $row['lname'];
	$email = $row['email'];
	$dept = $row['dept'];
	echo "<option value='$email' >$rec $recv - $dept</option>";
}
?>	       
        </select>
    </li>
    <li>
        <label>Subject <span class="required">*</span></label>
        <input type="text" name="subject" class="field-long" />
    </li>
    <li>
        <label>Your Message <span class="required">*</span></label>
        <textarea name="rep" id="field5" class="field-long field-textarea"></textarea>
    </li>
    <li>
    	<input type="hidden" name="act1" value="run"/>
        <input type="submit" value="Send" />
        <input type="reset" value="Clear" />
    </li>
</ul>
</form>

<?php
}else if (!empty($_POST['act1'])){
$start_button = $_POST['act1'];
$to = $_POST['rec'];


$time = date_default_timezone_get();
$time_send = date('Y-m-d-H:i:s',strtotime($time));

$subject = $_POST['subject'];
$reply = $_POST['rep'];
$sender = $_SESSION['mail'];
$conv_id = $sender.$time_send.$to;
$data =("INSERT INTO sms (`sender`, `receiver`, `subject`, `message`, `time`,`conv_id`, `view`) VALUES('$sender','$to', '$subject','$reply','$time_send', '$conv_id','Unseen'  ) ");
$sql = mysqli_query($conn, $data)or die ("ERROR :".mysqli_error($conn));

$url='index.php';
   echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
   echo " <center> Sending Message to $to. . .</center> ";
}
//mysqli_close($conn);

?>

	
</body>		
</html>
