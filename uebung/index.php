<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style\login.css">
    <title>Login</title>
</head>
<?php 
session_start();
session_unset();
session_destroy();
?>
<body>
    <div class="wrapper wrapper_login">
        <div >
            <div  class="login">
                <h2>Login</h2>
                <div id="label_input">
                    <form method="POST" action="login_ueberpruefen.php">
                        <label for="email">Email: </label>
                        <input type="text" name="EMAIL" id="email"> 
                        <label for="passwort">Passwort: </label>
                        <input type="text" name="PASSWORT" id="passwort">
                    
                        <div>
                            <button type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>