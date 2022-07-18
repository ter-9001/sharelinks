<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home- Share Links </title>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/4372633949.js" crossorigin="anonymous"></script>
</head>
   
    <link rel="stylesheet" type="text/css" href="style.css" />

<style>
    
.user, #username
{
    text-transform: capitalize;
}
</style>    
<body>

        <div id="main">
                <div class="row" id="navbar">
                    <div class="kind" onclick= "filter('youtube')">
                        <ion-icon name="logo-youtube"></ion-icon>    
                        <p> Youtube </p>
                    </div>

                    <div class="kind" onclick= "filter('meets')">
                        <ion-icon name="videocam"></ion-icon>
                        <p> meets </p> 
                    </div>

                    <div class="kind" onclick= "filter('relations')">
                        <ion-icon name="chatboxes"></ion-icon>
                        <p> Relations </p>
                    </div>

                    
                    <div class="kind" onclick= "filter('doubt')">
                        <ion-icon name="help"></ion-icon>    
                        <p> Doubt </p>
                    </div>

                    <div class="kind" onclick= "filter('flirt')">
                        <ion-icon name="heart"></ion-icon>
                        <p> Flirt </p>
                    </div>

                    
                    <div class="kind" onclick= "filter('spiritual')">
                        <i class="fa-solid fa-person-praying"></i>    
                        <p> Spiritual </p>
                    </div>

                    <div class="kind" onclick= "filter('others')">
                        <ion-icon name="brush"></ion-icon>
                        <p> Others </p>
                    </div>

                    <div class="kind end" onclick= "filter('deepweb')">
                        <ion-icon name="logo-chrome"></ion-icon>
                        <p> Deep Web </p>
                    </div>


                </div>



                <form class="row" style="display: flex; justify-content: center; align-items: center">
                    <input type="text" name="search" id="" class="searchbox"
                    placeholder="Search Text or User">
                    
                    <input type="submit" class="searchbotom row" value=""> 
                        
                            <ion-icon name="search">
                        
                            </ion-icon>
                    </input>
                    
                </form>

        </div>        



        <div id="posts">


<!---

 Users, Gender, Texto, Category, Date

-->


<?php

  if(isset($_GET['actualUser']))
    $actualUser = $_GET['actualUser'];

   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "sharelinks";

   if(isset($_GET['filter']))
    $filter = $_GET['filter'];

    
   if(isset($_GET['search']))
   $search = $_GET['search'];


   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
   }
   
   $sql = "SELECT * FROM posters";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
       
        $user = $row['user'];
        
        $sql = "SELECT * FROM users WHERE user='{$user}'";
        $result1 = $conn->query($sql);

        if ($result1->num_rows > 0) {
            // output data of each row

        
            while($userinfo = $result1->fetch_assoc()) {
                 
                    if($userinfo['gender']==1)
                        $color='blue';
                    else
                        $color= '#ff00c3';   

            }}
        
        

         if(isset($filter) && !strcasecmp($row['category'],$filter)==0)
           continue;


        if(isset($search) && trim($search) != "")
         {
             if( strpos( strtoupper(" ".$row['text']), strtoupper(trim($search))   ) +
             strpos( strtoupper(" ".$row['user']), strtoupper(trim($search))   ) == 0)
             {
                continue;
             }  

         }   

         

        echo "
       
        
    <div id='poster' class='row' onclick=\"question({$row['id']}, 
    '".$actualUser."')\">
            <div id='userinfo' class='column'>
                <ion-icon name='contact'
                style='color:".$color."'></ion-icon>
                <p id='username' class='user'> ".$row['user']." </p>
            </div>

       <div id='postertexto' class='colunm'> 
           <div class='posterinfo row'>
               <p> Category: ".$row['category']." <p>

               <p> Date: ".$row['date']." </p>

           </div>
           ";

           
           $text = $row['text'];

           if(strpos(" ".$row['text'], 'https://') > 0)
                $text = preg_replace('!(https://[a-z0-9_./?=&-]+)!i', '<a href="$1">$1</a> ', $row['text']." ");
           
           else if(strpos(" ".$row['text'], 'http://')>0)
                $text = preg_replace('!(http://[a-z0-9_./?=&-]+)!i', '<a href="$1">$1</a> ', $row['text']." ");
                
           else if(strpos(" ".$row['text'], 'www.')>0)
                $text = preg_replace('!(www.[a-z0-9_./?=&-]+)!i', '<a href="http://$1">$1</a> ', $row['text']." ");
                   

            
            
            echo "<div>".$text. "</div>";



           
           echo "
        </div>
   
    </div>       
       
       ";
     }
   } else {
     echo "0 results";
   }
   $conn->close();
?>





        </div>

<script>

   function filter(a)
   {
        window.location.href = '?filter='+a;
   }


   function question(a, b)
   {
        window.location.href = 'question.php?posterid='+a+ '&actualUser='+b;
   }

</script>


</body>
</html>