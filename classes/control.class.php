<?php

class control extends model {

    public function handleSignup($fullName, $email, $password, $confirmPassword, $role) {
        if (empty($fullName) || empty($email) || empty($password) || empty($confirmPassword) || empty($role)) {
            return "All fields are required.";
        }

        if ($password !== $confirmPassword) {
            return "Passwords do not match.";
        }

        $employeeId = 'EMP-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if ($this->saveUser($fullName, $email, $hashedPassword, $role, $employeeId)) {
            return "Registration successful.";
        } else {
            return "Registration failed. Please try again.";
        }

    }


    public function handleLogin($email, $password){

        if(empty($email) || empty($password)){
            return "Email and password are required.";
        }

        $employee = $this->getEmployeeByEmail($email);
        if($employee && password_verify($password, $employee['password'])){
            session_start();
        $_SESSION['user_id'] = $employee['id'];
        $_SESSION['full_name'] = $employee['full_name'];
        $_SESSION['role'] = $employee['role'];

        // Redirect based on role
        if (in_array($employee['role'], ['Data Encoder', 'Accountant', 'Cashier'])) {
            header("Location: employee-dashboard/index.php");
            exit();
        }
        }

        // Check in the admins table
    $admin = $this->getAdminByEmail($email);
    if ($admin && $password == $admin['password']) {
        session_start();
        $_SESSION['user_id'] = $admin['id'];
        $_SESSION['full_name'] = $admin['full_name'];
        $_SESSION['role'] = 'admin';

        // Redirect to admin dashboard
        header("Location: admin-dashboard/index.php");
        exit();
    }
    return "Invalid email or password.";
    }


    public function getTotalEmployees() {
        $pdo = $this->view();
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM users");
        $result = $stmt->fetch();
        return $result['total'];
    }


    public function getPresentToday() {
        $pdo = $this->view();
        $stmt = $pdo->prepare("SELECT COUNT(*) AS present_count FROM attendance_logs WHERE (status = 'Present' OR status = 'Late' ) AND log_date = CURDATE()");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['present_count'];
    }


    public function getAbsentToday() {
        $totalEmployees = $this->getTotalEmployees(); 
        $presentToday = $this->getPresentToday(); 
        return $totalEmployees - $presentToday; 
    }


    public function getRecentAttendanceLogs($limit = 10) {
        $pdo = $this->view();
        $stmt = $pdo->prepare("SELECT al.log_date, u.full_name, al.status 
                               FROM attendance_logs al
                               JOIN users u ON al.employee_id = u.id
                               ORDER BY al.log_date DESC, al.time_in DESC
                               LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllEmployees() {
        $pdo = $this->view();
        $stmt = $pdo->query("SELECT employee_id, full_name, email, role FROM users ORDER BY full_name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}