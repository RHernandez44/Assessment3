<?php

include "header.php";
include "menu.php";
include "checksession.php";

loginStatus(); //show the current login status

//simple logout
if (isset($_POST['logout'])) logout();

if (isset($_POST['login']) and !empty($_POST['login']) and ($_POST['login'] == 'Login')) {

    include "config.php"; //load in any variables
    $DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE) or die();
    //validate incoming data - only the first field is done for you in this example - rest is up to you to do
    //firstname
    $error = 0; //clear our error flag
    $msg = 'Error: ';

    if (isset($_POST['username']) and !empty($_POST['username']) and is_string($_POST['username'])) {
        $un = htmlspecialchars(stripslashes(trim($_POST['username'])));
        $username = (strlen($un) > 32) ? substr($un, 1, 32) : $un; //check length and clip if too big       

    } else {
        $error++; //bump the error flag
        $msg .= 'Invalid username '; //append error message
        $username = '';
    }

    //password  - normally we avoid altering a password apart from whitespace on the ends   
    $password = trim($_POST['password']);
    //This should be done with prepared statements!!

    if ($error == 0) {
        $query = "SELECT customerID,email,password FROM customer WHERE email = '$username'";
        $result = mysqli_query($DBC, $query);
        if (mysqli_num_rows($result) == 1) { //found the user
            $row = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            mysqli_close($DBC); //close the connection once done
            if ($password === $row['password']) //using plaintext for demonstration only!            
                login($row['customerID'], $username, $row['role']);
        }
        echo "<h2>Login fail</h2>" . PHP_EOL;
    } else {
        echo "<h2>$msg</h2>" . PHP_EOL;
    }
}
?>

<!-- ------------------------- HTML starts here ------------------------- -->
<p>Admin email= Admin@pizza.com, Password= password</p>
<p>Customer email= customer@test.com, Password= password</p>
<div id="body" class="contact">
    <div class="footer">
        <div class="contact">
            <h1>Please Login to continue</h1>
            <form method="POST" action="login.php">
                <p>
                    <label for="email">Email: </label>
                    <input type="text" id="username" name="username" maxlength="32">
                </p>
                <p>
                    <label for="password">Password: </label>
                    <input type="password" id="password" name="password" maxlength="32">
                </p>
                <input type="submit" name="login" value="Login" id="submit">
                <br>
                <input type="submit" name="logout" value="Logout" id="submit">
            </form>
        </div>
    </div>
</div>

</body>

</html>
<?php
//----------- page content ends here
include "footer.php";
?>