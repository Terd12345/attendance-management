<?php
require_once 'timeInController.class.php';

date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $imageData = $_POST['image'] ?? null;

    if (!$employee_id || !$imageData) {
        echo json_encode(['status' => 'error', 'message' => 'Missing data']);
        exit;
    }

    $controller = new TimeInController();

    if (!$controller->canTimeOut($employee_id)) {
        echo json_encode(['status' => 'error', 'message' => 'You must time in before timing out, or you have already timed out today.']);
        exit;
    }

    $uploadDir = '../uploads/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $imageName = uniqid() . '_timeout.png';
    $imagePath = $uploadDir . $imageName;

    $imageBase64 = explode(',', $imageData)[1];
    file_put_contents($imagePath, base64_decode($imageBase64));

    $result = $controller->timeOut($employee_id, $imageName);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => "Time out successful"]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save time out']);
    }
}
