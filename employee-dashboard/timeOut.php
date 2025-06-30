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
    .camera-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 70vh;
        padding: 20px;
    }
    canvas {
        border: 1px solid #ccc;
        border-radius: 10px;
        margin-top: 10px;
    }
    #captureBtn {
        margin-top: 20px;
        padding: 10px 20px;
        border-radius: 8px;
        background-color: #2c3e50;
        color: white;
        border: none;
        cursor: pointer;
    }
</style>

<div class="camera-container">
    <h1>Time Out Page</h1>
    <video id="video" width="320" height="240" autoplay></video>
    <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
    <button id="captureBtn">Time Out</button>
</div>

<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureBtn = document.getElementById('captureBtn');
    const context = canvas.getContext('2d');

    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(error => {
            alert("Camera access is required.");
            console.error(error);
        });

    captureBtn.addEventListener('click', () => {
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageData = canvas.toDataURL('image/png');

        fetch('../classes/timeOutHandler.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                employee_id: '<?php echo $_SESSION['user_id']; ?>',
                image: imageData
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Something went wrong.");
        });
    });
</script>

<?php $view->renderFooter(); ?>
