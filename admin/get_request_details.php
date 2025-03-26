<?php
session_start();
include '../config/config.php';

class Details extends Connection {
    public function getDetails() {
        if(isset($_POST['id'])) {
            $sql = "SELECT * FROM request WHERE id = ?";
            $stmt = $this->conn()->prepare($sql);
            $stmt->execute([$_POST['id']]);
            $row = $stmt->fetch();
            
            // Return the details section HTML
            include 'details_template.php';
        }
    }
}

$details = new Details();
$details->getDetails();