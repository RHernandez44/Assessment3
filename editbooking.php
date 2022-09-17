<!DOCTYPE HTML>
<html>
<?php
include "header.php";
include "menu.php";
include "checksession.php";
?>
<div id="body">
    <div class="header">
        <div>
            <h1>Edit Order</h1>
        </div>
    </div>
</div>

<?php
// // Shows session variables
// echo "<pre>";
// echo "Session variables\n";
// var_dump($_SESSION);
// echo "</pre>";

// // this line is for debugging purposes so that we can see the actual POST data
// echo "<pre>";
// echo "POST DATA\n";
// var_dump($_POST);
// echo "</pre>";

// echo "<pre>";
// echo "GET DATA\n";
// var_dump($_GET);
// echo "</pre>";
?>

<body>

    <?php
    include "config.php"; //load in any variables
    $DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);

    if (mysqli_connect_errno()) {
        echo "Error: Unable to connect to MySQL. " . mysqli_connect_error();
        exit; //stop processing the page further
    };

    //function to clean input but not validate type and content
    function cleanInput($data)
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    //retrieve the bookingID from the URL
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $bookingID = $_GET['id'];
        if (empty($bookingID) or !is_numeric($bookingID)) {
            echo "<h2>Invalid food item ID</h2>"; //simple error feedback
            exit;
        }
    }
    //the data was sent using a form therefore we use the $_POST instead of $_GET
    //check if we are saving data first by checking if the submit button exists in the array
    if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Update')) {
        //validate incoming data - only the first field is done for you in this example - rest is up to you do
        $error = 0;
        $msg = "";
        //refer to additems for extend validation examples
        //itemID (sent via a form it is a string not a number so we try a type conversion!)    
        if (isset($_POST['id']) and !empty($_POST['id']) and is_integer(intval($_POST['id']))) {
            $bookingID = cleanInput($_POST['id']);
        } else {
            $error++; //bump the error flag
            $msg .= 'Invalid food item ID '; //append error message
            $bookingID = 0;
        }
        //Date
        $bookingdate = cleanInput($_POST['bookingdate']);
        //bookingtime
        $bookingtime = cleanInput($_POST['bookingtime']);
        //people
        $people = cleanInput($_POST['people']);

        //save the item data if the error flag is still clear and item id is > 0
        if ($error == 0 and $bookingID > 0) {
            $query = "UPDATE booking SET bookingdate=?,bookingtime=?,people=? WHERE bookingID=?";
            $stmt = mysqli_prepare($DBC, $query); //prepare the query
            mysqli_stmt_bind_param($stmt, 'sssi', $bookingdate, $bookingtime, $people, $bookingID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "<h2>Booking details updated.</h2>";
            //        header('Location: http://localhost/bit608/listitems.php', true, 303);      
        } else {
            echo "<h2>$msg</h2>" . PHP_EOL;
        }
    }
    //locate the food item to edit by using the itemID
    //we also include the item ID in our form for sending it back for saving the data
    // $query = 'SELECT customerID,bookingdate,bookingtime,people FROM booking WHERE bookingID=' . $bookingID;
    $query = 'SELECT bookingID,customerID,telephone,bookingdate,bookingtime,people FROM booking ORDER BY bookingdate';

    $result = mysqli_query($DBC, $query);
    $rowcount = mysqli_num_rows($result);
    if ($rowcount > 0) {
        $row = mysqli_fetch_assoc($result);

    ?>
        <h1>INQUIRY FORM FOR ORDER# <?php echo $bookingID; ?></h1>

        <form method="POST" action="editbooking.php">
            <input type="hidden" name="id" value="<?php echo $bookingID; ?>">
            <input type="hidden" name="customerID" value="<?php echo $row['customerID']; ?>">
            <p>
                <label for="bookingdate">Order Date:</label>
                <input type="date" id="bookingdate" name="bookingdate" minlength="5" maxlength="50" value="<?php echo $row['bookingdate']; ?>" required>
            </p>
            <p>
                <label for="bookingtime">Order Time:</label>
                <input type="time" id="bookingtime" name="bookingtime" minlength="5" maxlength="50" value="<?php echo $row['bookingtime']; ?>" required>
            </p>
            <p>
                <label for="people">people: </label>
                <!-- <input type="number" id="people" name="people" size="100" minlength="5" maxlength="200" value="<?php echo $row['people']; ?>" required> -->
                <input type="number" id="people" name="people" min="1" max="12" value="<?php echo $row['people']; ?>" required>

            </p>
            <input type="submit" name="submit" value="Update">
            <a href="listorders.php">[Cancel]</a>
        </form>
    <?php
    } else {
        echo "<h2>Food item not found with that ID</h2>"; //simple error feedback
    }
    mysqli_close($DBC); //close the connection once done
    ?>
</body>
<?php
include "footer.php";
?>

</html>