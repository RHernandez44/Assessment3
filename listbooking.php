<?php
include "checksession.php";
isAdmin();
include "header.php";
include "menu.php";
loginStatus(); //show the current login status
checkUser();

include "config.php"; //load in any variables
$DBC = mysqli_connect("127.0.0.1", DBUSER, DBPASSWORD, DBDATABASE);

// Shows session variables
echo "<pre>";
echo "Session variables\n";
var_dump($_SESSION);
echo "</pre>";

//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. " . mysqli_connect_error();
    exit; //stop processing the page further
}

//prepare a query and send it to the server
$query = 'SELECT itemID,pizza,pizzatype FROM fooditems ORDER BY itemID';
$result = mysqli_query($DBC, $query);
$rowcount = mysqli_num_rows($result);
?>
<div id="body">
    <div class="header">
        <div>
            <h1>Bookings List</h1>
        </div>
    </div>
</div>