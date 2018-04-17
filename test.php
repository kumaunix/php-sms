<?php

$txt = "";
session_start();

if (isset($_POST['submit']) && (($_POST['text']) != "")) {
    $_SESSION['text'] = $_POST['text'];
    header("Location: ". $_SERVER['REQUEST_URI']);
    exit;
} else {
    if(isset($_SESSION['text'])) {
        //Retrieve show string from form submission.
        $txt = $_SESSION['text'];
        unset($_SESSION['text']);
    }
}

?>

<!DOCTYPE html >
<head>
<title>Refresher test</title>
</head>
<body>
<br/><br/><h2>What Me Refresh</h2>

<?php
if($txt != "") {
    echo "The text you entered was : $txt";
} else {
?>


<p><h3>Enter text in the box then select "Go":</h3></p>

<form method="post">
<textarea rows="5" cols="50" name="text" >
</textarea>
<input type="submit" name="submit" value="Go" />
</form>

<?php } ?>

</body>
</html>	