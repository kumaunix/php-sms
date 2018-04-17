<?php
include('db.php');
session_start();
$check = mysql_query("SELECT * FROM sms order by id desc WHERE sender='".$_SESSION['mail']."' ");
if(isset($_POST['content']))
{
$content=mysql_real_escape_string($_POST['content']);
$ip=mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
mysql_query("insert into sms (message,ip_add) values ('$content','$ip')");
$fetch= mysql_query("SELECT message,id FROM sms WHERE sender='".$_SESSION['mail']."' order by id desc");
$row=mysql_fetch_array($fetch);
}
?>

<div class="showbox"> <?php echo $row['message']; ?> </div>
