<!DOCTYPE HTML>
<html>
<?php
include "header.php";
include "menu.php";
include "checksession.php";
checkUser();

// this line is for debugging purposes so that we can see the actual POST data
echo "<pre>";
echo "POST DATA\n";
var_dump($_POST);
echo "</pre>";

// Shows session variables
echo "<pre>";
echo "Session variables\n";
var_dump($_SESSION);
echo "</pre>";
?>

<head>
    <title>Make a reservation</title>
</head>

<body>

    <?php
    //function to clean input but not validate type and content
    function cleanInput($data)
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    //the data was sent using a formtherefore we use the $_POST instead of $_GET
    //check if we are saving data first by checking if the submit button exists in the array
    if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Add')) {
        //if ($_SERVER["REQUEST_METHOD"] == "POST") { //alternative simpler POST test    
        include "config.php"; //load in any variables
        $DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);

        if (mysqli_connect_errno()) {
            echo "Error: Unable to connect to MySQL. " . mysqli_connect_error();
            exit; //stop processing the page further
        };

        //validate incoming data - only the first field is done for you in this example - rest is up to you do
        //phone Number
        $error = 0; //clear our error flag
        $msg = 'Error: ';
        if (isset($_POST['telephone']) and !empty($_POST['telephone']) and is_string($_POST['telephone'])) {
            $fn = cleanInput($_POST['telephone']);
            $telephone = (strlen($fn) > 15) ? substr($fn, 1, 15) : $fn; //check length and clip if too big
            //we would also do context checking here for contents, etc       
        } else {
            $error++; //bump the error flag
            $msg .= 'Invalid pizza  '; //append eror message
            $telephone = '';
        }
        //people
        if (isset($_POST['people']) and !empty($_POST['people']) and is_string($_POST['people'])) {
            $fn = cleanInput($_POST['people']);
            $people = (strlen($fn) > 200) ? substr($fn, 1, 200) : $fn; //check length and clip if too big   
            //we would also do context checking here for contents, etc  
        } else {
            $error++; //bump the error flag
            $msg .= 'Invalid description  '; //append eror message
            $people = '';
        }
        $bookingdate = cleanInput($_POST['date']);
        $bookingtime = cleanInput($_POST['time']);
        $customerID = $_SESSION['userid'];

        //save the item data if the error flag is still clear
        if ($error == 0) {
            $query = "INSERT INTO booking (customerID,telephone,bookingdate,bookingtime,people) VALUES (?,?,?,?,?)";
            $stmt = mysqli_prepare($DBC, $query); //prepare the query
            mysqli_stmt_bind_param($stmt, 'sssss', $customerID, $telephone, $bookingdate, $bookingtime, $people);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "<h2>Your Reservation has been Placed!</h2>";
        } else {
            echo "<h2>$msg</h2>" . PHP_EOL;
        }
        mysqli_close($DBC); //close the connection once done
    }
    ?>

    <div id="body" class="contact">
        <div class="header">
            <div>
                <h1>Make a reservation</h1>
            </div>
        </div>
    </div>

    <?php
    loginStatus(); //show the current login status 
    ?>

    <form method="POST" action="makebooking.php">
        <p>
            <label for="telephone">Phone Number: </label>
            <input type="text" id="telephone" name="telephone" maxlength="15" required>
        </p>
        <p>
            <label for="date">Date: </label>
            <input type="date" id="date" size="100" name="date" maxlength="200" required>
        </p>
        <p>
            <label for="time">Time: </label>
            <input type="time" id="time" name="time" required>
        </p>
        <p>
            <label for="people">Number of Diners: </label>
            <input type="number" id="people" name="people" min="1" max="12" value="2" required>
        </p>

        <input type="submit" name="submit" value="Add">
        <a href="/As2_5029791/">[Cancel]</a>
    </form>
</body>
<?php
include "footer.php";
?>

</html>