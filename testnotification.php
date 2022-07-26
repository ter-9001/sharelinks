<?php

session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  
</head>

<style>
    
#not li:hover

{
    
    transition: 1s;
    box-shadow: 1px 1px 1px 1px aqua;
}

#not
{
        display: block;
        background-color: rgba(225, 225, 225, 0.5);
        box-shadow: 1px 1px 1px 1px aqua;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        list-style: none;   
        font-size: 10px;
        width: 200px;

}

#not li
{
    color: grey;
    padding: 10px 0 10px 0;
}




#not span
{
    font-weight: bolder;
}
</style>
<body>
    

<ul id="not">
   

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

$sql = "SELECT comments.user as user, posters.user as userposter, comments.comment, posters.text,
comments.date FROM comments RIGHT JOIN posters ON comments.posterid = posters.posterid WHERE 
comments.posterid = (SELECT comments.posterid FROM comments WHERE user = '{$_SESSION['user']}') AND 
comments.user !='{$_SESSION['user']}' 
UNION SELECT comments.user as user, posters.user as userposter, comments.comment, posters.text,
comments.date FROM comments 
RIGHT JOIN posters ON comments.posterid = posters.posterid WHERE posters.user='{$_SESSION['user']}' AND 
comments.user !='{$_SESSION['user']}' order by date desc;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    
    $end="";
            
            if(strcasecmp($row['userposter'], $_SESSION['user'])==0)
            {
                $end= "on Your poster";
            }
            else
            {
                $end = "on the poster <span> {$row['text']} </span>";
            }

           echo "<li>  <span> {$row['user']} </span> comment {$end}  </li>";    
    
    }}



    
    

?>
</ul>



</body>
</html>