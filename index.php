<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// prints e.g. 'Current PHP version: 4.1.1'
echo 'Current PHP version: ' . phpversion();

// prints e.g. '2.0' or nothing if the extension isn't enabled
echo phpversion();

 	$host = "localhost";
    $user = "test";
    $pass = "t3st3r123";
    $db = "test";
    $table = "10163487_table";

    $l = mysqli_connect($host, $user, $pass, $db);
    mysqli_query($l, "SET CHARACTER SET UTF8") or
            die("Error, ei saa andmebaasi charsetti seatud");
    mysqli_close($l);
?>
<?php
$db_host = '*****';
$db_user = '*****';
$db_pwd = '*****';

$database = '*****';
$table = 'Guitars';

if (!mysql_connect($db_host, $db_user, $db_pwd))
    die("Can't connect to database");

if (!mysql_select_db($database))
    die("Can't select database");

// sending query
$result = mysql_query("SELECT * FROM {$table}");
if (!$result) {
    die("Query to show fields from table failed");
} 

$fields_num = mysql_num_fields($result);

echo "<table border='1'><tr>";
// printing table headers
for($i=0; $i<$fields_num; $i++)
{
    $field = mysql_fetch_field($result);
    echo "<td>{$field->name}</td>";
}
echo "</tr>\n";
// printing table rows
while($row = mysql_fetch_row($result))
{
    echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
     foreach($row as $cell)
        echo "<td>$cell</td>";

    echo "</tr>\n";
}
mysql_free_result($result);
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