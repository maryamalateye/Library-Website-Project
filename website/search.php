<?php
  session_start();
  require_once "database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search for book</title>
    <!--using bootstrap for basic stuff-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css?c=<?php echo time(); ?>">
    <link rel="icon" href="Images/logoOne.ico">
</head>
<body>


<?php
    require_once "header.php";

    //check if a search was submitted through the text search bar
    if (isset($_POST["search"]))
    {

        $searchFor = $_POST['search'];

        //sql function that finds all books with either the title or author name (partial search works)
        $sql = "SELECT * FROM book 
                LEFT JOIN category ON category.CategoryID = book.Category
                WHERE Title LIKE '%$searchFor%' OR Author LIKE '%$searchFor%'";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
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
            { //while loop starts to display results
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
                echo (htmlentities($row["Reservation"]));
                echo "</td><td>";
                 //make reserve button a form to be submitted with the name reserveBook
                echo("<form method='post' action='reserveBook.php'>");
                //if the book is reserved, display unclickable button
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
            //while loop ends
            }
        //if-block for finding results ends here
        }
    //end if-block for text search 
    }

    //start if-block for search submitted through dropbox
    if (isset($_POST["genreSearch"]))
    {
      $dropSearch = $_POST['genreSearch'];
      $dropsql = "SELECT * FROM book
              LEFT JOIN category 
              ON category.CategoryID = book.Category
              WHERE categoryDescription LIKE '$dropSearch'";

      $result = $conn->query($dropsql);

      if ($result->num_rows > 0)
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
              echo (htmlentities($row["Reservation"]));
              echo "</td><td>";
               //make reserve button a form to be submitted with the name reserveBook
              echo("<form method='post' action='reserveBook.php'>");
              //if the book is reserved, display unclickable button
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
              echo "</tr>\n";
          //end while-loop
          }
      }

    //end else if-block where search is done through drop box
    }


    //if no results are found, tell the user
    else
    {
        echo "0 results";
    }

    $conn->close();

?>

<!--search bar here-->
<section id="searchStuff">
  <form method="post">
      <input type="text" name="search">
      <!--make a div for the search button to colour it blue -->
        <input type="submit" value="Search for">
      </div>
  </form>
    <!--drop down box for genres. Returns "genreSearch" and will need to be joined to category table in book table-->
    <form method="post">
      <label for="region"></label>
          <select id="genreSearch" name="genreSearch">
            <option value="" selected disabled hidden>Search by category</option>
            <option value="Health">Health</option>
            <option value="Business">Business</option>
            <option value="Biography">Biography</option>
            <option value="Technology">Technology</option>
            <option value="Travel">Travel</option>
            <option value="Self-Help">Self-Help</option>
            <option value="Cookery">Cookery</option>
            <option value="Fiction">Fiction</option>
          </select>
          <input type="submit" value="Search Genre">
          <br><br>
  </form>
</section>

<?php
  require_once "footer.php";
?>
    
</body>
</html>