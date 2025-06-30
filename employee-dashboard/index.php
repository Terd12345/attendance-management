<?php
include('../classes/empTemplate.class.php');

session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['full_name']) || !isset($_SESSION['role'])) {
    header("Location: ../index.php?error=" . urlencode("You must log in to access the dashboard")); 
    exit();
}

$view = new viewEmp();
$view->renderHeader($_SESSION['full_name'], $_SESSION['role']); // Render the header
?>

<link rel="stylesheet" href="../assets/css/dashboard.css" />

<h1>Dashboard Page</h1>

<?php
$view->renderFooter();
?>