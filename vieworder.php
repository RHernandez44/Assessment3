<?php
include "header.php";
include "checksession.php";
include "menu.php";
include "config.php"; //load in any variables
loginStatus(); //show the current login status
$DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);

//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. " . mysqli_connect_error();
    exit; //stop processing the page further
}

?>
<h1>Order Details View</h1>
<?php
//do some simple validation to check if id exists
$id = $_GET['id'];
if (empty($id) or !is_numeric($id)) {
    echo "<h2>Invalid Food item ID</h2>"; //simple error feedback
    exit;
}

// query for order
$query = 'SELECT * FROM orders WHERE orderID=' . $id;

$result = mysqli_query($DBC, $query);
$rowcount = mysqli_num_rows($result);

//makes sure we have the Food Item
if ($rowcount > 0) {
    echo "<fieldset><legend>Order detail #$id</legend><dl>";
    $row = mysqli_fetch_assoc($result);
    echo "<dt>Order ID:</dt><dd>" . $row['orderID'] . "</dd>" . PHP_EOL;
    echo "<dt>OrderLine ID:</dt><dd>" . $row['orderLineID'] . "</dd>" . PHP_EOL;
    echo "<dt>Customer ID:</dt><dd>" . $row['customerID'] . "</dd>" . PHP_EOL;
    echo "<dt>Date required:</dt><dd>" . $row['orderDate'] . "</dd>" . PHP_EOL;
    echo "<dt>Time Required:</dt><dd>" . $row['orderTime'] . "</dd>" . PHP_EOL;
    echo "<dt>Extras:</dt><dd>" . $row['extras'] . "</dd>" . PHP_EOL;
    echo "<dt>Total Cost:</dt><dd>" . $row['totalCost'] . "</dd>" . PHP_EOL;
    echo '</dl></fieldset>' . PHP_EOL;
} else echo "<h2>No Food Item found!</h2>"; //suitable feedback

mysqli_free_result($result); //free any memory used by the query
mysqli_close($DBC); //close the connection once done
?>

<h2><a href='listorders.php'>[Return to the orders listing]</a><a href='/AS2_5029791/'>[Return to the main page]</a></h2>

<?php
include "footer.php";
?>