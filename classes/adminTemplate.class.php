<?php

class viewAdmin {

public function renderHeader($fullName, $role) {
    echo '
    
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Attendance System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/adminDashboard.css">
</head>
<body>
z

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3">
        <h4 class="text-center mb-4"><i class="fas fa-user-shield"></i> Admin Panel</h4>
        <a href="index.php" class="active"><i class="fas fa-users"></i> Dashboard</a>
        <a href="view-attendance.php"><i class="fas fa-calendar-check"></i> View Employees</a>
        <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    

    <!-- Main Content -->
    <main class="flex-grow-1">
    
    <div class="dashboard-header d-flex justify-content-between align-items-center mb-4">
    <h1>Welcome, ' . htmlspecialchars($fullName) . ' (' . htmlspecialchars($role) . ') </h1>
    <span class="text-muted">Attendance Management System</span>
    </div>

    ';
}

public function renderFooter() {
    echo '

        </main>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
    ';
}

}