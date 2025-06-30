<?php
require_once 'attendanceModel.class.php';

class TimeInController extends attendanceModel {

    private $model;

    public function __construct() {
        $this->model = new AttendanceModel();
    }

    public function timeIn($employee_id, $status = 'Present', $imagePath = null) {
        return $this->model->logTimeIn($employee_id, $status, $imagePath);
    }


    public function canTimeOut($employee_id) {
        return $this->model->canTimeOut($employee_id);
    }
    
    public function timeOut($employee_id, $imagePath = null) {
        return $this->model->logTimeOut($employee_id, $imagePath);
    }

    public function markAbsentees() {
        return $this->model->markAbsenteesIfNotYetMarked();
    }
    

}
