<?php session_start(); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Share Link </title>
</head>
<style>
    #login, #singup
    {
        width: 600px;
        height: 400px;
        box-shadow: 1px 1px 1px 1px aqua;
        position: absolute;
        top: 10%;
        left: 50%;
        display: flex;
        flex-direction: column;
        justify-content: start;
        background-color: rgba(225, 225, 225, 0.9);
        border-radius: 5px;
        z-index: 2000;
        
    }

    #singup
    {
        display: none;
        width: 700px;
        left: 42%;
    
    }

    div
    {
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-size: 17px;
        color: grey;
    }

    form
    {
        display: flex;
        flex-direction: column;
        justify-content: start;
        margin: 30px 0 0  30px;
    }

    input
    {
        width: 300px;
        height: 20px;
        margin-bottom: 20px;
        border-radius: 10px;
        border: grey 0.1px solid;
    }

    p
    {
        margin: 0;
    }

    #submit
    {
        background-color: aqua;
        color: white;
        border: none;
    }

    body
    {
        background-image: url('https://media.istockphoto.com/photos/young-woman-working-on-a-laptop-picture-id613241758?b=1&k=20&m=613241758&s=170667a&w=0&h=F5YuQPSC4i3ZvtFyvzo_zAh83LLEKmsJ8R9A2vsYoUg=');
        background-repeat: no-repeat;
        background-size: 100%, 100%;
        
    }

    #apresetation
    {
        margin: 100px 0 0 50px;
        color: white;
        width: 40%;

    }

    #behind
    {
        background-color: rgba(0, 0, 0, 0.5);
        z-index: -1000;
        height: 100%; width: 100%;
        position: fixed;
        top: 0;
        inset: 0;
    
        
    }

    li
    {
        margin: 20px 0 0 0;
    }

    video
    {
        width: 500px;
        height: 320px;
        border-radius: 10px;
        border: solid 0.2 white;
    }

    .titulo
    {
        font-size: 25px; margin-bottom: 10px
    }


</style>
<link rel="stylesheet" type="text/css" href="style.css" />

<body>

    <div id="behind"></div>

    <div id="apresetation">

        <p class="titulo"> How share links works? </p>

        <p style="font-size: 20px; margin: 0 0 0 10px"> Here you can share links for any purpose: </p>

        <ul style="font-size: 20px; list-style: square">
            <li> You can share your deepweb list and  your Youtube chanel. </li>
            <li> Call your friends and stranges to a meet on a live and more. </li>
            <li> Share any link of any social midia. </li>
            <li> And so much more.... </li>
        </ul>

        <p class="titulo">So easy! Find what you want! </p>
    
        <video  src="" controls>

        </video>


    </div>

    <div id="login">
        <p style="margin: 10px 0 0 10px; font-size: 25px;"> Log in: </p>

        <form method="POST">
            <p> User </p>
            <input type="text" name="emailuser" id="emailuser" />
            <p> Password </p>
            <input type="text" name="password" id="password" />
            
            <input type="text" name="singup" value="no" style="display: none"/>
            <input type="submit" id="submit">
            <span>
                Don't have a account yet?  
                <strong onclick= "Changelog('Up')"> Sing up </strong>
            </span>
        </form>

        
    </div>

    <div id="singup">
        <p style="margin: 10px 0 0 10px; font-size: 25px;"> Sing up: </p>

        <form method="POST">
            

            <div class="row">
            
                <div style="margin-right: 5px ;">
                    <p> User </p>
                    <input type="text" name="user" id="user" />
                    <p> Password </p>
                    <input type="text" name="password" id="password" />

                </div>

                <div>
                    <p> Email </p>
                    <input type="text" name="email" id="email" />
                    <p> Gender </p>
                    <select name="gender" id="gender">
                        <option value="1">Male</option>
                        <option value="0">Female</option>
                    </select>
                    <input type="text" name="singup" value="yes" style="display: none"/>
                </div>

            </div>


            <input type="submit" id="submit">
            <span>
                Already have a account?  
                <strong onclick= "Changelog('In')"> Sing In </strong>
            </span>
        </form>

        
    </div>
