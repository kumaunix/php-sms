
<html>
<head>
	<title>Resend Mail </title>
	<link rel="stylesheet" href="style.css">


</head>	
<body align="center">
<br><br><br>

<form action="" method="post" >
<input type="file" name="myFile">
 <br><input type="hidden" name="act" value="run"/>
<input type="submit" value="Upload">
</form>


<?php
phpinfo();

if (!empty($_POST['act'])){
if (!empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];
	$path= 'uploads/';
    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred.</p>";
        exit;
    }

    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists($path . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    // preserve file from temporary directory
    $success = move_uploaded_file($myFile["tmp_name"],
        $path.$name);
    if (!$success) { 
        echo "<p>Unable to save file.</p>";
        exit;
    }

    // set proper permissions on the new file
    chmod($path.$name, 0644);
}

}

?>


</body>		
</html>