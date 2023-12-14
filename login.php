<?php
$login = 0;
$invalid = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "select * from registration where username='$username' and password='$password'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $login = 1;
            session_start();
            $_SESSION['username'] = $username;
            header('location:../main.php');
        } else {
            $invalid = 1;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>LOGIN</title>
</head>

<body>
    <?php
    if ($login)
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong>,  You are successfully logged in.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
    if ($invalid)
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error</strong>, Invalid credentials
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
    ?>
    <h1 class="text-center">login to our website</h1>
    <div class="container mt-5">

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" placeholder="Enter your username" name='username'>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" placeholder="Password" name='password'>
            </div>
            <button type="submit" class="btn btn-primary w-100">login</button>
        </form>
    </div>
</body>

</html>