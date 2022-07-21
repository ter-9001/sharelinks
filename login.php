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
        
    }

    #singup
    {
        z-index: -1;
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


</style>
<link rel="stylesheet" type="text/css" href="style.css" />

<body>
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
                        <option value="male">Male</option>
                        <option value="female" selected>Female</option>
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
            document.getElementById('singup').style.display = 'block'

        }  

        if(a == 'In')
        {
            document.getElementById('singup').style.display = 'none'
            document.getElementById('login').style.display = 'block'

        }  
    }
</script>


<?php
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
        
        
                   
        
        if ($stmt = $conn->prepare("SELECT user, password, email FROM users WHERE user=  ?")) {
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
                    session_start();
                    $_SESSION['loggedin'] = TRUE;
                    
                    // Melhorar log in 
                    $_SESSION['user'] = $_POST['emailuser'];
       
                    
                     header('Location: home.php');
                   
                    



                } else {
                    // Incorrect password
                    echo " <script> Alert('Incorrect username and/or password!'); </script>";
                }
            } else {
                // Incorrect username
                     echo " <script> Alert('Incorrect username and/or password!'); </script>";

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
                 $passwordUser = password_hash($_POST['user'], PASSWORD_DEFAULT);   

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
                    session_start();
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