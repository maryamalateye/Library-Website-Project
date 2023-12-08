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
    <title>Unreserve</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css?c=<?php echo time(); ?>">
    <link rel="icon" href="Images/logoOne.ico">

</head>
<body>
    
</body>
</html>

<?php
    $bookisb = $_POST["bookISB"];
    $username = $_COOKIE["user"];
    
    //delete row from reservations table with the matching book isbn
    $sql = "DELETE FROM reservations WHERE ISBN='$bookisb'";

    $conn->query($sql);

    //change the book table to show that the book is no longer reserved
    $changebooksql = "UPDATE book SET Reservation = 0 WHERE ISBN = '$bookisb'";

    if($conn->query($changebooksql))
    {
        echo "Book unreserved";
    }
    else
    {
        echo "Error:".$conn->error;
    }


    require_once "footer.php";
?>