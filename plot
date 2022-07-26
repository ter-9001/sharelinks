$lastnot = date("d F Y H:i:s");

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
                    



                    $sql = "UPDATE SET lastnot ='{$lastnot}' WHERE user={$_SESSION['user']}";



                    
                    if ($conn->query($sql) === TRUE) {

                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }


                    $conn -> close();