</body>
<script>
    function Changelog(a)
    {

        if(a == 'Up')
        {
            document.getElementById('login').style.display = 'none'
            document.getElementById('apresetation').style.display = 'none'
            document.getElementById('singup').style.display = 'block'

        }  

        if(a == 'In')
        {
            document.getElementById('singup').style.display = 'none'
            document.getElementById('login').style.display = 'block'
            document.getElementById('apresetation').style.display = 'block'


        }  
    }
</script>


<?php


if (isset($_GET['delete']) && ($_GET['delete'] == 'ok') ) {
    


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

    //p


    if ($stmt = $conn->prepare("DELETE FROM posters WHERE user=?")) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s',$_SESSION['user']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $status = $stmt->store_result();


                if ($status === true) 
                {

                }
                else
                {
                    die($conn->error);
                }

    }

    //c

    if ($stmt = $conn->prepare("DELETE FROM comments WHERE user=?")) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $_SESSION['user']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $status = $stmt->store_result();


                if ($status === true) 
                {
                }
                else
                {
                    die($conn->error);
                }

    }

   
    //u

    
    if ($stmt = $conn->prepare("DELETE FROM users WHERE user=?")) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $_SESSION['user']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $status = $stmt->store_result();


                if ($status === true) 
                {

                    $_SESSION['loggedin'] = false;
                    $_SESSION['user'] = null;
                    echo   " <script> window.location.replace('login.php'); </script>";
                    exit;
                    
                }
                else
                {
                    die($conn->error);
                }

    }

    

        
    
 
}


// log in

   if(isset($_POST["emailuser"], $_POST["password"])
   && !(trim($_POST['emailuser'])=='' || trim($_POST['emailuser'])=='')  && $_POST['singup'] == 'no' )
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
        
        
                   
        
        if ($stmt = $conn->prepare("SELECT user, password, email FROM users WHERE user=?")) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            $stmt->bind_param('s', $_POST['emailuser']);
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();

            

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($user,$passwordUser, $email);
                $stmt->fetch();
                // Account exists, now we verify the password.
                // Note: remember to use password_hash in your registration file to store the hashed passwords.
                
                    
            


                if ( password_verify($_POST['password'], $passwordUser)) {
                    // Verification success! User has logged-in!
                    // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                    $_SESSION['loggedin'] = TRUE;
                    
                    // Melhorar log in 
                    $_SESSION['user'] = $_POST['emailuser'];
       
                    flush(); // Flush the buffer
                    ob_flush();
                    //header('Location: home.php');
                    echo "<script> window.location.href='home.php'; </script> ";
                    
                    exit;
                   
                    



                } else {
                    
                    
                    
                    // Incorrect password
                    echo " <script> alert('Incorrect username and/or password!'); </script>";
                }
            } else {
                // Incorrect username
                     echo " <script> alert('Incorrect username and/or password!'); </script>";

            }
            
        
        
            $stmt->close();
        }
        

   }


  



// cadastrar
     if(isset($_POST['singup']) && ($_POST['singup'] == 'yes'))
     {

        
        
       
        if(!isset($_POST['user'], $_POST['password'], $_POST['email'])  || trim($_POST['email'])=="" || trim($_POST['user'])=="" || trim($_POST['password'])=="" )
        {
            echo "<script> alert('Err: You did not fill all formulary'); </script>";

        }
        else
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
            
            $sql = "SELECT user FROM users WHERE user='{$_POST['user']}' ";
            $result = $conn->query($sql);

            
            $conn->close();
            
            if ( $result->num_rows > 0) {
              
                echo "<script> alert('Err: User already exist!'); </script>";

            }
            else
            {
                 $passwordUser = password_hash($_POST['password'], PASSWORD_DEFAULT);   

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
                 
                 $sql = "INSERT INTO users values (0,'{$_POST['user']}','{$passwordUser}','{$_POST['gender']}', '{$_POST['email']}' )";
                 
                 if ($conn->query($sql) === TRUE) 
                 {
                    $_SESSION['loggedin'] = TRUE;
                    


                    $_SESSION['user'] = $_POST['user'];
                    
                    header('Location: home.php');
                    
                 }
                 else
                 { 
                    die('ERRO!!!'.$conn->error);
                 }


            }         
        }






     }





?>



</html>