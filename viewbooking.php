<?php
include "header.php";
include "checksession.php";
include "menu.php";
include "config.php"; //load in any variables
$DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);

//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. " . mysqli_connect_error();
    exit; //stop processing the page further
}

?>
<div id="body" class="contact">
    <div class="header">
        <div>
            <h1>Booking Details</h1>
        </div>
    </div>
</div>

<br><br>

<?php
//do some simple validation to check if id exists
$id = $_GET['id'];
if (empty($id) or !is_numeric($id)) {
    echo "<h2>Invalid Booking ID</h2>"; //simple error feedback
    exit;
}

// query for order
$query = 'SELECT * FROM booking WHERE bookingID =' . $id;

$result = mysqli_query($DBC, $query);
$rowcount = mysqli_num_rows($result);

//makes sure we have the item
if ($rowcount > 0) {
    echo "<fieldset><legend>Order detail #$id</legend><dl>";
    $row = mysqli_fetch_assoc($result);
    echo "<dt>Booking ID:</dt><dd>" . $row['bookingID'] . "</dd>" . PHP_EOL;
    echo "<dt>Customer ID:</dt><dd>" . $row['customerID'] . "</dd>" . PHP_EOL;
    echo "<dt>Telephone:</dt><dd>" . $row['telephone'] . "</dd>" . PHP_EOL;
    echo "<dt>Date:</dt><dd>" . $row['bookingdate'] . "</dd>" . PHP_EOL;
    echo "<dt>Time:</dt><dd>" . $row['bookingtime'] . "</dd>" . PHP_EOL;
    echo "<dt>Number of People:</dt><dd>" . $row['people'] . "</dd>" . PHP_EOL;
    echo '</dl></fieldset>' . PHP_EOL;
} else echo "<h2>No Booking matching this ID found!</h2>"; //suitable feedback

mysqli_free_result($result); //free any memory used by the query
mysqli_close($DBC); //close the connection once done
?>

<br><br>

<?php
include "footer.php";
?>