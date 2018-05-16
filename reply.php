<?php
session_start();
require 'dbconnect.php';
if(!isset($_SESSION['token']))
{
 header("Location: ../unix/index.php");	
}
if (!empty($_POST['act1'])){

	$start_button = $_POST['act1'];	
	$myfile = $_POST['myFile'];
	$sender = $_SESSION['mail'];
	$receiver = $_GET['send'];
	$reply = $_POST['textarea'];
	$conv_id = $_GET['conv_id'];
	$time_now = date_default_timezone_get();
	$time_send = date('Y-m-d H:i:s',strtotime($time_now));
//////////////////////////////////////////////////////
$name= $_FILES['myFile']['name'];
$tmp_name= $_FILES['myFile']['tmp_name'];
$submitbutton= $_POST['submit'];
$position= strpos($name, "."); 
$fileextension= substr($name, $position + 1);
$fileextension= strtolower($fileextension);

if (isset($name)) {
$path= 'attachments/';
if (!empty($name)){
if (move_uploaded_file($tmp_name, $path.$name)) {
//echo 'Uploaded!';
}
}
}

///////////////////////////////////////////////////////
$data =("INSERT INTO sms (`sender`, `receiver`, `message`, `conv_id`, `view`, `time`,`file`) VALUES('$sender','$receiver', '$reply','$conv_id', 'Unseen', '$time_send','$name') ");
$sql = mysqli_query($conn, $data)or die ("ERROR :".mysqli_error($conn));
//echo '<meta http-equiv="refresh" content="0.2" >';
//echo " <center> Sending Message to $receiver. . .</center> ";
}





//if (empty($_POST['act1']))	
	$person_email = $_GET['send'];
	
	$view = ("Select * from sms where view='Unseen' and conv_id='".$_GET['conv_id']."' and receiver='".$_SESSION['mail']."'");
	$view_query = mysqli_query($conn, $view) or die ("Query for View check :".mysqli_error($conn));
	//$display = mysqli_fetch_assoc($view_query);
	$row_view_affected = mysqli_num_rows($view_query);
	if ($row_view_affected > 0){
		$time = date_default_timezone_get();
		$time_seen = date('Y-m-d-H:i:s',strtotime($time));
		$view_update = ("UPDATE sms SET view='Seen', view_time='".$time_seen."'  where conv_id='".$_GET['conv_id']."' and receiver='".$_SESSION['mail']."' and view='Unseen' ");
		$update_view = mysqli_query($conn, $view_update) or die ("Error updating view :".mysqli_error($conn));
	}else{}

