<?php
  session_start();
  require_once "database.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--using bootstrap for basic stuff-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css?c=<?php echo time(); ?>">
    <link rel="icon" href="Images/logoOne.ico">
</head>
<body>

<?php
  //require the navbar header instead of putting it in every page
  require_once "header.php";

   //if the user is not logged in, prompt them to log in
   if (! isset($_SESSION["account"]))
   {
    ?>
    <p>Please <a href="login.php">Login</a></p>
    <?php
   }
?> 
 
 
<?php
  if (isset($_SESSION["working"]))
  {
    if ($_SESSION["working"] == "Logged In")
    {
      echo "Welcome ".$_SESSION["account"]."!<br>";
    }
    else
    {
      header("Location: login.php");
    }
  }

?>

<!--cards that link to the other pages and display an image little information-->
    <div class="container">
      <!--place all cards in one row to keep them in one line -->
      <div class="row">
          <!--CARD 1 STARTS-->
          <div class="col">
            <!--each card has a height of 100 -->
              <div class="card h-100">
                  <img src="Images/books.jpg" class="card-img-top" alt="Image of books">
                  <div class="card-body">
                    <h5 class="card-title">View</h5>
                    <p class="card-text">View our catalogue and reserve a book</p>
                    <a href="viewBooks.php" class="btn">Click here</a>
                  </div>
                </div>
          </div>  <!--CARD 1 ENDS-->

          <!--CARD 2 STARTS-->
          <div class="col">
            <div class="card h-100">
                <img src="Images/searchbook.jpg" class="card-img-top" alt="Image of a man looking through a book shelf">
                <div class="card-body">
                  <h5 class="card-title">Search</h5>
                  <p class="card-text">Search for a book and reserve it</p>
                  <a href="search.php" class="btn">Click here</a>
                </div>
              </div>
        </div>  <!--CARD 2 ENDS-->

        <!--CARD 3 STARTS-->
        <div class="col">
            <div class="card h-100">
                <img src="Images/booksinhand.jpg" class="card-img-top" alt="Image of someone holding a pile of books">
                <div class="card-body">
                  <h5 class="card-title">Your Reserved Books</h5>
                  <p class="card-text">View all your reserved books. Only if logged in!</p>
                  <a href="viewReserved.php" class="btn">Click here</a>
                </div>
            </div>
        </div>  <!--CARD 3 ENDS-->

      </div>  <!--ROW DIV ENDS-->
    </div>  <!--VERTICAL CARDS END-->

  <!--place breaks to make space before the footer -->
  <br>
  <br>




<?php
  //require the footer file instead typing it out in every page
  require_once "footer.php"; 
?>

    
</body>
</html>