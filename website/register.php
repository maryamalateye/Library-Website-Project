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


    if (isset($_POST['Username']) && isset($_POST['Password']) && isset($_POST['PasswordCheck']) && isset($_POST['FirstName']) && isset($_POST['Surname']) && isset($_POST['AddressLine1']) && isset($_POST['AddressLine2']) && isset($_POST['City']) && isset($_POST['Telephone']) && isset($_POST['Mobile']))
    {
      //check first if username already exists in the system. If yes, don't store anything and display error message saying to use a different username
      $username = $_POST['Username'];

      //sql query that returns any records of existing username
      $checkUser = "SELECT Username FROM user WHERE Username LIKE '$username'";
      $userResult = $conn->query($checkUser);

      //if username already exists in system, display this message
      if ($userResult->num_rows > 0)
      {
        echo "Username already exists! Try again";
        return;
      }

      //check here if passwords match up
      $password1 = $_POST['Password'];
      $password2 = $_POST['PasswordCheck'];

      //if passwords do not match, tell the user
      if($password1 != $password2)
      {
        echo "Passwords do not match! Try again";
        return;
      }

      //if username is unique and passwords match, then add user info to system
      else
      {
        $fname = $_POST['FirstName'];
        $sname = $_POST['Surname'];
        $add1 = $_POST['AddressLine1'];
        $add2 = $_POST['AddressLine2'];
        $city = $_POST['City'];
        $phone = $_POST['Telephone'];
        $mphone = $_POST['Mobile'];

        //add user to the database user table
        $sql = "INSERT INTO user (Username, Password, FirstName, Surname, AddressLine1, AddressLine2, City, Telephone, Mobile) VALUES ('$username', '$password1', '$fname', '$sname', '$add1', '$add2', '$city', '$phone', '$mphone')";

        $conn->query($sql);

        echo "Successfully registered!";
        return;

      }

    } 



?>


<!--Registration form -->
<p>Register User</p>
<form method="post" id="regForm">
    <p>Username:</p>
        <input type="text" name="Username">
    <p>Password:</p>
        <input type="text" name="Password" maxlength="6">
    <p>Enter Password again:</p>
        <input type="text" name="PasswordCheck">
    <p>First name:</p>
        <input type="text" name="FirstName">
    <p>Surname:</p>
        <input type="text" name="Surname">
    <p>Address:</p>
        <input type="text" name="AddressLine1">
    <P>Address Continued:</p>
        <input type="text" name="AddressLine2">
    <p>City:</p>
        <input type="text" name="City">
    <p>Telephone Number:</p>
        <input type="number" name="Telephone">
    <p>Mobile number:</p>
        <input type="number" name="Mobile">
    <p><input type="submit" value="Add User"></p>
</form>

<?php
  require_once "footer.php";
?>

</body>
</html>