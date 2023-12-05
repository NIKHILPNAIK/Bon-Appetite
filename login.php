<?php
$login = 0;
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `registration` WHERE username=? AND password=?";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $num = mysqli_num_rows($result);

            if ($num > 0) {
                $login = 1;
                session_start();
                $_SESSION['username'] = $username;
                header('location:index.php');
            } else {
                $invalid = 1;
            }
        } else {
            // Handle query execution error
            echo "Error executing the query: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Handle prepared statement creation error
        echo "Error creating prepared statement: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>




<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Login Form</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
<?php
if ($invalid){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Ohh No Sorry!</strong>Invalid Data
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

}

if ($login) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Login successful
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}
?>
 <section>
    
    <div class="main-wrap">
    <header>
            <a href="index.php" class="logo">Bon Appetite</a>
            <ul class="navlist">
              <li><a href="index.php">Home</a></li>
              <li><a href="Prefernce.html">Preference</a></li>

            </ul>
          </header>
        <div class="outer-wrap">
            <h1>Login</h1>
            <hr>
            <form action="login.php" class="form" method="post">
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
                <button type="submit" class="btn">Login</button>
            </form>
            <div class="terms">
                <a href="index.php">Go to Home</a>
                <a href="signup.php">Go to Signup</a>
            </div>
        </div>
    </div>
</body>
</html>