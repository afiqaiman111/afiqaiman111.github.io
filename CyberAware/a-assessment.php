<?php
// Start session and include database connection
session_start();
include("database.php");

// Verify if the user is an admin
if (!verifyAdmin($con)) {
    // If not an admin, redirect to the index page
    header("Location: index.php");
    exit;
}

// Retrieve values from request or set defaults
$id_assessment = isset($_REQUEST['id_assessment']) ? trim($_REQUEST['id_assessment']) : '0';
$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : '';

// Retrieve form data
$assessment = isset($_POST['assessment']) ? trim($_POST['assessment']) : '';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';

// Initialize success message variable
$success = "";

// Add new assessment
if ($act == "add") {
    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("INSERT INTO `assessment` (`assessment`, `description`) VALUES (?, ?)");
    $stmt->bind_param("ss", $assessment, $description);

    if ($stmt->execute()) {
        // Set success message on successful execution
        $success = "Successfully Added";
    } else {
        // Set generic error message on failure
        $success = "An error occurred. Please try again.";
    }
    $stmt->close();
}

// Edit existing assessment
if ($act == "edit") {
    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("UPDATE `assessment` SET `assessment` = ?, `description` = ? WHERE `id_assessment` = ?");
    $stmt->bind_param("ssi", $assessment, $description, $id_assessment);

    if ($stmt->execute()) {
        // Set success message on successful execution
        $success = "Successfully Updated";
    } else {
        // Set generic error message on failure
        $success = "An error occurred. Please try again.";
    }
    $stmt->close();
}

