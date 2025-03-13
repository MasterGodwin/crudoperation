<?php
include 'config.php';

if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];
 
    $sql = "SELECT * FROM projects WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $project = $result->fetch_assoc();
 
    $sql_drawings = "SELECT * FROM engineering_drawings WHERE project_id = ?";
    $stmt = $conn->prepare($sql_drawings);
    $stmt->bind_param("s", $project_id);
    $stmt->execute();
    $result_drawings = $stmt->get_result();
 
    $sql_plots = "SELECT * FROM plots WHERE project_id = ?";
    $stmt = $conn->prepare($sql_plots);
    $stmt->bind_param("s", $project_id);
    $stmt->execute();
    $result_plots = $stmt->get_result();
} else {
    echo "Invalid request!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Project</h2>
        <form action="update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">

        <div class="mb-3">
        <label>Contract No</label>
        <input type="text" name="contract_no" class="form-control" value="<?php echo $project['contract_no']; ?>">
        </div>
        <div class="mb-3">
            <label>Tender No</label>
            <input type="text" name="tender_no" class="form-control" value="<?php echo $project['tender_no']; ?>">
        </div>
        <div class="mb-3">
            <label>Project Name</label>
            <input type="text" name="project_name" class="form-control" value="<?php echo $project['project_name']; ?>">
        </div>
        <div class="mb-3">
            <label>Assigned Team</label>
            <select name="assigned_team" class="form-control">
                <option value="Team A" <?php if($project['assigned_team'] == 'Team A') echo 'selected'; ?>>Team A</option>
                <option value="Team B" <?php if($project['assigned_team'] == 'Team B') echo 'selected'; ?>>Team B</option>
                <option value="Team C" <?php if($project['assigned_team'] == 'Team C') echo 'selected'; ?>>Team C</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Current Status</label>
            <select name="current_status" class="form-control">
                <option value="Ongoing" <?php if($project['current_status'] == 'Ongoing') echo 'selected'; ?>>Ongoing</option>
                <option value="Completed" <?php if($project['current_status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                <option value="Pending" <?php if($project['current_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Project Duration</label>
            <input type="text" name="project_duration" class="form-control" value="<?php echo $project['project_duration']; ?>">
        </div>
        <div class="mb-3">
            <label>Client Name</label>
            <input type="text" name="client_name" class="form-control" value="<?php echo $project['client_name']; ?>">
        </div>
        <div class="mb-3">
            <label>Client ID</label>
            <input type="text" name="client_id" class="form-control" value="<?php echo $project['client_id']; ?>">
        </div>
        <div class="mb-3">
            <label>Pile Type</label>
            <select name="pile_type" class="form-control">
                <option value="Type A" <?php if($project['pile_type'] == 'Type A') echo 'selected'; ?>>Type A</option>
                <option value="Type B" <?php if($project['pile_type'] == 'Type B') echo 'selected'; ?>>Type B</option>
                <option value="Type C" <?php if($project['pile_type'] == 'Type C') echo 'selected'; ?>>Type C</option>
            </select>
        </div>
        <div class="mb-3">
            <label>No. of Piles</label>
            <input type="text" name="no_of_piles" class="form-control" value="<?php echo $project['no_of_piles']; ?>">
        </div>
        <div class="mb-3">
            <label>Pile Designed Length</label>
            <input type="text" name="pile_designed_length" class="form-control" value="<?php echo $project['pile_designed_length']; ?>">
        </div>
        <div class="mb-3">
            <label>Expected Pile Installation Rate</label>
            <input type="text" name="expected_pile_installation_rate" class="form-control" value="<?php echo $project['expected_pile_installation_rate']; ?>">
        </div>
        <div class="mb-3">
            <label>Penetration Record</label>
            <input type="text" name="penetration_record" class="form-control" value="<?php echo $project['penetration_record']; ?>">
        </div>
        <div class="mb-3">
            <label>Rig Details</label>
            <input type="text" name="rig_details" class="form-control" value="<?php echo $project['rig_details']; ?>">
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control"><?php echo $project['address']; ?></textarea>
        </div>
        <div class="mb-3">
            <label>Rig Length</label>
            <input type="text" name="rig_length" class="form-control" value="<?php echo $project['rig_length']; ?>">
        </div>
        <div class="mb-3">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" value="<?php echo $project['start_date']; ?>">
        </div>
        <div class="mb-3">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" value="<?php echo $project['end_date']; ?>">
        </div>
        <div class="mb-3">
            <label>Restrike %</label>
            <input type="text" name="restrike_percentage" class="form-control" value="<?php echo $project['restrike_percentage']; ?>">
        </div>
        <div class="mb-3">
            <label>No. of Days Piling</label>
            <input type="text" name="days_piling" class="form-control" value="<?php echo $project['days_piling']; ?>">
        </div>

            <h3>Engineering Drawings</h3>
            <div id="engineeringDrawings">
                <?php while ($row = $result_drawings->fetch_assoc()) { ?>
                    <div class="entry mb-3">
                        <input type="hidden" name="drawing_ids[]" value="<?php echo $row['id']; ?>">
                        <input type="file" name="engineering_image[]" class="form-control">
                        <input type="text" name="planned_by[]" class="form-control" value="<?php echo $row['planned_by']; ?>" placeholder="Planned By">
                        <input type="date" name="planned_date[]" class="form-control" value="<?php echo $row['planned_date']; ?>">
                        <input type="text" name="diagram_no[]" class="form-control" value="<?php echo $row['diagram_no']; ?>" placeholder="Diagram No">
                        <input type="text" name="revision_no[]" class="form-control" value="<?php echo $row['revision_no']; ?>" placeholder="Revision No">
                        <button type="button" class="btn btn-danger" onclick="removeEntry(this)">Remove</button>
                    </div>
                <?php } ?>
            </div>
            <button type="button" class="btn btn-secondary mb-3" onclick="addEntry('engineeringDrawings')">Add More</button>

            <h3>Plots</h3>
            <div id="plots">
                <?php while ($row = $result_plots->fetch_assoc()) { ?>
                    <div class="entry mb-3">
                        <input type="hidden" name="plot_ids[]" value="<?php echo $row['id']; ?>">
                        
                        <label>Plot Image:</label>
                        <input type="file" name="plot_image[]" class="form-control">
                         

                        <label>Plot Name:</label>
                        <input type="text" name="plotName[]" class="form-control" value="<?php echo $row['plot_name']; ?>" placeholder="Plot Name">

                        <label>Pile Type:</label>
                        <input type="text" name="pileType[]" class="form-control" value="<?php echo $row['pile_type']; ?>" placeholder="Pile Type">

                        <label>Pile Length:</label>
                        <input type="text" name="pileLength[]" class="form-control" value="<?php echo $row['pile_length']; ?>" placeholder="Pile Length">

                        <label>Pile Status:</label>
                        <select name="pileStatus[]" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="Ongoing" <?php echo ($row['pile_status'] == "Ongoing") ? "selected" : ""; ?>>Ongoing</option>
                            <option value="Completed" <?php echo ($row['pile_status'] == "Completed") ? "selected" : ""; ?>>Completed</option>
                            <option value="Pending" <?php echo ($row['pile_status'] == "Pending") ? "selected" : ""; ?>>Pending</option>
                        </select>

                        <label>Assigned Worker:</label>
                        <select name="assignedWorker[]" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="Assigned" <?php echo ($row['assigned_worker'] == "Assigned") ? "selected" : ""; ?>>Assigned</option>
                            <option value="Not Assigned" <?php echo ($row['assigned_worker'] == "Not Assigned") ? "selected" : ""; ?>>Not Assigned</option>
                        </select>

                        <button type="button" class="btn btn-danger" onclick="removeEntry(this)">Remove</button>
                    </div>
                <?php } ?>
            </div>

            <button type="button" class="btn btn-secondary mb-3" onclick="addEntry('plots')">Add More</button>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script>
        function addEntry(sectionId) {
            let container = document.getElementById(sectionId);
            let entry = container.querySelector('.entry').cloneNode(true);

            entry.querySelectorAll('input').forEach(input => input.value = '');
            entry.querySelector('.btn-danger').style.display = 'inline-block';
            container.appendChild(entry);
        }

        function removeEntry(button) {
            let entry = button.parentNode;
            entry.parentNode.removeChild(entry);
        }
    </script>
</body>
</html>
