<?php

include '../classes/adminTemplate.class.php';
include '../includes/classloader.inc.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php?error=" . urlencode("Unauthorized access."));
    exit();
}

$view = new viewAdmin();
$view->renderHeader($_SESSION['full_name'], $_SESSION['role']); // Render the header



$control = new control();
$employees = $control->getAllEmployees();

?>


<link rel="stylesheet" href="../assets/css/adminDashboard.css" />

<h1>Attendance Page</h1>


<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?php echo htmlspecialchars($employee['employee_id']); ?></td>
                    <td><?php echo htmlspecialchars($employee['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($employee['email']); ?></td>
                    <td><?php echo htmlspecialchars($employee['role']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php
$view->renderFooter();
?>