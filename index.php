<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
</head>
<body>

<?php
    include('includes/classloader.inc.php');

    $errorMessage = ""; // Initialize an empty error message

    if (isset($_GET['error'])) {
      $errorMessage = htmlspecialchars($_GET['error']);
  }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $control = new control();
        $errorMessage = $control->handleLogin($email, $password);
    }

    $obj = new view();
    $obj->LoginDisplay($errorMessage); // Pass the error message to the view
    ?>

  <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
</body>
</html>