<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Share Links </title>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/4372633949.js" crossorigin="anonymous"></script>
</head>

<link rel="stylesheet" type="text/css" href="style.css" />

<style>

#comments
{
    width: 80%;
    position: absolute;
    left: 10%;

}


.quadro
{
    display: flex;
    justify-content: start;
    border-width: 0.2px;
    border-style: solid;
    width: 100%;
    padding: 10px;
    border-image: linear-gradient(to left, white, darkorchid) 1;
    border-bottom: none;
}

#newcomm
{
    width: 100%;
    height: 100px;
    border: solid 0.2px grey;
    border-radius: 10px;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-size: 15px;
}




</style>



<body>
    
    <?php
    
    // poster_id user comment data --> comments

    // id user gender email --> user

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sharelinks";
 
    if(isset($_GET['posterid']))
      $posterid = $_GET['posterid'];
 


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM posters WHERE id =".$posterid;
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
        while($row = $result->fetch_assoc()) {


            $text = $row['text'];
            $user_main = $row['user'];


            if(strpos(" ".$row['text'], 'https://') > 0)
                $text = preg_replace('!(https://[a-z0-9_./?=&-]+)!i', '<a href="$1">$1</a> ', $row['text']." ");
           
           else if(strpos(" ".$row['text'], 'http://')>0)
                $text = preg_replace('!(http://[a-z0-9_./?=&-]+)!i', '<a href="$1">$1</a> ', $row['text']." ");
                
           else if(strpos(" ".$row['text'], 'www.')>0)
                $text = preg_replace('!(www.[a-z0-9_./?=&-]+)!i', '<a href="http://$1">$1</a> ', $row['text']." ");
                   




        $sql = "SELECT * FROM users WHERE user='{$user_main}'";
        $result1 = $conn->query($sql);

        if ($result1->num_rows > 0) {
            // output data of each row

        
            while($userinfo = $result1->fetch_assoc()) {
                 
                    if($userinfo['gender']==1)
                        $color='blue';
                    else
                        $color= '#ff00c3';   




                        echo "
                        <div class=' quadro column' style='display: flex; justify-content: start; margin: 0 10px 0 10px; padding-bottom: 100px'>
                        <div id='userinfo' class='column' style=' margin-right: 100px'>
                                <ion-icon name='contact'
                                style='color:".$color.";'></ion-icon>
                                <p id='username'> {$user_main} </p>
                        </div>
                    <div style='color: grey;font-size: 25px; text-align: center'> 
                        {$text}
                    </div>   
                   
                </div>";

            }}
        
   
            
   
        }

    }


    $conn->close();

    
    ?>

    

    <div id="comments" class="column">

    <p style= "font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-size: 20px; color: grey"> Comentários: </p>
            
            
            <div class="quadro" style="background-color: rgba(125, 125, 125, 0.2)">
            <div id='userinfo' class='column'>
                    <?php
                    
                    // comment here!
                        if(isset($_GET['user']))
                                $user = $_GET['user'];


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
                                
                                $sql = "SELECT * FROM users WHERE user='{$user}'";
                                $result1 = $conn->query($sql);

                        if ($result1->num_rows > 0) {
                            // output data of each row

                        
                            while($userinfo = $result1->fetch_assoc()) {
                                
                                    if($userinfo['gender']==1)
                                        $color='blue';
                                    else
                                        $color= '#ff00c3';   


                                                                    
                                            echo "
                                            <ion-icon name='contact'
                                            style='color:{$color}'></ion-icon>
                                            <p id='username'>{$user} </p>";   
                        
                                    }}
                                    else
                                    {
                                        echo "<script> alert('result 0'); </script>";
                                
                                    }
                               
                                    $conn->close();

                    ?>    
            
                </div>
                <input type="text" name="newcomm" id="newcomm" placeholder="Comment here :)"/>
            </div>
            
            
            <div class="quadro">

                  <?php
                  
                  //all comments

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
                    
                    $sql = "SELECT * FROM users WHERE user='{$user}'";
                    $result1 = $conn->query($sql);

            if ($result1->num_rows > 0) {
                // output data of each row

            
                while($userinfo = $result1->fetch_assoc()) {
                    
                }}
                
                  $conn->close();
                  
                  
                  ?>                  



                <div id='userinfo' class='column'>
                    <ion-icon name='contact'
                    style='color:".$color."'></ion-icon>
                    <p id='username'> Usuario </p>
                </div>
                <div class="posterinfo" style="margin-top: 30px">
                    AAAAAAAAA
                </div>
            </div>

            
    </div>


</body>
</html>