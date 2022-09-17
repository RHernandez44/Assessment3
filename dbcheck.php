<!DOCTYPE HTML>
<html>

<head>
    <title>Check for DB connection</title>
</head>

<body>
    <?php
    include "config.php"; //load in any variables
    $DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);

    //check if the connection was good
    if (!$DBC) {
        echo "Error: Unable to connect to MySQL.\n" . mysqli_connect_errno() . "=" . mysqli_connect_error();
        exit; //stop processing the page further
    };

    //insert DB code from here onwards
    // show a quick confirmation that we have a connection
    echo "Connectted via " . mysqli_get_host_info($DBC); //show some info on the connection 

    mysqli_close($DBC); //close the connection once done
    ?>
</body>

</html>