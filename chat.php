<?php
session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
header("Location: index.php");
}
?>
<html>
<head>
	<title>Inbox Mail | <?php echo $_SESSION['lname']; ?>, &nbsp;<?php echo $_SESSION['fname'];?></title>
	<link rel="stylesheet" href="style.css">
	<!--<link rel="stylesheet" href="slide.css">
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
 <?php
 if (isset($_SESSION['user'])) {
	 echo sprintf("_paq.push(['setUserId', '%s']);", $_SESSION['fname'].' '.$_SESSION['lname']); 
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
<!-- End Piwik Code -->


</head>
<body>
	

 
<table class="data-table" width="800px">
	<?
	if ($_SESSION['user'] == 'admin'){
	?>
	<center><a href="/puleset/index.php"><button>Admin Setting</button></a></center>
	<?
	}else{
		print "<center><a href='/unix/table.php'><button>Back to Database</button></a></center>";
	}
	?>
		<caption class="title"><font color="blue">SMS</font> - Inbox Messages</caption>
		<thead>
			<tr>
				<th>from</th>
				<th>message  <?php echo"<a href='compose.php'><button>Compose</button></a>";?>  <?php echo"<a href='mail.php'><button>Outbox</button></a>";?></th>
				
			</tr>
		</thead>
		<tbody>
		<?php
		$sql = ("SELECT chat.id, chat.to_user, chat.from_user, chat.subject, chat.time, chat.message, users.profile_pic, users.gname, users.lname, users.dept FROM chat 
		INNER JOIN users ON chat.from_user=users.gname WHERE to_user='".$_SESSION['fname']."' ORDER by time DESC");
		$query = mysqli_query($conn, $sql) or die ("ERROR CHAT QUERY".mysqli_error($conn));
		
		while ($chat = mysqli_fetch_array($query)){
			$to = $chat['to_user'];
			$from = $chat['from_user'];
			$time = date('D, M jS, Y  h:i:s a', strtotime($chat['time']));
			$last = $chat['lname'];
			$subject = $chat['subject'];
			$message = $chat['message'];
			$num = mysqli_num_rows($query);
			$id = $chat['id'];
			$prof = $chat['profile_pic'];
			$proshow = "/unix/dept/img/profile/$prof";
		
			echo '<tr>'; 
				print "<td><center><img src='$proshow' height=80 width=80 style='border-radius: 5px;'><br><br>$from  $last</center></td>";
				print "<td><p align='left'><font color='red'>Date : </font><font color='blue'>$time</font><br /><br /><font color='red'>Subject : </font>$subject<br />
				<font color='red'>Message : </font>$message<br><br><a href='reply.php?subject=$subject&to=$to&from=$from&pro=$prof&id=$id'><input type='button' value='Reply'/></p></td>";
				//print"<td><a href='reply.php?subject=$subject&to=$to&from=$from&id=$id&pro=$prof'><input type='button' value='Reply'/></a></td>";
			echo '</tr>';
			}
			
		?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="1">MESSAGES</th>
				<th><? echo $num?></th>
			</tr>
		</tfoot>
	</table>
  </body>
</html>
<?php
//$url='office.php';
// echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
?>
