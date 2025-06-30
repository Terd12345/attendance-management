<?php
session_start();
if (!isset($_SESSION['user_id'], $_SESSION['full_name'], $_SESSION['role'])) {
    header("Location: ../index.php?error=" . urlencode("You must log in to access the dashboard"));
    exit();
}

include('../classes/empTemplate.class.php');

$view = new viewEmp();
$view->renderHeader($_SESSION['full_name'], $_SESSION['role']);
?>

<link rel="stylesheet" href="../assets/css/dashboard.css" />

<style>
    
</style>

<div class="center-container">
    <h1>Attendance Page</h1>
    <video id="video" width="320" height="240" autoplay></video>
    <canvas id="canvas" width="320" height="240" style="display: none;"></canvas>
    
    <input type="hidden" id="employee_id" value="<?php echo $_SESSION['user_id']; ?>">
    <!-- <input type="text" id="remarks" placeholder="Optional remarks"> -->
    <button onclick="captureAndSubmit()">Time In</button>
    
    <p id="response" style="margin-top: 15px;"></p>
</div>

<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');

    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(err => {
            console.error("Camera access error:", err);
        });

    function captureAndSubmit() {
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageData = canvas.toDataURL('image/png');
        const employee_id = document.getElementById('employee_id').value;
        // const remarks = document.getElementById('remarks').value;

        fetch('../classes/timeInHandler.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                image: imageData,
                employee_id: employee_id,
               
            })
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('response').textContent = data.message;
        })
        .catch(err => {
            console.error(err);
            document.getElementById('response').textContent = "An error occurred.";
        });
    }
</script>

<?php $view->renderFooter(); ?>
