<?php
  setcookie("user_x", "cookiename", time()+3600); //different cookie name here so that when referencing it later it doesnt display username as cookiename
  session_start();
  require_once "database.php";

  //if username and password are both entered
  if (isset($_POST["account"]) && isset($_POST["UPassword"]))
  {
    $uname = ($_POST["account"]);
    $upass = ($_POST["UPassword"]);

    $sql = "SELECT Username, Password FROM user WHERE Username LIKE '$uname';";

    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
      while ($row = $result->fetch_assoc())
      {
        if ($upass == htmlentities($row["Password"]))
        {
          setcookie("user", $uname, time()+3600); //cookie for username, when referencing username later, do $_COOKIE['user'];

          $_SESSION["account"] = $_POST["account"];
          $_SESSION["working"] = "Logged In";
          header('Location: index.php');
          return;
        }
      }
    }

    else
    {
      $_SESSION["error"] = "Incorrect password";
      header('Location: login.php');
      return;
    }


  //end if-case for entering username and password
  }

  else if(count($_POST) > 0)
  {
    $_SESSION["error"] = "Missing information";
    header('Location: login.php');
    return;
  }

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

    if (isset($_SESSION["error"]))
    {
      echo ('<p style="color:red">Error:'.$_SESSION["error"]."</p>\n");
      unset($_SESSION["error"]);
    }
?>
  
<form method="post">
  <p>Username:
    <input type="text" name="account"></p>
  <p>Password:
    <input type="text" name="UPassword"></p>
  <p><input type="submit" value="Log In"></p>
</form>

<a href="register.php"> No account? Register here</a>

<?php
  require_once "footer.php";
?>

</body>
</html>

