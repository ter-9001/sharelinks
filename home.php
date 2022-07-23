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
            
            <div id="frameuser"
            class="row" ">
            
            <?php
                date_default_timezone_set('UTC');
                session_start();

                if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false) {
                    header('Location: login.php');
                    exit;
                }
                    
                if(isset($_SESSION['user']))
                    $actualUser = $_SESSION['user'];


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
   
            
                        }}
            
            ?>


                            <ion-icon name='contact' class="showmenu"
                                style='color:<?php echo $color ?>;
                                font-size: 30px; ' onclick="showmenu()"></ion-icon>
                               <p id='username' class='user showmenu' onclick="showmenu()" > <?php echo $_SESSION['user'] ?> </p>

                            <ul id='menu'>
                                <li onclick="filterUser()">
                                    <p>Change data</p>
                                </li>
                                <li onclick="window.location.href='?logoff=ok';">
                                    <ion-icon style="margin: 0 10px 0 10px" name="power" ></ion-icon>
                                    <p>  Logout </p> 

                                </li>
                            </ul>


                            

            <?php 
            
                        if(isset($_GET['logoff']))
                        {
                            $_SESSION['loggedin'] = false;
                            header('Location: login.php');
                        }
            
            
            
            
            ?>            





            </div>


                            

            

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

                    <div class="kind" onclick= "filter('')">
                        <ion-icon name="cube"></ion-icon>    
                        <p> All </p>
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



                <form class="row" style="display: flex; justify-content: center; align-items: center"
                method="GET">
                    <input type="text" name="search" id="" class="searchbox"
                    placeholder="Search Text or User">
                    
                    <input type="submit" class="searchbotom row" value> 
                        
                            <ion-icon name="search">
                        
                            </ion-icon>
                    </input>
                    
                </form>


                
                <div style="width: 100%; display: flex; justify-content: center; padding: 30px 0 30px 0">


                        <button onclick="showPoster()" id="buttonposter">

                                Post here!

                        </button>


                </div>


                

        </div>        





        <div id="posts" style="margin-top: 50px ;">


<!---

 Users, Gender, Texto, Category, Date

-->


<?php


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
        
        

         if( (isset($filter) && !strcasecmp($row['category'],$filter)==0) && !(trim($filter)=='') )
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
       
        
    <div id='poster' class='row' onclick=\"question({$row['posterid']})\">
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
        <div id="ask" >

        <form method="post" >


            <label> Comment: </label>
            <input type="text" name="newpost" id="newpost" 
            style="height: 80px ;"/>


            <label> Category: </label>
            <select name="category" id="category">
                <option value="youtube"> Youtube </option>
                <option value="meet"> Meet </option>
                <option value="relation"> Relations </option>
                <option value="doubt"> Doubt </option>
                <option value="flirt"> Flirt </option>
                <option value="spiritual"> Spiritual </option>
                <option value="others"> Others </option>
                <option value="deepweb"> DeepWeb </option>

            </select>

            <input type="submit" value="Post!" style="width: 200px; height: 20px; border-radius: 10px; background-color: aqua; color: white; border: none; margin-top: 20px; position: relative;
            left: 25%;" />





        </form>

        </div>

<?php 

   if(isset($_POST['newpost']) && isset($_POST['category']))
   {
        $newpost = $_POST['newpost'];
        $category = $_POST['category'];
        $date = date("d F Y H:i:s");


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
        



        $sql = "INSERT INTO posters VALUES( 0,'{$actualUser}',
        '{$newpost}',
        '{$category}',
        '{$date}');";

        

        
        if ($conn->query($sql) === TRUE) {
          


        echo   " <script> window.location.href= '?actualUser={$actualUser}+&posterid={$posterid}'; </script>";








          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }




   }


?>        

<script>

    var menu=0;

   function filter(a)
   {
        window.location.href = '?filter='+a;
   }


   function question(a)
   {
        window.location.href = 'question.php?posterid='+a;
   }

   document.addEventListener("click", (evt) => {
        const flyoutEl = document.getElementById("ask");
        const flyoutEl2 = document.getElementById("buttonposter");

        let targetEl = evt.target; // clicked element      
        do {
          if((targetEl == flyoutEl) || (targetEl == flyoutEl2)) {
            // This is a click inside, does nothing, just return.
            return;
          }
          // Go up the DOM
          targetEl = targetEl.parentNode;
        } while (targetEl);
        // This is a click outside.      
        document.getElementById("ask").style.display = 'none';
      });


      function showPoster()
      {
        document.getElementById('ask').style.display = 'block';
      }

      function filterUser()
      {
        window.location.href = 'tochange.php';
      }

      function showmenu()
      {
            menu++;

            if(menu%2)
               document.getElementById('menu').style.display = 'block';
            else
               document.getElementById('menu').style.display = 'none';

      }

</script>



</body>
</html>