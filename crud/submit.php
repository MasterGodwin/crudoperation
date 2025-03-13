<?php
include 'config.php';   
 
$project_id = 'PRJ-' . time();
 
$contract_no = $_POST['contract_no'];
$tender_no = $_POST['tender_no'];
$project_name = $_POST['project_name'];
$assigned_team = $_POST['assigned_team'];
$current_status = $_POST['current_status'];
$project_duration = $_POST['project_duration'];
$client_name = $_POST['client_name'];
$client_id = $_POST['client_id'];
$pile_type = $_POST['pile_type'];
$no_of_piles = $_POST['no_of_piles'];
$pile_designed_length = $_POST['pile_designed_length'];
$expected_pile_installation_rate = $_POST['expected_pile_installation_rate'];
$penetration_record = $_POST['penetration_record'];
$rig_details = $_POST['rig_details'];
$address = $_POST['address'];
$rig_length = $_POST['rig_length'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$restrike_percentage = $_POST['restrike_percentage'];
$days_piling = $_POST['days_piling'];
 
$sql = "INSERT INTO projects (
    project_id, contract_no, tender_no, project_name, assigned_team, current_status, 
    project_duration, client_name, client_id, pile_type, no_of_piles, 
    pile_designed_length, expected_pile_installation_rate, penetration_record, rig_details, 
    address, rig_length, start_date, end_date, restrike_percentage, days_piling
) VALUES (
    '$project_id', '$contract_no', '$tender_no', '$project_name', '$assigned_team', '$current_status', 
    '$project_duration', '$client_name', '$client_id', '$pile_type', '$no_of_piles', 
    '$pile_designed_length', '$expected_pile_installation_rate', '$penetration_record', '$rig_details', 
    '$address', '$rig_length', '$start_date', '$end_date', '$restrike_percentage', '$days_piling'
)";
$conn->query($sql); 

function uploadImage($file, $uploadDir) {
    if ($file['error'] == 0) {
        $fileName = time() . '_' . basename($file['name']);
        $targetPath = $uploadDir . $fileName;
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $targetPath;
        }
    }
    return null;
}
 
if (!empty($_FILES['engineering_image']['name'][0])) {
    for ($i = 0; $i < count($_FILES['engineering_image']['name']); $i++) {
        $imagePath = uploadImage([
            'name' => $_FILES['engineering_image']['name'][$i],
            'tmp_name' => $_FILES['engineering_image']['tmp_name'][$i],
            'error' => $_FILES['engineering_image']['error'][$i]
        ], "uploads/");

        $planned_by = $_POST['plannedBy'][$i];
        $planned_date = $_POST['plannedDate'][$i];
        $diagram_no = $_POST['diagramNo'][$i];
        $revision_no = $_POST['revisionNo'][$i];

        $sql = "INSERT INTO engineering_drawings (project_id, image_path, planned_by, planned_date, diagram_no, revision_no) 
                VALUES ('$project_id', '$imagePath', '$planned_by', '$planned_date', '$diagram_no', '$revision_no')";
        $conn->query($sql);
    }
}
 
if (!empty($_FILES['plot_image']['name'][0])) {
    for ($i = 0; $i < count($_FILES['plot_image']['name']); $i++) {
        $imagePath = uploadImage([
            'name' => $_FILES['plot_image']['name'][$i],
            'tmp_name' => $_FILES['plot_image']['tmp_name'][$i],
            'error' => $_FILES['plot_image']['error'][$i]
        ], "uploads/");

        $plot_id = $_POST['plotId'][$i];
        $plot_name = $_POST['plotName'][$i];
        $pile_type = $_POST['pileType'][$i];
        $pile_length = $_POST['pileLength'][$i];
        $pile_status = $_POST['pileStatus'][$i];
        $assigned_worker = $_POST['assignedWorker'][$i];

        $sql = "INSERT INTO plots (project_id, image_path, plot_id, plot_name, pile_type, pile_length, pile_status, assigned_worker) 
                VALUES ('$project_id', '$imagePath', '$plot_id', '$plot_name', '$pile_type', '$pile_length', '$pile_status', '$assigned_worker')";
        $conn->query($sql);
    }
}

$conn->close();
echo "Data successfully saved!";
?>
