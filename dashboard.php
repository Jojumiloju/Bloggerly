<?php

require 'connection.php';
session_start();
$id = $_SESSION['user_id'];

if(!$id){
    header('location: signIn.php');
    exit();
}

// Get current User's info
$sql = "SELECT * FROM bloggerly_users WHERE id = '$id'";
$result = mysqli_query($connection, $sql);

if($result){
    $user = mysqli_fetch_assoc($result);
}else{
    echo "Error: " . mysqli_error($connection);
    exit();
}

// Get current User's Blogs
$sql = "SELECT * FROM blog_table WHERE user_id = '$id'";
$result = mysqli_query($connection, $sql);

if($result){
    $blogs = [];
    while($blog = mysqli_fetch_assoc($result)){
        array_push($blogs, $blog);
    }
    
}else{
    echo "Error: " . mysqli_error($connection);
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet/css" href="./footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php include './navbar.php' ?>
    <div class="dropdown" style="margin: 1rem;">
        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $user['Name']?>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="createBlog.php">Create a new blog</a></li>
            <li><a class="dropdown-item" href="./account.php">Account</a></li>
            <li><a class="dropdown-item" href="./logout.php" style="color: red;">Logout</a></li>
        </ul>
    </div>

    <h1><?php echo $user['Name']?>'s Dashboard</h1><br><br><br>

    <?php foreach($blogs as $blog) { ?>
        <div style="margin-right: 12rem;margin-left: 12rem; box-shadow: 1px 8px 12px rgba(0,0,0,0.3); border-radius: 2rem; padding: 3rem;margin-bottom: 10rem;"> 
            <h1 style="color: #0d6efd">Title: <?php echo $blog['title'] ?></h1>
            <h3 style="color: #0d6efd">Author: <?php echo $blog['author'] ?></h4><br>
            <h4 style="color: grey"><?php echo $blog['content'] ?></h6>
            <div style="dispaly: flex; justify-items: right;">
                <small>Timestamp: <?php echo $blog['date_time'] ?></small>
                <p>Category: <a href="./categoryList.php?category=<?php echo $blog['category'] ?>" style="color: black"><?php echo $blog['category'] ?></a></p>
            </div>
        </div>
    <?php }?>
    
    <?php include './footer.php' ?>
</body>
</html>