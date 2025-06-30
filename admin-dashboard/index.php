<?php
include '../classes/adminTemplate.class.php';
include '../includes/classloader.inc.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php?error=" . urlencode("Unauthorized access."));
    exit();
}

$view = new viewAdmin();
$view->renderHeader($_SESSION['full_name'], $_SESSION['role']); 



$control = new control();
$totalemp = $control->getTotalEmployees();
$presentToday = $control->getPresentToday(); 
$absentToday = $control->getAbsentToday();
$recentLogs = $control->getRecentAttendanceLogs();

?>


<link rel="stylesheet" href="../assets/css/adminDashboard.css" />


<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Employees</h5>
                <p class="card-text display-6"><?php echo $totalemp; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Present Today</h5>
                <p class="card-text display-6 text-success"><?php echo $presentToday; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Absent Today</h5>
                <p class="card-text display-6 text-danger"><?php echo $absentToday; ?></p>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <h4>Recent Attendance Logs</h4>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Employee Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentLogs as $log): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($log['log_date']); ?></td>
                        <td><?php echo htmlspecialchars($log['full_name']); ?></td>
                        <td>
                            <?php if ($log['status'] === 'Present' || $log['status'] === 'Late'): ?>
                                <span class="badge bg-success"><?php echo htmlspecialchars($log['status']); ?></span>
                            <?php else: ?>
                                <span class="badge bg-danger"><?php echo htmlspecialchars($log['status']); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<?php
    $view->renderFooter();
?>