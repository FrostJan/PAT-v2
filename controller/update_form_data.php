<?php
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    
    $department = $_POST['department'];
    $activityorpurpose = $_POST['activityorpurpose'];
    $division = $_POST['division'];
    $numberofattendees = $_POST['numberofattendees'];
    $datefilled = $_POST['datefilled'];
    $timeneeded = $_POST['timeneeded'];
    $dateneeded = $_POST['dateneeded'];
    $personincharge = $_POST['personincharge'];
    $contactnumber = $_POST['contactnumber'];

    $pat = isset($_POST['pat']) ? 'yes' : 'no';
    $emcroom = isset($_POST['emcroom']) ? 'yes' : 'no';
    $tvroom = isset($_POST['tvroom']) ? 'yes' : 'no';
    $institutional = isset($_POST['institutional']) ? 'yes' : 'no';
    $curricular = isset($_POST['curricular']) ? 'yes' : 'no';
    $outsidegroup = isset($_POST['outsidegroup']) ? 'yes' : 'no';
    $cocurricular = isset($_POST['cocurricular']) ? 'yes' : 'no';
    $extracurricular = isset($_POST['extracurricular']) ? 'yes' : 'no';

    $conn = new Connection();
    $sql = "UPDATE request SET 
            department = ?, 
            activityorpurpose = ?, 
            division = ?, 
            numberofattendees = ?,
            datefilled = ?,
            timeneeded = ?,
            dateneeded = ?,
            personincharge = ?,
            contactnumber = ?,
            pat = ?,
            emcroom = ?,
            tvroom = ?,
            institutional = ?,
            curricular = ?,
            outsidegroup = ?,
            cocurricular = ?,
            extracurricular = ?
            WHERE id = ?";
            
    $stmt = $conn->conn()->prepare($sql);

    if ($stmt->execute([
        $department, 
        $activityorpurpose, 
        $division, 
        $numberofattendees,
        $datefilled,
        $timeneeded,
        $dateneeded,
        $personincharge,
        $contactnumber,
        $pat,
        $emcroom,
        $tvroom,
        $institutional,
        $curricular,
        $outsidegroup,
        $cocurricular,
        $extracurricular,
        $id
    ])) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
