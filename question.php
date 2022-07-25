<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/4372633949.js" crossorigin="anonymous"></script>
    
</head>


<link rel="stylesheet" type="text/css" href="style.css" />
<style>


.user, #username
{
    text-transform: capitalize;
}

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
    width: 95%;
    height: 100px;
    border: solid 0.2px grey;
    border-radius: 10px;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-size: 15px;
}

#submit
{
    position: absolute;
    right: -1%;
    width: 50px; 
    height: 105px; 
    background-color: transparent; 
    border: none;
    border-radius: 10px;
    z-index: 2;
    margin: 0;
}


#submit:hover
{
    transition: 1s;
    background-color: rgba(125, 125, 125, 0.3);
}


</style>



<body>
    
    <?php

    date_default_timezone_set('UTC');
    session_start();
    
    
    // poster_id user comment data --> comments

    // id user gender email --> user

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sharelinks";
    $user_main;
 
    if(isset($_GET['posterid']))
      $posterid = $_GET['posterid'];
 
      
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    

    $sql = "SELECT * FROM posters WHERE posterid = {$posterid}";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
        while($row = $result->fetch_assoc()) {


            $text = $row['text'];
            $user_main = $row['user'];

            echo "<title> {$text} </title>";


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
                        
                        
                        $trash='';


                    if($user_main == $_SESSION['user'])
                       $trash = "
                    
                       <div style='position: relative; left: 50%; font-size: 25px'>
                           <ion-icon name='trash' onclick='deletepost()'></ion-icon>
                       </div>  
                      ";    


                        echo "
                        <div class=' quadro column' style='display: flex; justify-content: start; margin: 0 10px 0 10px; padding-bottom: 100px'>
                        <div id='userinfo' class='column' style=' margin-right: 100px'>
                                <ion-icon name='contact'
                                style='color:".$color.";'></ion-icon>
                                <p id='username' class='user'> {$user_main} </p>
                        </div>
                    <div style='color: grey;font-size: 25px; text-align: center'> 
                        {$text}
                    </div> 
                    {$trash}

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
                        if(isset($_SESSION["user"]))
                                $actualUser = $_SESSION["user"];


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
                                
                                $sql = "SELECT gender FROM users WHERE user='{$actualUser}'";
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
                                            <p id='username' class='user'>{$actualUser} </p>";   
                        
                                    }}
                                    
                               
                                    $conn->close();

                    ?>    
            
                </div>
                        <form method="post"
                        style="width: 100%">
                            <input type="text" name="newcomm" id="newcomm" placeholder="Comment here :)"/>

                            <input type="submit" value  id= 'submit'>  
                            
                            
                            <ion-icon style="font-size: 30px; "
                        name="send"></ion-icon>

                        </form>


                          
                       
            </div>
            
            
            

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
                    
                    $sql = "SELECT * FROM comments WHERE posterid ='{$posterid}'";

                    $result1 = $conn->query($sql);

           
           
           if ($result1->num_rows > 0) {
                // output data of each row

            
                while($row = $result1->fetch_assoc()) {
                    


                    $user = $row['user'];
        
                    $sql = "SELECT * FROM users WHERE user='{$user}'";
                    $result2 = $conn->query($sql);

                    if ($result2->num_rows > 0) {
                        // output data of each row

                    
                        while($userinfo = $result2->fetch_assoc()) {
                            
                                if($userinfo['gender']==1)
                                    $color='blue';
                                else
                                    $color= '#ff00c3';   

                        }}
                    
                        $trash1= "";

                        if($user == $_SESSION['user'])
                        {
                            $trash1 = "
                                <div style='position: relative; left: 50%; font-size: 25px'>
                                    <ion-icon name='trash' onclick='deleteComment(".$row['id'].")' name='deletecomm' value='yes'></ion-icon>
                                </div> ";
                        }



                        echo "
                        <div class='quadro column'>
                            <div id='userinfo' class='column'>
                                <ion-icon name='contact'
                                style='color:{$color}'></ion-icon>
                                <p id='username' class='user'> {$user} </p>
                            </div>
                            <div class='column' 
                            style='font-size: 13px;
                            color: grey;
                            justify-content: start; 
                            align-items: start'>
                                    <p> Date: {$row['date']} </p>
                                    
                                    <div style='margin-top: 10px; font-size: 17px'>
                                        {$row['comment']}
                                    </div>
                            </div>
                           {$trash1}     
                    </div>";

                if(isset($_GET['deletecomm']) && $_GET['deletecomm'] == $row['id']
                  && ($user == $_SESSION['user']))
                  {
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
                        
                        $sql = "DELETE FROM comments WHERE id ='{$row['id']}'";

                        $result1 = $conn->query($sql);

                        if ($conn->query($sql) === TRUE) 
                        {
                            $_SESSION['loggedin'] = true;
                                            
                            echo   " <script> window.location.replace('question.php?posterid={$posterid}'); </script>";
                            exit;
                        }
                        else
                        { 
                            die('ERRO!!!'.$conn->error);
                        }
                        
                  }



                }}
                
                  

                  
                  ?>                  




            
    </div>

<script>

    function deleteComment(id)
    {
        if(confirm("Do you want to delete comment?")){
            window.location.href= "?deletecomm="+id+"&posterid=<?php echo $posterid?>";
        }
    }            

    function deletepost()
    {
        if(confirm("Do you want to delete post?")){
            window.location.href= "?deletepost=yes&posterid=<?php echo $posterid?>";
        }

    }
    function sendComment()
    {
        
        
        window.location.href= "?newcomm="+ document.getElementById('newcomm').value +"&dateNew="+dateNew+"&posterid="+posterid;


    }
</script>  

<?php


    if(isset($_POST["newcomm"]))
    {
        
        $date = date("d F Y H:i:s");
        $newcomm = $_POST["newcomm"];
                               

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
        



        $sql = "INSERT INTO comments VALUES(0,{$posterid},'{$actualUser}',
        '{$newcomm}',
        '{$date}');";



        
        if ($conn->query($sql) === TRUE) {
          
            echo   " <script> window.location.replace('?posterid={$posterid}'); </script>";
            exit;

          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }





    }



    
    if(isset($_GET['deletepost']) && $_GET['deletepost'] == 'yes'
    && ($user_main == $_SESSION['user']))
    {
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
          
          $sql = "DELETE FROM posters WHERE posterid ='{$posterid}'";

          $result1 = $conn->query($sql);

          if ($conn->query($sql) === TRUE) 
          {
            $_SESSION['loggedin'] = true;

            
            echo   " <script> window.location.replace('home.php'); </script>";
            exit;
          }
          else
          { 
              die('ERRO!!!'.$conn->error);
          }
          
    }

    
    $conn->close();





?>


</body>
</html>