<?php
include "header.php";
include "menu.php";
include "checksession.php";
checkUser();
isAdmin();

include "config.php"; //load in any variables
$DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);

//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. " . mysqli_connect_error();
    exit; //stop processing the page further
}

//prepare a query and send it to the server
$query = 'SELECT orderID,orderDate,orderTime,customerID FROM orders ORDER BY orderDate';

$result = mysqli_query($DBC, $query);
$rowcount = mysqli_num_rows($result);
?>

<div id="body">
    <div class="header">
        <div>
            <h1>Orders List</h1>
        </div>
    </div>
</div>
<br><br>

<table border="1">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Date</th>
            <th>Time</th>
            <th>Customer ID</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php

    //makes sure we have items
    if ($rowcount > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['orderID'];
            $oDate = $row['orderDate'];
            $otime = $row['orderTime'];
            $custID = $row['customerID'];
            echo '<tr><td>' . $id . '</td><td>' . $oDate . '</td><td>' . $otime . '</td><td>' . $custID . '</td>';
            echo     '<td><a href="vieworder.php?id=' . $id . '">[view]</a>';
            echo         '<a href="editorder.php?id=' . $id . '">[edit]</a>';
            echo         '<a href="deleteorder.php?id=' . $id . '">[delete]</a></td>';
            echo '</tr>' . PHP_EOL;
        }
    } else echo "<h2>No items found!</h2>"; //suitable feedback

    mysqli_free_result($result); //free any memory used by the query
    mysqli_close($DBC); //close the connection once done

    echo "</table><br>";

    //----------- page content ends here
    include "footer.php";
    ?>