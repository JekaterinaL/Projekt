<?php
// prints e.g. 'Current PHP version: 4.1.1'
echo 'Current PHP version: ' . phpversion();

// prints e.g. '2.0' or nothing if the extension isn't enabled
echo phpversion('tidy');

 $host = "localhost";
    $user = "test";
    $pass = "t3st3r123";
    $db = "test";

    $l = mysqli_connect($host, $user, $pass, $db);
    mysqli_query($l, "SET CHARACTER SET UTF8") or
            die("Error, ei saa andmebaasi charsetti seatud");
    mysqli_close($l);
?>
<html>
<body>

<h1>My first heading</h1>

<p>My first paragraph.</p>

<img src="picture.jpg" width="142" height="104">

<link rel="stylesheet" href="styles.css">

</body>
</html>