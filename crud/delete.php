<?php
include 'config.php';

if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];

    $sql = "DELETE FROM engineering_drawings WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $project_id);
    $stmt->execute();

    $sql = "DELETE FROM plots WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $project_id);
    $stmt->execute();

    $sql = "DELETE FROM projects WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $project_id);
    $stmt->execute();
 
    header("Location: index.php");
    exit();
} else {
    echo "Invalid request!";
}
?>
