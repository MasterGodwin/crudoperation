<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['project_id'])) {
    $project_id = $_POST['project_id'];

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

    $sql = "UPDATE projects SET contract_no = ?, tender_no = ?, project_name = ?, assigned_team = ?, current_status = ?, project_duration = ?, client_name = ?, client_id = ?, pile_type = ?, no_of_piles = ?, pile_designed_length = ?, expected_pile_installation_rate = ?, penetration_record = ?, rig_details = ?, address = ?, rig_length = ?, start_date = ?, end_date = ?, restrike_percentage = ?, days_piling = ? WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssssssss", $contract_no, $tender_no, $project_name, $assigned_team, $current_status, $project_duration, $client_name, $client_id, $pile_type, $no_of_piles, $pile_designed_length, $expected_pile_installation_rate, $penetration_record, $rig_details, $address, $rig_length, $start_date, $end_date, $restrike_percentage, $days_piling, $project_id);
    $stmt->execute();

    if (isset($_POST['drawing_ids'])) {
        $drawing_ids = $_POST['drawing_ids'];
        $planned_by = $_POST['planned_by'];
        $planned_date = $_POST['planned_date'];
        $diagram_no = $_POST['diagram_no'];
        $revision_no = $_POST['revision_no'];

        foreach ($drawing_ids as $index => $id) {
            $sql = "UPDATE engineering_drawings SET planned_by = ?, planned_date = ?, diagram_no = ?, revision_no = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $planned_by[$index], $planned_date[$index], $diagram_no[$index], $revision_no[$index], $id);
            $stmt->execute();

            if (isset($_FILES['engineering_image']['name'][$index]) && $_FILES['engineering_image']['name'][$index] != '') {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES['engineering_image']['name'][$index]);
                move_uploaded_file($_FILES['engineering_image']['tmp_name'][$index], $target_file);

                $sql = "UPDATE engineering_drawings SET image_path = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $target_file, $id);
                $stmt->execute();
            }
        }
    }

    if (isset($_FILES['engineering_image']['name']) && is_array($_FILES['engineering_image']['name'])) {
        foreach ($_FILES['engineering_image']['name'] as $index => $name) {
            if (!empty($name) && !isset($_POST['drawing_ids'][$index])) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($name);
                move_uploaded_file($_FILES['engineering_image']['tmp_name'][$index], $target_file);

                $sql = "INSERT INTO engineering_drawings (project_id, image_path, planned_by, planned_date, diagram_no, revision_no) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $project_id, $target_file, $_POST['planned_by'][$index], $_POST['planned_date'][$index], $_POST['diagram_no'][$index], $_POST['revision_no'][$index]);
                $stmt->execute();
            }
        }
    }

    if (isset($_POST['plot_ids'])) {
        $plot_ids = $_POST['plot_ids'];
        $plotNames = $_POST['plotName'];
        $pileTypes = $_POST['pileType'];
        $pileLengths = $_POST['pileLength'];
        $pileStatuses = $_POST['pileStatus'];
        $assignedWorkers = $_POST['assignedWorker'];

        foreach ($plot_ids as $index => $id) {
            $sql = "UPDATE plots SET plot_name = ?, pile_type = ?, pile_length = ?, pile_status = ?, assigned_worker = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssi", $plotNames[$index], $pileTypes[$index], $pileLengths[$index], $pileStatuses[$index], $assignedWorkers[$index], $id);
            $stmt->execute();

            if (isset($_FILES['plot_image']['name'][$index]) && $_FILES['plot_image']['name'][$index] != '') {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES['plot_image']['name'][$index]);
                move_uploaded_file($_FILES['plot_image']['tmp_name'][$index], $target_file);

                $sql = "UPDATE plots SET image_path = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $target_file, $id);
                $stmt->execute();
            }
        }
    }

    if (isset($_FILES['plot_image']['name']) && is_array($_FILES['plot_image']['name'])) {
        foreach ($_FILES['plot_image']['name'] as $index => $name) {
            if (!empty($name) && !isset($_POST['plot_ids'][$index])) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($name);
                move_uploaded_file($_FILES['plot_image']['tmp_name'][$index], $target_file);

                $sql = "INSERT INTO plots (project_id, image_path, plot_name, pile_type, pile_length, pile_status, assigned_worker) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $project_id, $target_file, $_POST['plotName'][$index], $_POST['pileType'][$index], $_POST['pileLength'][$index], $_POST['pileStatus'][$index], $_POST['assignedWorker'][$index]);
                $stmt->execute();
            }
        }
    }
    header("Location: index.php");
    exit;
} else {
    echo "Invalid request!";
}
?>