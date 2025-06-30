<?php
require_once __DIR__ . '/timeInController.class.php';

date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'] ?? null;
    $imageData   = $_POST['image'] ?? null;

    if (!$employee_id || !$imageData) {
        echo json_encode(['status' => 'error', 'message' => 'Missing data']);
        exit;
    }

    $controller = new TimeInController();

    // Automatically mark absentees if time is past 10:00 AM
    $now = new DateTime();
    $absentCutoff = new DateTime(date('Y-m-d') . ' 10:00:00');
    if ($now >= $absentCutoff) {
        $controller->markAbsentees();
    }

    // Prevent time-in after 10:00 AM
    if ($now >= $absentCutoff) {
        echo json_encode(['status' => 'error', 'message' => 'You are marked absent. Time-in not allowed after 10:00 AM.']);
        exit;
    }

    // Check if already timed in
    if ($controller->hasTimedInToday($employee_id)) {
        echo json_encode(['status' => 'error', 'message' => 'You have already timed in today.']);
        exit;
    }

    // Save image
    $uploadDir = '../uploads/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $imageName = uniqid() . '.png';
    $imagePath = $uploadDir . $imageName;

    $imageBase64 = explode(',', $imageData)[1] ?? '';
    file_put_contents($imagePath, base64_decode($imageBase64));

    // Determine time-in status
    $presentCutoff = new DateTime(date('Y-m-d') . ' 07:00:00');
    $lateCutoff    = new DateTime(date('Y-m-d') . ' 09:00:00');

    if ($now <= $presentCutoff) {
        $status = 'Present';
    } elseif ($now > $presentCutoff && $now <= $lateCutoff) {
        $status = 'Late';
    } else {
        // Shouldn't reach here; handled above
        $status = 'Absent';
    }

    // Save time-in record
    $result = $controller->timeIn($employee_id, $status, $imageName);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => "Time in recorded as '$status'"]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save attendance']);
    }
}
