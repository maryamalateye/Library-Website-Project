<?php
  session_start();
  require_once "database.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css?c=<?php echo time(); ?>">
    <link rel="icon" href="Images/logoOne.ico">
</head>
<body>


<?php
    require_once "header.php";

    $sql = "SELECT ISBN, Title, Author, Edition, Year, Category, Reservation FROM book";

    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        echo "<table border = '5'>";
        echo "<tr><td>";
        echo "ISBN";
        echo "</td><td>";
        echo "Title";
        echo "</td><td>";
        echo "Author";
        echo "</td><td>";
        echo "Edition";
        echo "</td><td>";
        echo "Year";
        echo "</td><td>";
        echo "Category";
        echo "</td><td>";
        echo "Reservation";
        echo "</tr>";
        
        while($row = $result->fetch_assoc())
        {
            echo "<tr><td>";
            echo (htmlentities($row["ISBN"]));
            echo "</td><td>";
            echo (htmlentities($row["Title"]));
            echo "</td><td>";
            echo (htmlentities($row["Author"]));
            echo "</td><td>";
            echo (htmlentities($row["Edition"]));
            echo "</td><td>";
            echo (htmlentities($row["Year"]));
            echo "</td><td>";
            echo (htmlentities($row["Category"]));
            echo "</td><td>";
            //make reserve button a form to be submitted with the name reserveBook
            echo("<form method='post' action='reserveBook.php'>");
              //if the book is reserved, display button that is unclickable and the word Reserved
              if ($row["Reservation"] == 1)
              {
                echo('<input type="submit" value="Reserved" disabled>');
              }
              //if the book is not reserved, place a button that when clicked, goes to the page reserveBook.php and passes the ISBN of the book (primary key) to that page to be used
              elseif($row["Reservation"] == 0)
              {
                echo('<input type="hidden" name="bookISBN" value="' .$row["ISBN"] . '">');
                echo('<input type="submit" value="Reserve">');
                echo('</form>');
              }
            echo "</tr>\n";
        }
    //end if for if results are found
    }

    else
    {
        echo "0 results";
    }

    $conn->close();

?>
    


</body>
</html>