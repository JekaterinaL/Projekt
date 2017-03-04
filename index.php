<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// prints e.g. 'Current PHP version: 4.1.1'
echo 'Current PHP version: ' . phpversion();

// prints e.g. '2.0' or nothing if the extension isn't enabled
echo phpversion('tidy');

 	$host = "localhost";
    $user = "test";
    $pass = "t3st3r123";
    $db = "test";
    $db = "test";

    $l = mysqli_connect($host, $user, $pass, $db);
    mysqli_query($l, "SET CHARACTER SET UTF8") or
            die("Error, ei saa andmebaasi charsetti seatud");
    mysqli_close($l);
?>
<html>
</head>

<body onload="startTime()">
<script src="clock.js"></script>

<div id="txt"></div>

<h1>My first heading</h1>

<p>My first paragraph.</p>

<img src="picture.jpg" width="142" height="104">

<p><link rel="stylesheet" href="styles.css"></p>
 <a href="http://jigsaw.w3.org/css-validator/check/referer">
  <img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" />
 </a>

</body>
</html>