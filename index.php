<?php 

  // spl_autoload_register(function($class) {
  //     require $class . ".php";
  // });

  require('File.php');
  require('Validate.php');

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $form = new Validate($_POST , $_FILES);
    $errors = $form->validate();

    // print_r($errors);
  }
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-12">
        <form action="" method="post" enctype="multipart/form-data">
          <input type="text" name="username" placeholder="username" class="form-control my-3" value="<?= $_POST['username'] ?? '' ?>">
          <small class="text-danger fw-bold my-3">
            <?= $errors['username'] ?? '' ?>
          </small>
          <input type="text" name="email" placeholder="email" class="form-control my-3" value="<?= $_POST['email'] ?? '' ?>">
          <small class="text-danger fw-bold my-3">
            <?= $errors['email'] ?? '' ?>
          </small>
          <input type="file" name="img" class="form-control my-3">
          <small class="text-danger fw-bold my-3">
            <?= $errors['img'] ?? '' ?>
          </small>
          <button class="btn btn-primary d-block mt-3">submit</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>