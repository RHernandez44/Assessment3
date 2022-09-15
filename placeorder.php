<!DOCTYPE HTML>
<html>
<?php
include "header.php";
include "menu.php";
?>

<head>
    <title>Add a New Food Item</title>
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
        $DBC = mysqli_connect("127.0.0.1", DBUSER, DBPASSWORD, DBDATABASE);

        if (mysqli_connect_errno()) {
            echo "Error: Unable to connect to MySQL. " . mysqli_connect_error();
            exit; //stop processing the page further
        };

        //validate incoming data - only the first field is done for you in this example - rest is up to you do
        //food item name
        $error = 0; //clear our error flag
        $msg = 'Error: ';
        if (isset($_POST['pizza']) and !empty($_POST['pizza']) and is_string($_POST['pizza'])) {
            $fn = cleanInput($_POST['pizza']);
            $pizza = (strlen($fn) > 15) ? substr($fn, 1, 15) : $fn; //check length and clip if too big
            //we would also do context checking here for contents, etc       
        } else {
            $error++; //bump the error flag
            $msg .= 'Invalid pizza  '; //append eror message
            $pizza = '';
        }
        $extras = "reprints spain rom ferrari here";
        //description
        if (isset($_POST['description']) and !empty($_POST['description']) and is_string($_POST['description'])) {
            $fn = cleanInput($_POST['description']);
            $description = (strlen($fn) > 200) ? substr($fn, 1, 200) : $fn; //check length and clip if too big   
            //we would also do context checking here for contents, etc  
        } else {
            $error++; //bump the error flag
            $msg .= 'Invalid description  '; //append eror message
            $description = '';
        }
        //pizzatype
        if (isset($_POST['pizzatype']) and !empty($_POST['pizzatype']) and is_string($_POST['pizzatype'])) {
            $fn = strtoupper(cleanInput($_POST['pizzatype']));
            $pizzatype = (strlen($fn) > 1) ? substr($fn, 1, 1) : $fn; //check length and clip if too big   
            if ($pizzatype != 'V') $pizzatype = 'S'; //can only be V or S
        } else {
            $error++; //bump the error flag
            $msg .= 'Invalid pizza type  '; //append eror message
            $pizzatype = '';
        }
        //price    
        // if (isset($_POST['price']) and !empty($_POST['price']) and is_float($_POST['price'])) { //must have decimal
        //     $price = cleanInput($_POST['price']);
        //     if ($price < 5 or $price > 50) $price = 5;
        // } else {
        //     $error++; //bump the error flag
        //     $msg .= 'Invalid pizza price '; //append eror message
        //     $price = '';
        // }

        //save the item data if the error flag is still clear
        if ($error == 0) {
            $query = "INSERT INTO orders (orderLineID,customerID,orderDate,orderTime,extras,totalCost) VALUES (77,77,'2022-09-21','10:02:12','eggs and bacon',20.50)";
            $stmt = mysqli_prepare($DBC, $query); //prepare the query
            // mysqli_stmt_bind_param($stmt, 'sssd', $customerID, $orderDate, $orderTime, $extras, $totalCost);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "<h2>Order has been Placed!</h2>";
        } else {
            echo "<h2>$msg</h2>" . PHP_EOL;
        }
        mysqli_close($DBC); //close the connection once done
    }
    ?>

    <div id="body" class="contact">
        <div class="header">
            <div>
                <h1>Place an Order</h1>
            </div>
        </div>
    </div>

    <form method="POST" action="placeorder.php">
        <p>
            <label for="pizza">Pizza name: </label>
            <input type="text" id="pizza" name="pizza" maxlength="15" required>
        </p>
        <p>
            <label for="description">Description: </label>
            <input type="text" id="description" size="100" name="description" maxlength="200" required>
        </p>
        <p>
            <label for="pizzatype">Pizza type: </label>
            <input type="radio" id="pizzatype" name="pizzatype" value="S" checked> Standard
            <input type="radio" id="pizzatype" name="pizzatype" value="V"> Vegetarian
        </p>
        <p>
            <label for="price">Price $(5.0 to 50.0): </label>
            <input type="number" id="price" name="price" min="5" max="50" value="5.0" step="0.10" required>
        </p>

        <input type="submit" name="submit" value="Add">
        <a href="/As2_5029791/">[Cancel]</a>
    </form>
</body>
<?php
include "footer.php";
?>

</html>