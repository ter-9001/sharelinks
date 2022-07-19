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
        
        if ($stmt = $conn->prepare('SELECT user, password, gender, email FROM users WHERE user= ? ')) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            $stmt->bind_param('s', $_SESSION['user']);
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();



            if ($stmt->num_rows > 0) {
                $stmt->bind_result($user,$passwordUser, $gender, $email);
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
        background-color: grey;
        color: white;
        border-radius: 10px;
        border: none;
    }

    .enableButton
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

    <form>

        <label> User: </label>
        <input type="text" name="user" id="user"  value="<?php echo $user; ?>" onclick="enable()"/>

        <label> Email: </label>
        <input type="text" name="user" id="user"  value="<?php echo $email; ?>" onclick="enable()" />

        <span style="margin: 50px 0 0 0;"> Change passoword </span>


        <input type="submit" id="submit" value="Change data!"
        />


    </form>


</div>


</body>


<script>

    this.disable = true;

    function enable()
    {
        this.disable = false;
    }
</script>



</html>