// Delete an assessment
if ($act == "del") {
    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("DELETE FROM `assessment` WHERE `id_assessment` = ?");
    $stmt->bind_param("i", $id_assessment);

    if ($stmt->execute()) {
        // Set success message on successful execution
        $success = "Successfully Deleted";
    } else {
        // Set generic error message on failure
        $success = "An error occurred. Please try again.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cyber Aware</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="css/table.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <style>
        a { text-decoration: none; }
        body, h1, h2, h3, h4, h5, h6 { font-family: "Poppins", sans-serif; }
        body, html { height: 100%; line-height: 1.8; }
        .bgimg-1 { background-position: top; background-attachment: fixed; background-size: cover; background-image: url("images/banner.jpg"); background-color: rgba(0, 0, 0, 0.5); background-blend-mode: overlay; min-height: 100%; }
        .w3-bar .w3-button { padding: 16px; }
    </style>
</head>
<body class="bgimg-1">

<?php include("menu-admin.php"); ?>

<!-- Toast Notification -->
<?php
if ($success) {
    // Use htmlspecialchars to prevent XSS when displaying messages
    Notify("success", htmlspecialchars($success, ENT_QUOTES, 'UTF-8'), "a-assessment.php");
}
?>    

<div class="">
    <div class="w3-padding-32"></div>
    <div class="w3-center w3-text-white w3-padding-32">
        <span class="w3-xxlarge"><b>ASSESSMENT LIST</b></span><br>
    </div>
    <div class="w3-container w3-content" style="max-width:1200px;">    
        <div class="w3-row w3-white w3-card w3-padding">
            <a onclick="document.getElementById('add01').style.display='block';" class="w3-margin-bottom w3-right w3-button w3-indigo w3-round"><i class="fa fa-fw fa-lg fa-plus"></i> Add</a>
            <div class="w3-row w3-margin">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Assessment</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $bil = 0;
                        // Fetch assessment list from the database
                        $SQL_list = "SELECT * FROM `assessment`";
                        $result = mysqli_query($con, $SQL_list);
                        while ($data = mysqli_fetch_array($result)) {
                            $bil++;
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($bil, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($data["assessment"], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($data["description"], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>
                                    <a href="#" onclick="document.getElementById('idEdit<?php echo $bil; ?>').style.display='block'" class=""><i class="fa fa-fw fa-edit fa-lg"></i></a>
                                    <a title="Delete" onclick="document.getElementById('idDelete<?php echo $bil; ?>').style.display='block'" class="w3-text-red"><i class="fa fa-fw fa-trash-alt fa-lg"></i></a>
                                </td>
                            </tr>
                            <div id="idEdit<?php echo $bil; ?>" class="w3-modal" style="z-index:10;">
                                <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:600px">
                                    <header class="w3-container"> 
                                        <span onclick="document.getElementById('idEdit<?php echo $bil; ?>').style.display='none'" class="w3-button w3-large w3-circle w3-display-topright"><i class="fa fa-fw fa-times"></i></span>
                                    </header>
                                    <div class="w3-container w3-padding">
                                        <form action="" method="post">
                                            <div class="w3-padding"></div>
                                            <b class="w3-large">Update Assessment</b>
                                            <hr>
                                            <div class="w3-section">
                                                <label>Assessment *</label>
                                                <input class="w3-input w3-border w3-round" type="text" name="assessment" value="<?php echo htmlspecialchars($data["assessment"], ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                            <div class="w3-section">
                                                <label>Description *</label>
                                                <textarea class="w3-input w3-border w3-round" name="description" rows="5" required><?php echo htmlspecialchars($data["description"], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                            </div>
                                            <hr class="w3-clear">
                                            <input type="hidden" name="id_assessment" value="<?php echo htmlspecialchars($data["id_assessment"], ENT_QUOTES, 'UTF-8'); ?>">
                                            <input type="hidden" name="act" value="edit">
                                            <button type="submit" class="w3-button w3-indigo w3-text-white w3-margin-bottom w3-round">SAVE CHANGES</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="w3-padding-24"></div>
                            </div>
                            <div id="idDelete<?php echo $bil; ?>" class="w3-modal" style="z-index:10;">
                                <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
                                    <header class="w3-container"> 
                                        <span onclick="document.getElementById('idDelete<?php echo $bil; ?>').style.display='none'" class="w3-button w3-large w3-circle w3-display-topright"><i class="fa fa-fw fa-times"></i></span>
                                    </header>
                                    <div class="w3-container">
                                        <form action="" method="post">
                                            <div class="w3-padding"></div>
                                            <b class="w3-large">Confirmation</b>
                                            <hr class="w3-clear">            
                                            Are you sure to delete this record?
                                            <div class="w3-padding-16"></div>
                                            <input type="hidden" name="id_assessment" value="<?php echo htmlspecialchars($data["id_assessment"], ENT_QUOTES, 'UTF-8'); ?>">
                                            <input type="hidden" name="act" value="del">
                                            <button type="button" onclick="document.getElementById('idDelete<?php echo $bil; ?>').style.display='none'" class="w3-button w3-gray w3-text-white w3-margin-bottom w3-round">CANCEL</button>
                                            <button type="submit" class="w3-right w3-button w3-red w3-text-white w3-margin-bottom w3-round">YES, CONFIRM</button>
                                        </form>
                                    </div>
                                </div>
                            </div>                
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="w3-padding-24"></div>
</div>

<div id="add01" class="w3-modal">
    <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:600px">
        <header class="w3-container"> 
            <span onclick="document.getElementById('add01').style.display='none'" class="w3-button w3-large w3-circle w3-display-topright"><i class="fa fa-fw fa-times"></i></span>
        </header>
        <div class="w3-container w3-padding">
            <form action="" method="post">
                <div class="w3-padding"></div>
                <b class="w3-large">Add Assessment</b>
                <hr>
                <div class="w3-section">
                    <label>Assessment *</label>
                    <input class="w3-input w3-border w3-round" type="text" name="assessment" required>
                </div>
                <div class="w3-section">
                    <label>Description *</label>
                    <textarea class="w3-input w3-border w3-round" name="description" rows="5" required></textarea>
                </div>
                <hr class="w3-clear">
                <div class="w3-section">
                    <input name="act" type="hidden" value="add">
                    <button type="submit" class="w3-button w3-indigo w3-text-white w3-round">SUBMIT</button>
                </div>
            </form> 
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        paging: true,
        searching: true
    });
});
</script>
<script>
var mySidebar = document.getElementById("mySidebar");
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
    } else {
        mySidebar.style.display = 'block';
    }
}
function w3_close() {
    mySidebar.style.display = "none";
}
</script>
</body>
</html>
