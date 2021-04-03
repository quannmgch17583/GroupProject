
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/mycss.css">

    <title>Login</title>
</head>
<body>
      <form class="box" action="php/check-login.php" method="post">
        <h1>Academic Login</h1>
        <?php if (isset($_GET['error'])) { ?> 
        <div class="alert" role="alert">
          <?=$_GET['error']?>
        </div> 
        <?php } ?>
          <input type="text" name="username" placeholder="Username">
          <input type="password" name="password" placeholder="Password">
          <input type="submit" name="" value="Login">
      </form>



</body>
</html>
