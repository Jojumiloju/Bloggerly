<?php

require './connection.php';

session_start();

if(isset($_SESSION['user_id'])){
    header('location: dashboard.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
    $name = $first_name . ' ' . $last_name;
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $checkEmail = "SELECT email FROM bloggerly_users WHERE email = '$email'";
    $result = mysqli_query($connection, $checkEmail);

    if(mysqli_num_rows($result) > 0){
        echo "Email already exists";
        exit();
    }else{
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO bloggerly_users (Name, Email, Password) VALUES ('$name', '$email', '$hashedpassword')";
        $result = mysqli_query($connection, $sql);
        if($result){
            header('location: signIn.php');
            exit();
        }else{
            echo "Error: " . mysqli_error($connection);
            exit();
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloggerly | Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
        <h1 style="font-size: 4rem; margin-left: 12rem; padding: 2rem">Sign Up </h1>
    
    
    <div style="margin-right: 12rem;margin-left: 12rem; box-shadow: 1px 8px 12px rgba(0,0,0,0.3); border-radius: 2rem; padding: 3rem;">
        <form class="row g-3" action="" method="POST">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">First Name</label>
                <input type="text" class="form-control" id="inputEmail4" name='first_name'>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="inputPassword4" name='last_name'>
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputAddress" placeholder="Type in your email address" name="email" >
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputAddress2" placeholder="Type in your password" name="password">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" >Sign Up</button>
            </div>
        </form>
    </div>

</body>
</html>