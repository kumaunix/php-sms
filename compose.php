<?php
session_start();
require 'dbconnect.php';
if(!isset($_SESSION['user']))
{
 header("Location: ../unix/index.php");	
}

	
?>
<html>
<head>
	<title>Compose Mail | <?php echo $_SESSION['lname']; ?>, &nbsp;<?php echo $_SESSION['fname'];?></title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/compose.css">
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