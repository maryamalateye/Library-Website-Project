<?php
    session_start();

    unset($_SESSION["account"]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css?c=<?php echo time(); ?>">
    
    <link rel="icon" href="Images/logoOne.ico">
</head>
<body>
 

<?php
    require_once "header.php";

    if (isset($_SESSION["error"]))
    {
        echo('<p style="color:red">Error:'.$_SESSION["error"]."</p>\n");
        unset($_SESSION["error"]);
    }

    session_destroy();
    echo("You are now logged out");

?>

<a href="login.php">Log in</a>

<?php
  require_once "footer.php";
?>

</body>
</html>