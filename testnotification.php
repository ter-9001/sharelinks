<?php

session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    
</head>

<link rel="stylesheet" type="text/css" href="style.css" />
<style>
    #menu
    {
        display: block;
        background-color: rgba(225, 225, 225, 0.5);
        box-shadow: 1px 1px 1px 1px aqua;
        
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    

    }

    #menu li
    {
        color: grey;
    }
</style>
<body>
    



<?php

$search = [];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sharelinks";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT comments.user as user, posters.user as userposter, comments.comment, comments.date FROM comments RIGHT JOIN posters 
ON comments.posterid = posters.posterid WHERE posters.user='{$_SESSION['user']}' ORDER BY comments.date desc;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    

    
    }}



    
    

?>


<ul id="menu">
    <li> someone comment on your poster </li>
    <li> she comment on the poster agagagag</li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>



</body>
</html>