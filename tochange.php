<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
 
<link rel="stylesheet" type="text/css" href="style.css" />

<body>
<?php
        date_default_timezone_set('UTC');
        session_start();

        if(!isset($_SESSION['loggedin'])) {
            header('Location: login.php');
            exit;
        }

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sharelinks";
 
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "";
        
        if ($stmt = $conn->prepare('SELECT id, user, password, gender, email FROM users WHERE user= ? ')) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            $stmt->bind_param('s', $_SESSION['user']);
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();



            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $user,$passwordUser, $gender, $email);
                $stmt->fetch();
                // Account exists, now we verify the password.
                // Note: remember to use password_hash in your registration file to store the hashed passwords.

                
            }
        }
?>

<style>
    input:hover
    {
        color: blue;
    }

    #submit
    {
        margin: 20px 0 0 0;
        background-color: aqua;
        color: white;
        border-radius: 10px;
        border: none;
    }

    

</style>


<div id="change">

<p>
    Your data:
</p>

    <form method="POST">

        <label> User: </label>
        <input type="text" name="user" id="user"  value="<?php echo $user; ?>" onclick="enable()"/>

        <label> Email: </label>
        <input type="text" name="email" id="email"  value="<?php echo $email; ?>" onclick="enable()" />

        <span style="margin: 50px 0 0 0;"
        onclick="cpassword()"> Change password </span>

        <div id="cpassword">
          
            <label> Previus Password: </label>
            <input type="text" name="ppassword" id="ppassword" style="border-radius: 10px;border: 0.2px solid grey" onclick="enable()"/>

            <label> New Password: </label>
            <input type="text" name="npassword" id="npassword"  style="border-radius: 10px;border: 0.2px solid grey" onclick="enable()"/>

        </div>

        <input type="text" name="change" value="yes" style="display: none">

        <input id="submit" type="submit"  style="margin: 20px 0 0 0;
        background-color: grey;
        color: white;
        border-radius: 10px;
        border: none;"
        value="Change data!"
        />


    </form>


</div>


</body>


<script>

    this.disable = true;
    var cpassword1 = 0;
    var inputs = Array.from(document.getElementsByTagName('input'));

    function enable()
    {
        this.disable = false;
    }

    function cpassword()
    {
        cpassword1++;

        if(cpassword1%2)
           document.getElementById('cpassword').style.display = 'flex';
        else
            document.getElementById('cpassword').style.display = 'none';   
    }

    inputs.forEach( input => {

        input.onchange = function(){
        

            document.getElementById('submit').style.backgroundColor = 'aqua';
        
        };



    })
   
</script>

<?php


  if(isset($_POST['change']) && $_POST['change']=='yes' )
  {


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sharelinks";


    

    $user = $_POST['user'];
    $email = $_POST['email'];
   
    $ppassword = $_POST['ppassword'];
    $npassword = $_POST['npassword'];



    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT id, user FROM users WHERE user='{$user}'";
    $rows = $conn->query($sql);

    if ($rows ->num_rows > 0) {
        
                echo "<script> alert('This user name already exist!') </script>";
                die('This user name already exist!');
         
        
    }

    $conn->close();
            
    



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
     
     
             

    
     
     if ($stmt = $conn->prepare("UPDATE users SET id= 0, user= ?, email= '{$email}', WHERE user= '{$user}'
     ")) {
         // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"


         
         $hash = password_hash($_POST['npassword'], PASSWORD_DEFAULT);

         $stmt->bind_param('s', $user);
         $status = $stmt->execute();

         

         
         /* BK: always check whether the execute() succeeded */
        if ($status === true) {
           

            echo "<script> alert('Dados atualizandos!') </script>";
                    
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['user'] = $_POST['user'];
                    
                    


        }else
        {
            echo "Erro 3";
        }

     }

     



  }










?>


</html>