if($_SESSION['mail']!=$_GET['send']){
	$sender_name = $_GET['sendername'];	 
}else{
	$name_sql = ("Select sms.receiver, sms.id, users.lname,users.gname from sms INNER JOIN users On sms.receiver=users.email where sms.id='".$_GET['id']."'  ");
	$name_query = mysqli_query($conn, $name_sql) or die ("error for selecting receiver name :".mysqli_error($conn));
	$name_display = mysqli_fetch_assoc($name_query);
	$sender_name = $name_display['gname'].' '.$name_display['lname'];
}
$subj = $_GET['subject'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<title>Reply Mail | UNIX Mailroom</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="../style.css">
	<link rel="javascript/text" href="js/form.js" />
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
 <?php
 if (isset($_SESSION['user'])) {
	 echo sprintf("_paq.push(['setUserId', '%s']);", $_SESSION['mail']); 
}?>
  _paq.push(['setCustomUrl', '#url#']);
  _paq.push(['seDocumentTitle', '#title#']);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//unx.co.jp/piwik/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<script>
	function func(a) {
    var el;
    if(a === 1) {
        el = document.getElementById("order");
    }
    if(a === 2) {
        el = document.getElementById("retrieve");
    }
    el.style.display = el.style.display === "none" ? "block" : "none";
}

function showValue() {
    document.getElementById('range').innerHTML = this.value;
}

document.getElementById('f1').onclick = function () {
    func(1);
};
document.getElementById('f2').onclick = function() {
    func(2);
};

(function () {
    var inputs = document.getElementsByTagName('input'),
        i, l = inputs.length;
    for (i = 0; i < l; i += 1) {
        if (inputs[i].getAttribute('type') === 'range') {
            inputs[i].onclick = showValue;
        }
    }
}());
</script>	
<!-- End Piwik Code -->

</head>	
<body>
<div id="chatdiv">
<table class="data-table" width="500px">
	
		<caption class="title"><center><a href="index.php"><button>Inbox</button></a></center></caption>
		<thead>
			<h4><center>Conversation with <? echo "<font color='red'>$sender_name</font>"; ?><br><p> Subject : <?php echo "<font color='blue'>$subj</font>"; ?> </p></center></h4>
			<tr>
				<td style="background-color: #cbe0e7"><? $pro=$_SESSION['profile'];?><center> <?php echo "<img src ='/unix/dept/img/profile/$pro' height=70 width=70 style='border-radius: 5px;'" ;  ?><br><br/><b>You</b></center></td> 
		<td style="background-color: #cbe0e7" colspan="2">
			<form method="post" action="" enctype="multipart/form-data"><br>
				<textarea onkeypress="isTyping('true'); timer=5;" onkeyup="isTyping('false')" required name="textarea" id="textarea" cols="70" rows="5"></textarea><div id="Tobias Sopu"></div>
				<input type="hidden" name="act1" value="run"/><br/>
				<input type="submit" value="Reply" name="submit" /> <input type="file" name="myFile" accept=".jpeg,.png,.jpg,.pdf"/>
			</form>			
		</td>			
			</tr>
		</thead>
		<tbody>
<br /><br />
<?php
$conv_id = $_GET['conv_id'];
$send = $_GET['send'];
$sql = ("SELECT sms.*, users.profile_pic, users.gname, users.lname, users.email, users.profile_pic, users.status FROM sms INNER JOIN users On sms.sender=users.email WHERE conv_id='".$conv_id."'  order by time desc");
$mysql = mysqli_query($conn, $sql) or die ("SELECT CHAT".mysqli_error($conn));
while ($row = mysqli_fetch_array($mysql)){
		$face = $row['profile_pic'];
		$profile = "../unix/dept/img/profile/$face";
		// set name of the person you chat with 	
	    $name1 = $row['gname'];
		$name2 = $row['lname'];
		$to_email = $row['email'];
		$sender = $row['sender'];
		$to = $name1.' '.$name2;
		if ($_SESSION['mail'] == $sender ){
			$touser = "You";
		}else{
			$touser = $sender_name;
		}
		// set status if online or offline
		$online = "../unix/img/online.png";
		$offline = "../unix/img/offline.png";
		$icon = $row['status'];
			
		if($icon == 1){
			$status = "<img src='$online' style='position: relative; margin-right: -34px; top: -25px;' height=12 width=12>"; 
		}elseif ($icon == 0){
			$status = "<img src='$offline' style='position: relative; margin-right: -34px; top: -25px;' height=12 width=12>"; 
		}
		// display messages
		$message = $row['message'];
		
	// time of chat
	$time = $row['time'];	
	$time_now = date_default_timezone_get();
	$view = $row['view'];
	$now = new DateTime($time_now);
	$ago = new DateTime($time);
	$cal = $ago->diff($now);
	$du = $cal->format("%D %H:%i:%s");
	sscanf($du,"%d %d:%d:%d ", $day, $hr, $min, $sec);

	if (($day == 0) && ($hr == 0) && ($min == 0) && ($sec >0)){
		$a = "$sec secs ago";
	}elseif (($day == 0) && ($hr == 0) && ($min == 1)){
		$a = "$min min ago";	
	}elseif (($day == 0) && ($hr == 0) && ($min > 1)){
		$a = "$min mins ago";
	}elseif (($day == 0) && ($hr == 1)){
		$a = "$hr hr $min mins ago";	
	}elseif (($day == 0) && ($hr > 1)){
		$a = "$hr hrs $min mins ago";
	}elseif(($day == 1)&& ($hr == 0)){
		$a = "$day day ago";
	}elseif(($day == 1)&& ($hr > 0)){
		$a = "$day day $hr hrs ago";	
	}elseif($day > 1){
		$a = "$day days $hr hrs ago";	
	}	
   /// when the message was viewed 
    $time_view = $row['view_time'];	
	$time_now = date_default_timezone_get();
	
	$current_time = new DateTime($time_now);
	$time_viewed = new DateTime($time_view);
	$calculation = $time_viewed->diff($current_time);
	$results = $calculation->format("%D %H:%i:%s");
	sscanf($results,"%d %d:%d:%d ", $day1, $hr1, $min1, $sec1);
	
	if (($day1 == 0) && ($hr1 == 0) && ($min1 == 0) && ($sec1 >0)){
		$b = ": $sec1 secs ago";
	}elseif (($day1 == 0) && ($hr1 == 0) && ($min1 == 1)){
		$b = ": $min1 min ago";	
	}elseif (($day1 == 0) && ($hr1 == 0) && ($min1 > 1)){
		$b = ": $min1 mins ago";
	}elseif (($day1 == 0) && ($hr1 == 1)){
		$b = ": $hr1 hr $min1 mins ago";	
	}elseif (($day1 == 0) && ($hr1 > 1)){
		$b = ": $hr1 hrs $min1 mins ago";
	}elseif($day1 == 1){
		$b = ": $day1 day ago";
	}elseif(($day1 == 1) && ($hr1 == 1)){
		$b = ": $day1 day $hr hr ago";
	}elseif(($day1 == 1) && ($hr1 > 1)){
		$b = ": $day1 day $hr hrs ago";			
	}elseif($day1 > 1) {
		$b = ": $day1 days $hr1 hrs ago";	
	}
		
   //check if message been viewed
   $view = $row['view'];
   $attachment = $row['file'];
   $file_show = "attachments/$attachment";
if(strpos($attachment, '.jpg')==TRUE || strpos($attachment, '.jpeg')==TRUE || strpos($attachment, '.png')==TRUE || strpos($attachment, '.PNG')==TRUE
|| strpos($attachment, '.JPG')==TRUE || strpos($attachment, '.JPEG')==TRUE){
	$display = "<br><a href='$file_show' target='_blank'>
	<img src='$file_show' height='50%' width='50%' style='border-radius: 2px;'><font color='orange'></a></font>";
}elseif($attachment!=''){  
	//$file_show = "attachments/$attachment";
	$display = "<br><a href='$file_show' target='_blank'>
	<img src='img/attachment.png' height=15 width=20 style='border-radius: 2px;'><font color='orange'> </a>$attachment</font>";
}elseif($attachment==''){
	$display='';
} 
	echo "<tr>";	
		echo "<td><center><img src='$profile' height=50 width=50 style='border-radius: 50px;'><br>$status<br><a href='delete.php?id=$id'>";
		if($_SESSION['user']=='manager'){
			echo "<button style='color:red; opacity:0.5;hover:opacity:1;'>X</button></a>";
		}
		echo "</center></td>";
		echo "<td><p align='left'><b> $touser</b> &nbsp;<font size='2' color='#cccccc'>$a</font><br>$message <br>
		$display</p><font size='2' color='#cccccc'>$view  $b</font></td>";
    echo "</tr>";
}
    

?>
</tbody>
</table>

</div>
<script>
var chatdiv = document.getElementById('chatdiv');
setInterval(
    // Here is where to do things like dom manipulation
    function() {
        chatdiv.innerHTML = new ('reply.php') ;
    },

    // Here is where you set the interval asuming I want to update every 1 second
    1000
);
</script>
</body>		
</html>
