<?
require_once 'db.php';
$id = $_GET['id'];

$sql = ("DELETE FROM sms WHERE id='".$id."'");
$result = mysqli_query($conn, $sql) or die ("ERROR deleting from sms table".mysqli_error($conn));

$url = $_SERVER['HTTP_REFERER'];
header("Location: $url");
echo "<br><br><br><br><center>  Processing . . . </center>";
echo '<META HTTP-EQUIV=REFRESH CONTENT="2; "'.$url.'">';	
?>
