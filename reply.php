<?php
session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION['token']))
{
header("Location: url.php"); // Update to your redirect url
}
?>
<html>
<head>
	<title>Inbox Mail | <?php echo $_SESSION['lname']; ?>, &nbsp;<?php echo $_SESSION['fname'];?></title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/button4.css">
	<link rel="stylesheet" href="slide.css">
	
<script type="text/javascript">
   var autoLoad = setInterval(
   function ()
   {
      $('#chatdiv').load('reply.php').fadeIn("slow");
   }, 10000); // refresh page every 10 seconds
</script>
</head>
<body>
<center>
 <h3>Inbox Messages</h3>
	<?
	if ($_SESSION['user'] == 'admin' || $_SESSION['user'] == 'manager'){
	?>
	
	<?
	}else{
		print "<center><a href='/puleset/user_index.php'><button class='button4'>User Setting</button></a></center>";
	}
	?>
	<table class="data-table" width="600px">
		<caption class="title"><font color="blue">SMS</font> - Inbox Messages</caption>
		<thead>
			<tr>
				<th>sender</th>
				<th>message  <?php echo"<a href='compose.php'><button>Compose</button></a>";?>  </th>
			</tr>
		</thead>
		<tbody>
		<?php
		$sql3 = ("SELECT sms.*, users.email, users.lname, users.profile_pic, users.gname, users.status FROM sms 
		INNER JOIN users ON sms.sender=users.email WHERE receiver='".$_SESSION['mail']."' and view='Unseen'  order by time desc");
		$query3 = mysqli_query($conn, $sql3) or die ("ERROR CHAT QUERY".mysqli_error($conn));
		while ($inbox3 = mysqli_fetch_array($query3)){
			$id = $inbox3['id'];
			$sender = $inbox3['sender'];
			$message = $inbox3['message'];
			$time = $inbox3['time'];
			$subject = $inbox3['subject'];
			$face = $inbox3['profile_pic'];
			$profile = "../unix/dept/img/profile/$face";
			$sender_1name = $inbox3['gname'];
			$sender_2name = $inbox3['lname'];
			$sender_email = $inbox3['email'];
			$conv_id = $inbox3['conv_id'];
			$number = mysqli_num_rows($query3);
			$icon = $inbox3['status'];
			$online = "../unix/img/online.png";
			$offline = "../unix/img/offline.png";
			if($icon == 1){
				$status = "<img src='$online' height=11 width=11 style='position: relative; margin-right: 4px; top: -20px; right: -12px;'>"; 
			}elseif ($icon == 0){
				$status = "<img src='$offline' height=11 width=11 style='position: relative; margin-right: 4px; top: -20px; right: -12px;'>"; 
			}
			$time_now = date_default_timezone_get();
			$now = new DateTime($time_now);
			$ago = new DateTime($time);
			$cal = $ago->diff($now);
			$du = $cal->format("%D %H:%i:%s");
			sscanf($du,"%d %d:%d:%d ", $day, $hr, $min, $sec);
			
			if($day == 1){
				$a = "$day day ago";
			}elseif($day > 1){
				$a = "$day days ago";	
			}elseif (($day == 0) && ($hr == 1)){
				$a = "$hr hr ago";
			}elseif (($day == 0) && ($hr > 1)){
				$a = "$hr hrs ago";	
			}elseif (($day == 0) && ($hr == 0) && ($min == 1)){
				$a = "$min min ago";
			}elseif (($day == 0) && ($hr == 0) && ($min > 1)){
				$a = "$min mins ago";	
			}elseif (($day == 0) && ($hr == 0) && ($min == 0) && ($sec >0)){
				$a = "$sec secs ago";
			}		
			
			if ($sender_email == $_SESSION['mail']){
				$sender_fullname = "You";
			}else{   
		    $sender_fullname = $sender_1name.' '.$sender_2name;
		    } 
			$link = "reply.php?conv_id=$conv_id&send=$sender&sendername=$sender_fullname&id=$id";
			
			$view = $inbox3['view'];
	
		echo '<tr>'; //print "<td style='background-color:#55b4d4'>
				print "<td style='background-color:#55b4d4'><center><br><img src='$profile' height=40 width=40 style='border-radius: 5px;'><br>$status<br><b>$sender_fullname</b></center></td>";
					print "<td style='background-color:#55b4d4'><p align='left'><b><font color='yellow'>New Mail ($number)</font></b><br>$message  </p><font size='2.5' color='black'> Time : $a</font>
					<br><a href='$link'><button class='button4'>View</button></td>";	
		echo '</tr>';
		}
		$sql = ("SELECT sms.*, users.email, users.lname, users.profile_pic, users.gname, users.status FROM sms 
		INNER JOIN users ON sms.sender=users.email WHERE subject!='' and (sender='".$_SESSION['mail']."' or receiver='".$_SESSION['mail']."')  order by time desc");
		$query = mysqli_query($conn, $sql) or die ("ERROR CHAT QUERY".mysqli_error($conn));
		
		while ($inbox = mysqli_fetch_array($query)){
			$id = $inbox['id'];
			$sender = $inbox['sender'];
			$receiver = $inbox['receiver'];
			$message = $inbox['message'];
			$time = $inbox['time'];
			$subject = $inbox['subject'];
			$face = $inbox['profile_pic'];
			$profile = "../unix/dept/img/profile/$face";
			$sender_1name = $inbox['gname'];
			$sender_2name = $inbox['lname'];
			$sender_email = $inbox['email'];
			$conv_id = $inbox['conv_id'];
			$number = mysqli_num_rows($query);
			$icon = $inbox['status'];
			$online = "../unix/img/online.png";
			$offline = "../unix/img/offline.png";
			if($icon == 1){
				$status = "<img src='$online' height=12 width=12 style='position: relative; margin-right: -10px; top: -16px; right: -12px;'>"; 
			}elseif ($icon == 0){
				$status = "<img src='$offline' height=12 width=12 style='position: relative; margin-right: -10px; top: -16px; right: -12px;'>"; 
			}
			$time_now = date_default_timezone_get();
			$now = new DateTime($time_now);
			$ago = new DateTime($time);
			$cal = $ago->diff($now);
			$du = $cal->format("%D %H:%i:%s");
			sscanf($du,"%d %d:%d:%d ", $day, $hr, $min, $sec);
			$num = mysqli_num_rows($query);
			if($day == 1){
				$a = "$day day ago";
			}elseif($day > 1){
				$a = "$day days ago";	
			}elseif (($day == 0) && ($hr == 1)){
				$a = "$hr hr ago";
			}elseif (($day == 0) && ($hr > 1)){
				$a = "$hr hrs ago";	
			}elseif (($day == 0) && ($hr == 0) && ($min == 1)){
				$a = "$min min ago";
			}elseif (($day == 0) && ($hr == 0) && ($min > 1)){
				$a = "$min mins ago";	
			}elseif (($day == 0) && ($hr == 0) && ($min == 0) && ($sec >0)){
				$a = "$sec secs ago";
			}		
			/// determine whether you sent the mail 
			if ($_SESSION['mail'] == $sender_email ){
				$sender_fullname = "You";
			}else{
			    $sender_fullname = $sender_1name.' '.$sender_2name;
		    }
			
			$link = "reply.php?subject=$subject&conv_id=$conv_id&send=$sender&sendername=$sender_fullname&id=$id";
			
			$view = $inbox['view'];
	
			
		echo '<tr>'; //print "<td style='background-color:#55b4d4'>
				print "<td><center><br><img src='$profile' height=50 width=50 style='border-radius: 50px;'><br>$status<br><b>$sender_fullname</b></center></td>";
					print "<td><p align='left'><font color='#cccc'>Thread subject : </font><b>$subject</b><br>$message  </p><font size='2.5' color='black'> Time : $a</font>
					<br><a href='$link'><button class='button4'>View | Reply</button></td>";	
		echo '</tr>';
		}
//	}			
		?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="1">MESSAGES</th>
				<th><? echo $num?></th>
			</tr>
		</tfoot>
	</table>
</center>
  </body>
</html>
