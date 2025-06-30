<?php

require_once 'connection.class.php';

class AttendanceModel extends connection {

    public function logTimeIn($employee_id, $status = 'Present', $imagePath = null) {
        $sql = "INSERT INTO attendance_logs (employee_id, status, time_in_image)
                VALUES (:employee_id, :status, :imagePath)";

        $stmt = $this->view()->prepare($sql);
        $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':imagePath', $imagePath);

        return $stmt->execute();
    }

    public function hasTimedInToday($employee_id) {
        $stmt = $this->view()->prepare("SELECT COUNT(*) FROM attendance_logs WHERE employee_id = ? AND log_date = CURDATE()");
        $stmt->execute([$employee_id]);
        return $stmt->fetchColumn() > 0;
    }


    
    public function canTimeOut($employee_id) {
        $stmt = $this->view()->prepare("SELECT id FROM attendance_logs WHERE employee_id = ? AND log_date = CURDATE() AND time_out IS NULL");
        $stmt->execute([$employee_id]);
        return $stmt->fetchColumn(); 
    }

    public function logTimeOut($employee_id, $imagePath = null) {
        $stmt = $this->view()->prepare("UPDATE attendance_logs SET time_out = NOW(), time_out_image = ? WHERE employee_id = ? AND log_date = CURDATE()");
        return $stmt->execute([$imagePath, $employee_id]);
    }


    public function markAbsenteesIfNotYetMarked() {
        $today = date('Y-m-d');
    
        $allEmployeesStmt = $this->view()->prepare("SELECT id FROM users");
        $allEmployeesStmt->execute();
        $allEmployees = $allEmployeesStmt->fetchAll(PDO::FETCH_COLUMN);
    
        $presentStmt = $this->view()->prepare("SELECT employee_id FROM attendance_logs WHERE log_date = ?");
        $presentStmt->execute([$today]);
        $loggedToday = $presentStmt->fetchAll(PDO::FETCH_COLUMN);
    

        $absentees = array_diff($allEmployees, $loggedToday);
    
        if (empty($absentees)) {
            return ['status' => 'info', 'message' => 'All employees are already accounted for.'];
        }
    
        $insertStmt = $this->view()->prepare("
            INSERT INTO attendance_logs (employee_id, time_in, status, log_date) 
            VALUES (?, NULL, 'Absent', ?)
        ");
    
        foreach ($absentees as $employee_id) {
            try {
                $insertStmt->execute([$employee_id, $today]);
            } catch (PDOException $e) {
                if ($e->errorInfo[1] == 1062) {
                    // Duplicate entry, skip
                    continue;
                } else {
                    return ['status' => 'error', 'message' => 'Error marking absentees: ' . $e->getMessage()];
                }
            }
        }
    
        return ['status' => 'success', 'message' => 'Absent employees successfully marked.'];
    }
    
    


}
