<?php

require './connection.php';
session_start();

$blogs = [];
if(isset($_GET['category'])){
    $category = mysqli_real_escape_string($connection, $_GET['category']);
}

if(!empty($category)){
    $sql = "SELECT * FROM blog_table WHERE category = '$category'";
    $result = mysqli_query($connection, $sql);

    if($result){
    while($blog = mysqli_fetch_assoc($result)){
        array_push($blogs, $blog);
    }
    
    }else{
    echo "Error: " . mysqli_error($connection);
    exit();
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $category = mysqli_real_escape_string($connection, $_POST['category']);
    // Get all blogs
    $sql = "SELECT * FROM blog_table WHERE category = '$category'";
    $result = mysqli_query($connection, $sql);

    if($result){
    while($blog = mysqli_fetch_assoc($result)){
        array_push($blogs, $blog);
    }
    
    }else{
    echo "Error: " . mysqli_error($connection);
    exit();
    }
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
   <h1 style="padding: 4rem; text-align: center">Category List</h1>

   <form action="categoryList.php" style="padding: 2rem" method="post">
   <fieldset class="row mb-3" name="category">
          <legend class="col-form-label col-sm-2 pt-0">Filter by Category</legend>
          <div class="col-sm-10">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="category" id="gridRadios1" value="IT" checked>
              <label class="form-check-label" for="gridRadios1">
                IT 💻 👩‍💻
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="category" id="gridRadios2" value="Music">
              <label class="form-check-label" for="gridRadios2">
                Music 🎧 🎵 🎷
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="category" id="gridRadios2" value="Food">
              <label class="form-check-label" for="gridRadios2">
                Food 🍔 🍒 🍓 🥦
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="category" id="gridRadios2" value="Politics">
              <label class="form-check-label" for="gridRadios2">
                Poitics 🏙 💬 ⚖
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="category" id="gridRadios2" value="News">
              <label class="form-check-label" for="gridRadios2">
                News ⛅ 📰
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="category" id="gridRadios2" value="Entertainment">
              <label class="form-check-label" for="gridRadios2">
                Entertainment 🎥 🎬
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="category" id="gridRadios2" value="Sport & Fitness">
              <label class="form-check-label" for="gridRadios2">
                Sport & Fitness 🏀 🥊 🎯
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="category" id="gridRadios2" value="Arts $ Crafts">
              <label class="form-check-label" for="gridRadios2">
                Arts & Crafts 🎨 🎭
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="category" id="gridRadios2" value="Science">
              <label class="form-check-label" for="gridRadios2">
                Science 🧬 🧪 🩺
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="category" id="gridRadios2" value="Games">
              <label class="form-check-label" for="gridRadios2">
                Games 🕹 🎲 🏆
              </label>
            </div>
        </fieldset>
        <button type="submit" class="btn btn-primary" name="">Filter</button>
   </form>

   <br><br><br>
   <?php foreach($blogs as $blog) { ?>
       <div style="margin-right: 12rem;margin-left: 12rem; box-shadow: 1px 8px 12px rgba(0,0,0,0.3); border-radius: 2rem; padding: 3rem;margin-bottom: 10rem;"> 
           <h1 style="color: #0d6efd">Title: <?php echo $blog['title'] ?></h1>
           <h3 style="color: #0d6efd">Author: <?php echo $blog['author'] ?></h4><br>
           <h4 style="color: grey"><?php echo $blog['content'] ?></h6>
           <div style="dispaly: flex; justify-items: right;">
               <small>Timestamp: <?php echo $blog['date_time'] ?></small>
               <p>Category: <a href="" style="color: black"><?php echo $blog['category'] ?></a></p>
           </div>
       </div>
   <?php }?>


   <?php include './footer.php' ?>
</body>
</html>