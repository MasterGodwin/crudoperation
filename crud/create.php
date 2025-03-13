<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Form with Image Upload</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        h2 {
            margin-top: 20px;
        }
        label {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        label input, label select, label textarea {
            margin-left: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            flex-grow: 1;
        }
        textarea {
            resize: vertical;
        }
        .entry {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            flex-wrap: wrap;
            gap:5px;
        }
        .entry input, .entry select {
            margin-right: 5px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .entry button {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .entry button:hover {
            background-color: #45a049;
        }
        .add {
            background-color: #008CBA;
        }
        .add:hover {
            background-color: #0077b3;
        }
        .preview {
            display: none;
            max-width: 200px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="submit.php" method="POST" enctype="multipart/form-data">
        <h2>Project Details</h2>
        <label>Contract No: <input type="text" name="contract_no" required></label>
        <label>Tender No: <input type="text" name="tender_no" required></label>
        <label>Project Name: <input type="text" name="project_name" required></label>
        <label>Assigned Team: 
            <select name="assigned_team" required>
                <option value="">Select Team</option>
                <option value="Team A">Team A</option>
                <option value="Team B">Team B</option>
                <option value="Team C">Team C</option>
            </select>
        </label>
        <label>Current Status: 
            <select name="current_status" required>
                <option value="">Select Status</option>
                <option value="Ongoing">Ongoing</option>
                <option value="Completed">Completed</option>
                <option value="Pending">Pending</option>
            </select>
        </label>
        <label>Project Duration: <input type="text" name="project_duration" required></label>
        <label>Client Name: <input type="text" name="client_name" required></label>
        <label>Client ID: <input type="text" name="client_id" required></label>
        <label>Pile Type: 
            <select name="pile_type" required>
                <option value="">Select Pile Type</option>
                <option value="Type A">Type A</option>
                <option value="Type B">Type B</option>
                <option value="Type C">Type C</option>
            </select>
        </label>
        <label>No. of Piles: <input type="text" name="no_of_piles" required></label>
        <label>Pile Designed Length: <input type="text" name="pile_designed_length" required></label>
        <label>Expected Pile Installation Rate: <input type="text" name="expected_pile_installation_rate" required></label>
        <label>Penetration Record: <input type="text" name="penetration_record" required></label>
        <label>Rig Details: <input type="text" name="rig_details" required></label>
        <label>Address: <textarea name="address" required></textarea></label>
        <label>Rig Length: <input type="text" name="rig_length" required></label>
        <label>Start Date: <input type="date" name="start_date" required></label>
        <label>End Date: <input type="date" name="end_date" required></label>
        <label>Restrike %: <input type="text" name="restrike_percentage" required></label>
        <label>No. of Days Piling: <input type="text" name="days_piling" required></label>

        <h2>Engineering Drawing Details</h2>
        <div id="engineeringDrawings">
            <div class="entry">
                <input type="file" name="engineering_image[]" required>
                <input type="text" name="plannedBy[]" placeholder="Planned By">
                <input type="date" name="plannedDate[]">
                <input type="text" name="diagramNo[]" placeholder="Diagram No">
                <input type="text" name="revisionNo[]" placeholder="Revision No">
                <button type="button" class="add" onclick="addEntry('engineeringDrawings')">Add More</button>
            </div>
        </div>

        <h2>Plots</h2>
        <div id="plots">
            <div class="entry">
                <input type="file" name="plot_image[]" required>
                <input type="text" name="plotId[]" placeholder="Plot ID">
                <input type="text" name="plotName[]" placeholder="Plot Name">
                <input type="text" name="pileType[]" placeholder="Pile Type">
                <input type="text" name="pileLength[]" placeholder="Pile Length">
                <select name="pileStatus[]" required>
                    <option value="">Select Status</option>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Completed">Completed</option>
                    <option value="Pending">Pending</option>
                </select>
                <select name="assignedWorker[]" required>
                    <option value="">Select Status</option>
                    <option value="Assigned">Assigned</option>
                    <option value="Not Assigned">Not Assigned</option>
                </select>
                <button type="button" class="add" onclick="addEntry('plots')">Add More</button>
            </div>
        </div>

        <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        function previewImage(event, input) {
            let reader = new FileReader();
            reader.onload = function(){
                let img = input.parentNode.nextElementSibling.querySelector('.preview');
                img.src = reader.result;
                img.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
        
        function addEntry(sectionId) {
        let container = document.getElementById(sectionId);
        let entry = container.querySelector('.entry').cloneNode(true);

        entry.querySelectorAll('input').forEach(input => input.value = '');

        entry.querySelector('.add').remove();

        let removeBtn = document.createElement('button');
        removeBtn.type = "button";
        removeBtn.textContent = "Remove";
        removeBtn.onclick = function () {
            container.removeChild(entry);
        };
        entry.appendChild(removeBtn);

        container.appendChild(entry);
    }
    </script>
</body>
</html>
