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

        <form>
            <p> Email or User </p>
            <input type="text" name="emailuser" id="emailuser" />
            <p> Password </p>
            <input type="text" name="password" id="password" />
            <input type="submit" id="submit">
            <span>
                Don't have a account yet?  
                <strong onclick= "Changelog('Up')"> Sing up </strong>
            </span>
        </form>

        
    </div>

    <div id="singup">
        <p style="margin: 10px 0 0 10px; font-size: 25px;"> Sing up: </p>

        <form>
            

            <div class="row">
            
                <div style="margin-right: 5px ;">
                    <p> User </p>
                    <input type="text" name="emailuser" id="emailuser" />
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
</html>