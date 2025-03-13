<?php
include 'config.php';

$sql = "SELECT id, project_id, address, start_date, end_date FROM projects ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Project List</h2>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Project ID</th>
                    <th>Address</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['project_id']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['start_date']; ?></td>
                    <td><?php echo $row['end_date']; ?></td>
                    <td>
                        <a href="view.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a>
                        <a href="edit.php?project_id=<?php echo $row['project_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?project_id=<?php echo $row['project_id']; ?>" class="btn btn-danger btn-sm" 
onclick="return confirm('Are you sure you want to delete this project and all its data?')"> Delete </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="create.php" class="btn btn-success">Create a Project</a>
        </div>
    </div>
</body>
</html>
