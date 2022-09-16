<?php
include "header.php";
include "menu.php";
include "checksession.php";
isAdmin();
checkUser();

include "config.php"; //load in any variables
$DBC = mysqli_connect("127.0.0.1", DBUSER, DBPASSWORD, DBDATABASE);

//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. " . mysqli_connect_error();
    exit; //stop processing the page further
}

//prepare a query and send it to the server
$query = 'SELECT bookingID,customerID,telephone,bookingdate,bookingtime,people FROM booking ORDER BY bookingdate';

$result = mysqli_query($DBC, $query);
$rowcount = mysqli_num_rows($result);
?>

<div id="body">
    <div class="header">
        <div>
            <h1>Reservations List</h1>
        </div>
    </div>
</div>
<br><br>
<table border="1">
    <thead>
        <tr>
            <th>BookingID</th>
            <th>CustomerID</th>
            <th>Telephone</th>
            <th>Bookingdate</th>
            <th>Bookingtime</th>
            <th>People</th>
            <th>Action</th>
        </tr>
    </thead>

    <?php

    //makes sure we have food items
    if ($rowcount > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['bookingID'];
            $bdate = $row['customerID'];
            $phone = $row['telephone'];
            $bdate = $row['bookingdate'];
            $btime = $row['bookingtime'];
            $peepz = $row['people'];
            echo '<tr><td>' . $id . '</td><td>' . $bdate . '</td><td>' . $phone . '</td><td>' . $bdate . '</td><td>' . $btime . '</td><td>' . $peepz . '</td>';
            echo     '<td><a href="viewbooking.php?id=' . $id . '">[view]</a>';
            echo         '<a href="editbooking.php?id=' . $id . '">[edit]</a>';
            echo         '<a href="deletebooking.php?id=' . $id . '">[delete]</a></td>';
            echo '</tr>' . PHP_EOL;
        }
    } else echo "<h2>No reservations found!</h2>"; //suitable feedback

    mysqli_free_result($result); //free any memory used by the query
    mysqli_close($DBC); //close the connection once done

    echo "</table><br>";
    ?>

    <?php
    //----------- page content ends here
    include "footer.php";
    ?>