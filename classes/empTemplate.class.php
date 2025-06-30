<?php

class viewEmp {

    public function renderHeader($fullName, $role) {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <title>Dashboard</title>
            <link rel="stylesheet" href="../assets/css/headerEmp.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
            <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
        </head>
        <body>
        <div class="dashboard-layout">
            <!-- Sidebar -->
            <aside class="sidebar">
                <h2>Attendance Portal</h2>
                <ul class="sidebar-menu">
                    <li><a href="index.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="timeIn.php"><i class="fa-solid fa-clock"></i> Time-in</a></li>
                    <li><a href="timeOut.php"><i class="fa-solid fa-hourglass-start"></i> Time-out</a></li>
                    <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </aside>
            <!-- Main Content -->
            <div class="main-content">
                <header class="main-header">
                    <div class="user-profile">
                        ' . htmlspecialchars($fullName) . ' | ' . htmlspecialchars($role) . '
                    </div>
                </header>
                <main>
        ';
    }

    public function renderFooter() {
        echo '
                </main>
            </div>
        </div>
        </body>
        </html>
        ';
    }
}