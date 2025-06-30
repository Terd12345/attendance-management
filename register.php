<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>


    <?php
        include('includes/classloader.inc.php');

        $message = "";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullName = $_POST['full_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $role = $_POST['role'];
    
            $control = new control();
            $message = $control->handleSignup($fullName, $email, $password, $confirmPassword, $role);
        }
        
        $obj = new view();
        $obj->SignupDisplay($message);

    ?>



    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
</body>
</html>