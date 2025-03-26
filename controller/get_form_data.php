<?php
include '../config/config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $conn = new Connection();
    $sql = "SELECT * FROM request WHERE id = ?";
    $stmt = $conn->conn()->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    if ($row) {
        echo '
        <input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Department</label>
                    <input type="text" class="form-control" name="department" value="' . htmlspecialchars($row['department']) . '" required>
                </div>
                <div class="form-group">
                    <label>Activity/Purpose</label>
                    <input type="text" class="form-control" name="activityorpurpose" value="' . htmlspecialchars($row['activityorpurpose']) . '" required>
                </div>
                <div class="form-group">
                    <label>Division</label>
                    <input type="text" class="form-control" name="division" value="' . htmlspecialchars($row['division']) . '" required>
                </div>
                <div class="form-group">
                    <label>Number of Attendees</label>
                    <input type="number" class="form-control" name="numberofattendees" value="' . htmlspecialchars($row['numberofattendees']) . '" required>
                </div>
                <div class="form-group">
                    <label>Date Filled</label>
                    <input type="date" class="form-control" name="datefilled" value="' . htmlspecialchars($row['datefilled']) . '" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Time Needed</label>
                    <input type="text" class="form-control" name="timeneeded" value="' . htmlspecialchars($row['timeneeded']) . '" required>
                </div>
                <div class="form-group">
                    <label>Date Needed</label>
                    <input type="date" class="form-control" name="dateneeded" value="' . htmlspecialchars($row['dateneeded']) . '" required>
                </div>
                <div class="form-group">
                    <label>Person in Charge</label>
                    <input type="text" class="form-control" name="personincharge" value="' . htmlspecialchars($row['personincharge']) . '" required>
                </div>
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" class="form-control" name="contactnumber" value="' . htmlspecialchars($row['contactnumber']) . '" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h4>Services to be Provided</h4>
                <div class="checkbox-inline">
                    <label>
                        <input type="checkbox" name="pat" value="yes" ' . ($row['pat'] == 'yes' ? 'checked' : '') . '> PAT
                    </label>
                </div>
                <div class="checkbox-inline">
                    <label>
                        <input type="checkbox" name="emcroom" value="yes" ' . ($row['emcroom'] == 'yes' ? 'checked' : '') . '> EMC ROOM
                    </label>
                </div>
                <div class="checkbox-inline">
                    <label>
                        <input type="checkbox" name="tvroom" value="yes" ' . ($row['tvroom'] == 'yes' ? 'checked' : '') . '> TV ROOM
                    </label>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 15px;">
            <div class="col-md-12">
                <h4>Classification of Activity</h4>
                <div class="checkbox-inline">
                    <label>
                        <input type="checkbox" name="institutional" value="yes" ' . ($row['institutional'] == 'yes' ? 'checked' : '') . '> Institutional
                    </label>
                </div>
                <div class="checkbox-inline">
                    <label>
                        <input type="checkbox" name="curricular" value="yes" ' . ($row['curricular'] == 'yes' ? 'checked' : '') . '> Curricular
                    </label>
                </div>
                <div class="checkbox-inline">
                    <label>
                        <input type="checkbox" name="outsidegroup" value="yes" ' . ($row['outsidegroup'] == 'yes' ? 'checked' : '') . '> Outside Group
                    </label>
                </div>
                <div class="checkbox-inline">
                    <label>
                        <input type="checkbox" name="cocurricular" value="yes" ' . ($row['cocurricular'] == 'yes' ? 'checked' : '') . '> Co-Curricular
                    </label>
                </div>
                <div class="checkbox-inline">
                    <label>
                        <input type="checkbox" name="extracurricular" value="yes" ' . ($row['extracurricular'] == 'yes' ? 'checked' : '') . '> Extra Curricular
                    </label>
                </div>
            </div>
        </div>';
    } else {
        echo '<p>Form data not found.</p>';
    }
}
?>
