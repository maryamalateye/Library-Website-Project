<?php
    session_start();
    require_once "database.php";

    require_once "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserved book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css?c=<?php echo time(); ?>">
    <link rel="icon" href="Images/logoOne.ico">
</head>
<body>
    
</body>
</html>

<?php
    $bookISBN = $_POST["bookISBN"]; //passed from the reserve button and assigned to the variable bookISBN to be used easily in sql statement
    $usernameNow = $_COOKIE["user"];    //passed from the cookie when it was set in the login page and assigned to the variable usernameNow to easily add into the sql statement
    $time = date("Y-m-d");  //find today's date and format it to be (YYYY-MM-DD)

    //update reservation table so that book is now reserved and shows username of user who reserved the book and the date of reservation
    $sql = "INSERT INTO reservations (ISBN, Username, ReservedDate) VALUES ('$bookISBN', '$usernameNow', '$time')";

    $conn->query($sql);

    //sql statement to change the reserved column in the book table to show that it is now reserved
    $changeSql = "UPDATE book SET Reservation = 1 WHERE ISBN = '$bookISBN'";

    if($conn->query($changeSql))
    {
        echo "Book reserved";
    }
    else
    {
        echo "Error:".$conn->error;
    }

    $conn->close();

    require_once "footer.php";
?>