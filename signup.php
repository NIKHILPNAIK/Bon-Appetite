<?php
$success = 0;
$user = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "Select * from `registration` where username='$username'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);

        if ($num > 0) {
            // User already exists
            $user = 1;
        } else {
            // Hash the password before storing it in the database
            // $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO `registration` (username, password) VALUES ('$username', '$password')";
            $result = mysqli_query($con, $sql);

            if ($result) {
                // Signup successful
                $success = 1;
            } else {
                die(mysqli_error($con));
            }
        }
    }
}
?>





<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Sign Up Form</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
<?php
if ($user) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Ohh No Sorry!</strong> User already exists
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

}

if ($success) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Signup successful
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}
?>
    <div class="main-wrap">
    <header>
            <a href="index.php" class="logo">Bon Appetite</a>
            <ul class="navlist">
              <li><a href="index.php">Home</a></li>
              <li><a href="Prefernce.html">Prefernce</a></li>

            </ul>
          </header>
        <div class="outer-wrap">
            <h1>Sign Up</h1>
            <hr>

            <form action="signup.php" class="form" method="post">
                <label for="email">Email</label>
                <br>
                <input type="text" placeholder="Email" required name="username">
                <br>
                <label for="password">Password</label>
                <br>
                <input type="password" placeholder="Password" required name="password">
                <br>
                <input type="checkbox" name="check" id="check">
                <span class="rm-me">Remember Me</span>
                <a href="#" class="fg-pa">Forgot Password?</a>
                <br>
                <button type="submit" class="btn">Sign Up</button>
            </form>
            <div class="terms">
                <a href="index.php">Go to Home</a>
                <a href="login.php">Go to Login</a>
            </div>
        </div>
    </div>
</body>
</html>