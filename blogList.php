 <?php

 require './connection.php';
 session_start();


// Get all blogs
$sql = "SELECT * FROM blog_table";
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
    <title>Bloggerly | Blog List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 </head>
 <body>
    <?php include './navbar.php' ?>
    <h1 style="padding: 4rem; text-align: center">Blog List</h1>

    <br><br><br>
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