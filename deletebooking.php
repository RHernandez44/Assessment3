<?php
include "checksession.php";
include "header.php";
include "menu.php";
include "config.php"; //load in any variables
$DBC = mysqli_connect("127.0.0.1", DBUSER, DBPASSWORD, DBDATABASE);

//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. " . mysqli_connect_error();
    exit; //stop processing the page further
}

//function to clean input but not validate type and content
function cleanInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

//retrieve the itemid from the URL
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    if (empty($id) or !is_numeric($id)) {
        echo "<h2>Invalid Order Value. Choose a correct order ID</h2>"; //simple error feedback
        exit;
    }
}

//the data was sent using a formtherefore we use the $_POST instead of $_GET
//check if we are saving data first by checking if the submit button exists in the array
if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Delete')) {
    $error = 0; //clear our error flag
    $msg = 'Error: ';
    //itemID (sent via a form it is a string not a number so we try a type conversion!)    
    if (isset($_POST['id']) and !empty($_POST['id']) and is_integer(intval($_POST['id']))) {
        $id = cleanInput($_POST['id']);
    } else {
        $error++; //bump the error flag
        $msg .= 'Invalid Order Value. Choose a correct order ID'; //append error message
        $id = 0;
    }

    //save the food item data if the error flag is still clear and food item id is > 0
    if ($error == 0 and $id > 0) {
        $query = "DELETE FROM orders WHERE orderID=?";
        $stmt = mysqli_prepare($DBC, $query); //prepare the query
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo "<h2>Order item details deleted.</h2>";
    } else {
        echo "<h2>$msg</h2>" . PHP_EOL;
    }
}

//prepare a query and send it to the server
//NOTE for simplicity purposes ONLY we are not using prepared queries
//make sure you ALWAYS use prepared queries when creating custom SQL like below
$query = 'SELECT * FROM booking WHERE bookingID=' . $id;
$result = mysqli_query($DBC, $query);
$rowcount = mysqli_num_rows($result);
?>
<div id="body">
    <div class="header">
        <div>
            <h1>Booking Details Preview before Deletion</h1>
        </div>
    </div>
</div>

<br><br>

<?php

//makes sure we have the food item
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
?>
    <form method="POST" action="deleteorder.php">
        <h2>Are you sure you want to delete this Order?</h2>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="submit" value="Delete">
        <a href="listorders.php">[Cancel]</a>
    </form>

    <br><br>

<?php
} else echo "<h2>No Order found, possbily deleted!</h2>"; //suitable feedback

mysqli_free_result($result); //free any memory used by the query
mysqli_close($DBC); //close the connection once done

include "footer.php";
?>