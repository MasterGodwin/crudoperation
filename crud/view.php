<?php
include 'config.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid Request");
}

$project_id = $_GET['id'];
 
$sql_project = "SELECT * FROM projects WHERE id = ?";
$stmt_project = $conn->prepare($sql_project);
$stmt_project->bind_param("i", $project_id);
$stmt_project->execute();
$result_project = $stmt_project->get_result();
$project = $result_project->fetch_assoc();

if (!$project) {
    die("Project not found.");
}
 
$sql_drawings = "SELECT * FROM engineering_drawings WHERE project_id = ?";
$stmt_drawings = $conn->prepare($sql_drawings);
$stmt_drawings->bind_param("s", $project['project_id']);
$stmt_drawings->execute();
$result_drawings = $stmt_drawings->get_result();
 
$sql_plots = "SELECT * FROM plots WHERE project_id = ?";
$stmt_plots = $conn->prepare($sql_plots);
$stmt_plots->bind_param("s", $project['project_id']);
$stmt_plots->execute();
$result_plots = $stmt_plots->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Project Details</h2>

        <table class="table table-bordered">
            <tr><th>Project ID</th><td><?php echo $project['project_id']; ?></td></tr>
            <tr><th>Address</th><td><?php echo $project['address']; ?></td></tr>
            <tr><th>Start Date</th><td><?php echo $project['start_date']; ?></td></tr>
            <tr><th>End Date</th><td><?php echo $project['end_date']; ?></td></tr>
        </table>

        <h3 class="mt-4">Engineering Drawings</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Planned By</th>
                    <th>Planned Date</th>
                    <th>Diagram No</th>
                    <th>Revision No</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_drawings->fetch_assoc()) { ?>
                    <tr>
                        <td><img src="<?php echo $row['image_path']; ?>" width="100"></td>
                        <td><?php echo $row['planned_by']; ?></td>
                        <td><?php echo $row['planned_date']; ?></td>
                        <td><?php echo $row['diagram_no']; ?></td>
                        <td><?php echo $row['revision_no']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h3 class="mt-4">Plots</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Plot ID</th>
                    <th>Plot Name</th>
                    <th>Pile Type</th>
                    <th>Pile Length</th>
                    <th>Pile Status</th>
                    <th>Assigned Worker</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_plots->fetch_assoc()) { ?>
                    <tr>
                        <td><img src="<?php echo $row['image_path']; ?>" width="100"></td>
                        <td><?php echo $row['plot_id']; ?></td>
                        <td><?php echo $row['plot_name']; ?></td>
                        <td><?php echo $row['pile_type']; ?></td>
                        <td><?php echo $row['pile_length']; ?></td>
                        <td><?php echo $row['pile_status']; ?></td>
                        <td><?php echo $row['assigned_worker']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary">Back to Projects</a>
        </div>
    </div>
</body>
</html>
