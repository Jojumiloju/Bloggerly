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

//Hanlde forms
$errors = ['title' => '', 'author' => '', 'content' => ''];

//Initialize variable
$title = '';
$author = '';
$content = '';
$tags = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $title = mysqli_real_escape_string($connection, $_POST['title']);
        $author = mysqli_real_escape_string($connection, $_POST['author']);
        $content = mysqli_real_escape_string($connection, $_POST['content'] );
        $category = mysqli_real_escape_string($connection, $_POST['category']);
        $currentDate = date('Y-m-d H:i:s');
        if(empty($title)){
            $errors['title'] = 'Title is required';
        }else if(empty($author)){
            $errors['author'] = 'Author is required';
        }else if(empty($content)){
            $errors['content'] = 'Content is required';
        }else{
            // Push values to database
        $sql = "INSERT INTO blog_table (title, author, content, user_id, category, date_time) VALUES ('$title', '$author', '$content', '$id', '$category', '$currentDate')";
        $result = mysqli_query($connection, $sql);
        if($result){
            header('Location: dashboard.php');
            exit;
        }else{
            echo 'Query Error: ' . mysqli_error($connection);
        }
        }

           
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloggerly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php include './navbar.php' ?>

    <!-- User Navigator -->
    <div class="dropdown" style="margin: 1rem;">
        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $user['Name']?>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
            <li><a class="dropdown-item" href="account.php">Account</a></li>
            <li><a class="dropdown-item" href="./logout.php" style="color: red;">Logout</a></li>
        </ul>
    </div>

    <div style="margin-right: 12rem;margin-left: 12rem; box-shadow: 1px 8px 12px rgba(0,0,0,0.3); border-radius: 2rem; padding: 3rem;margin-bottom: 10rem;">
      <form action="createBlog.php" method="post">
        <div class="row mb-3">
          <label for="inputEmail3" class="col-sm-2 col-form-label" name="title">Title</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3" name="title" value="<?php echo htmlspecialchars($title)?>">
            <small style="color: red;"><?php echo $errors['title']?></small>
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Author</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword3" name="author" value="<?php echo htmlspecialchars($author)?>">
            <small style="color: red;"><?php echo $errors['author']?></small>
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Content</label>
          <div class="col-sm-10">
            <textarea id="content" class="form-control" name="content" value="<?php echo htmlspecialchars($content)?>"></textarea>
            <small style="color: red;"><?php echo $errors['content']?></small>
          </div>
        </div>
        <fieldset class="row mb-3" name="category">
          <legend class="col-form-label col-sm-2 pt-0">Category</legend>
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

        <!-- IT 💻 👩‍💻
        Music 🎧 🎵 🎷
        Food 🍔 🍒 🍓 🥦
        Poitics 🏙 💬 ⚖
        News ⛅ 📰 -->

        <button type="submit" class="btn btn-primary" name="action" value="action2">Create Blog</button>
      </form>
    </div>

    

    <?php include './footer.php' ?>
    
</body>
</html>