<?php
  session_start();
  require_once "database.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css?c=<?php echo time(); ?>">
    <link rel="icon" href="Images/logoOne.ico">
</head>
<body>

    
<?php

    require_once "header.php";

    $nameToSearch = $_COOKIE["user"];

    //run an sql statement that displays the book ISBN and the date the book was reserved. It does this where it finds the username of the current user matches the username column in the reservations table
    $sql = "SELECT reservations.ISBN, reservations.ReservedDate
            FROM reservations
            WHERE reservations.Username = '$nameToSearch';
    ";

    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        echo "<table border = '5'>";
            echo "<tr><td>";
            echo "ISBN";
            echo "Reservation Date";
            echo "</tr>";

            while($row = $result->fetch_assoc())
            {
                //bruh fix print statements to be just the 
                echo "<tr><td>";
                echo (htmlentities($row["ISBN"]));
                echo "</td><td>";
                echo (htmlentities($row["ReservedDate"]));
                echo "</td><td>";
                //make a button for unreserve that passes the book ISBN and goes to the unreserve page
                echo('<form method="post" action="unreserve.php">');
                echo('<input type="hidden" name="bookISB" value="' .$row["ISBN"]. '">');
                echo('<input type="submit" value="Unreserve">');
                echo('</form>'); 
                echo "</tr>\n";
            }
    }
    
?>

<?php
  require_once "footer.php";
?>



</body>
</html>