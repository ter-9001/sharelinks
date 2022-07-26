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

    if (!isset($_SESSION['loggedin'])) {
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
            $stmt->bind_result($id, $user, $passwordUser, $gender, $email);
            $stmt->fetch();
            // Account exists, now we verify the password.
            // Note: remember to use password_hash in your registration file to store the hashed passwords.


        }
    }
    ?>

    <style>
        input:hover {
            color: blue;
        }

        #submit {
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
            <input type="text" name="user" id="user" value="<?php echo $user; ?>" onclick="enable()" />

            <label> Email: </label>
            <input type="text" name="email" id="email" value="<?php echo $email; ?>" onclick="enable()" />

            
            <label> Gender: </label>

                <select name="gender" id="gender">
                    
                    <?php 
                    
                          if($gender==0) 
                             echo "<option value='0'> Female </option> <option value='1'>Male</option>";
                          else
                             echo "<option value='1'>Male</option> <option value='0'>Female</option>"; 
                    ?>
                    
                        
                </select>
            
            
            <span style="margin: 50px 0 0 0;" onclick="cpassword()"> Change password </span>


            <div id="cpassword">

                <label> Previus Password: </label>
                <input type="text" name="ppassword" id="ppassword" style="border-radius: 10px;border: 0.2px solid grey" onclick="enable()" />

                <label> New Password: </label>
                <input type="text" name="npassword" id="npassword" style="border-radius: 10px;border: 0.2px solid grey" onclick="enable()" />

            </div>

            <input type="text" name="change" value="yes" style="display: none">

            <div class="row">
                <input id="submit" type="submit" style="margin: 20px 0 0 0;
                background-color: grey;
                color: white;
                border-radius: 10px;
                border: none;" value="Change data!" />


                <input type="submit" value="Home" name="home" style="margin: 20px 0 0 40px;
                background-color: aqua;
                color: white;
                border-radius: 10px;
                border: none;" />

        
                <button style="margin: 20px 0 0 40px;
                background-color: red;
                color: white;
                border-radius: 10px;
                border: none;
                font-size: 17px;"  type="button" onclick="
                
                let person = prompt('You\'re about to delete your account \n including posters and comments \n If you wanna proceed \n digit your user name \n and click ok');
                
                
                if (person.toLowerCase () =='<?php echo trim($_SESSION['user']); ?>'.toLowerCase () ) {
                      
                    alert('Deleting! Thank you for using our website :)');


                      window.location.href='login.php?delete=ok';
                      



                }
                else
                {
                    alert('The name informed is not your user name!');
                }
                    

                ">

                        Delete Account

                </button>
                </form>
            </div>





    </div>


        
    <div id="footer" style="position: absolute; top: 85%">
        <p> Contact the administrator here: </p>
        <strong> @ </strong>
    </div>


</body>


<script>
    this.disable = true;
    var cpassword1 = 0;
    var inputs = Array.from(document.getElementsByTagName('input'));
    var selects = Array.from(document.getElementsByTagName('select'));

    var all = inputs.concat(selects);
    all.forEach( obj => console.log(obj));


    function enable() {
        this.disable = false;
    }

    function cpassword() {
        cpassword1++;

        if (cpassword1 % 2)
            document.getElementById('cpassword').style.display = 'flex';
        else
            document.getElementById('cpassword').style.display = 'none';
    }

    all.forEach(obj => {

        obj.onchange = function() {


            document.getElementById('submit').style.backgroundColor = 'aqua';

        };



    })


    


</script>

<?php



if (isset($_POST['home'])) {
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['user'] = $_SESSION['user'];
    echo "<script> window.location.href= 'home.php'; </script>";
    exit();
}


if (isset($_POST['change']) && $_POST['change'] == 'yes') {


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sharelinks";




    $user = $_POST['user'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];

    $ppassword = $_POST['ppassword'];
    $npassword = $_POST['npassword'];






    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // check if there is a repeated user
    $sql = "SELECT id FROM users WHERE user='{$user}'";
    $rows = $conn->query($sql);

    if ($rows->num_rows > 0) {


        while ($row = $rows->fetch_assoc()) {



            if ($row['id'] != $id) {
                echo "<script> alert('This user name already exist!') </script>";
            }
        }
    }

    // check if there is a repeated email
    $sql = "SELECT id FROM users WHERE email='{$email}'";
    $rows = $conn->query($sql);

    if ($rows->num_rows > 0) {


        while ($row = $rows->fetch_assoc()) {



            if ($row['id'] != $id) {
                echo "<script> alert('This email is already used on a account!') </script>";
            }
        }
    }



    $conn->close();




    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (trim($ppassword) != '' || trim($npassword) != '') {
        if (trim($ppassword) == '' || trim($npassword) == '') 
        {
            echo "<script> alert('To change password, you must informe your  old and new password'); </script>";
            die("To change password, you must informe your  old and new password!!!!!");
        } 
        else {

            
            
            if ($stmt = $conn->prepare("SELECT password FROM users WHERE user=?")) {
                // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
                $stmt->bind_param('s', $user);
                $stmt->execute();
                // Store the result so we can check if the account exists in the database.
                $stmt->store_result();
    
                
    
                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($passwordP);
                    $stmt->fetch();
                    // Account exists, now we verify the password.
                    // Note: remember to use password_hash in your registration file to store the hashed passwords.
                    
                        
                                if(password_verify($ppassword, $passwordP))
                                {
                                $hash = password_hash($_POST['npassword'], PASSWORD_DEFAULT);
                
                      

                                if ($stmt = $conn->prepare("UPDATE users SET user=?, gender = '{$gender}', email= '{$email}', password=? WHERE user= '{$_SESSION['user']}'"))
                                {
                                            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
                    
                      
                    
                                            //$hash = password_hash($_POST['npassword'], PASSWORD_DEFAULT);
                    
                                            $stmt->bind_param('ss', $user, $hash);
                                            $status = $stmt->execute();
                    
                    
                    
                                            /* BK: always check whether the execute() succeeded */
                                            if ($status === true) {
                    
                    
                                                echo "<script> alert('Dados atualizandos!'); </script>";
                                                $_SESSION['loggedin'] = TRUE;
                                                $_SESSION['user'] = $user;
                    
                                                header('Location: home.php');
                                                exit();
                                            } else {
                                                echo "Erro 3" . $stmt->error;
                                            }
                                        }
                                }
                                else
                                {
                                    
                                    echo "<script> alert('Old password dont match'); </script>";
                                    die("Old password dont match");
                
                                }
    
    
                }}    

              
        }
    }



    if ($stmt = $conn->prepare("UPDATE users SET user= ?, gender = '{$gender}', email= '{$email}' WHERE user= '{$_SESSION['user']}'
     ")) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"



        //$hash = password_hash($_POST['npassword'], PASSWORD_DEFAULT);

        $stmt->bind_param('s', $user);
        $status = $stmt->execute();







        /* BK: always check whether the execute() succeeded */
        if ($status === true) {


            echo "<script> alert('Dados atualizandos!'); </script>";
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['user'] = $user;
            header('Location: tochange.php');
            die('Dados atualizandos!');


        } else {
            echo "Erro 3" . $stmt->error;
        }
    }
}










?>


</html>