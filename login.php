<?php
session_start();
if (isset($_SESSION["user"])) {
   if($_SESSION["user"]=="yes"){
    header("Location: index.php");
    exit();
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $username = $_POST["username"];
           $password = $_POST["password"];
            require_once "connection.php";
            $sql = "SELECT * FROM login WHERE username = '$username' LIMIT 1";
            $result = mysqli_query($con, $sql);
            // $user = mysqli_fetch_assoc($result);
            $error = mysqli_error($con);
            echo "<script> console.log( $error ) </script>";
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if ($password ===$user["password"]) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    exit();
                }else{
                    $user_pass = $user['password'];
                    echo "<div class='alert alert-danger'>Password does not match $password $user_pass</div>";
                }
            }else{
                $error = mysqli_error($con);
                echo "<div class='alert alert-danger'>username does not match data </div>";
                echo "<script> console.log( $error ) </script>";
            }
        }
        ?>
      <form action="login.php" method="post">
        <div class="form-group">
            <input type="text" placeholder="Enter username:" name="username" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Enter Password:" name="password" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>
      </form>
     <div><p>Not registered yet , Contact admin</p></div>
    </div>
</body>
</html>