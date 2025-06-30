<?php

class model extends connection{

    protected function saveUser($fullName, $email, $hashedPassword, $role, $employeeId){
        $pdo = $this->view();
        $stmt = $pdo->prepare("INSERT INTO users(full_name, email, password, role, employee_id) VALUES (:full_Name, :email, :password, :role, :employee_id)");
        $stmt->bindParam(':full_Name', $fullName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':employee_id', $employeeId);
        return $stmt->execute();
    }


    protected function getEmployeeByEmail($email) {
        $pdo = $this->view();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    protected function getAdminByEmail($email) {
        $pdo = $this->view();
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }
}