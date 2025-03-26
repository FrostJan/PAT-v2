<?php
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year = $_POST['year'];
    $month = $_POST['month'];

    $conn = new Connection();
    $pdo = $conn->conn();

    // Build the query dynamically based on the input
    $conditions = ["status IN ('Approved', 'Declined')"]; // Always filter by status
    $params = [];

    if ($year !== 'all') {
        $conditions[] = "YEAR(datefilled) = ?";
        $params[] = $year;
    }

    if ($month !== 'all') {
        $conditions[] = "MONTH(datefilled) = ?";
        $params[] = $month;
    }

    $whereClause = 'WHERE ' . implode(' AND ', $conditions);

    // Query for approved requests
    $sqlApproved = "SELECT COUNT(id) AS approved FROM request $whereClause AND status = 'Approved'";
    $stmtApproved = $pdo->prepare($sqlApproved);
    $stmtApproved->execute($params);
    $approved = $stmtApproved->fetchColumn();

    // Query for declined requests
    $sqlDeclined = "SELECT COUNT(id) AS declined FROM request $whereClause AND status = 'Declined'";
    $stmtDeclined = $pdo->prepare($sqlDeclined);
    $stmtDeclined->execute($params);
    $declined = $stmtDeclined->fetchColumn();

    // Return the data as JSON
    echo json_encode(['approved' => $approved, 'declined' => $declined]);
}
?>