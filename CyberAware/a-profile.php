<?php
session_start();
include("database.php");

if (!verifyAdmin($con)) {
    header("Location: index.php");
    exit();
}

$act = isset($_POST['act']) ? trim($_POST['act']) : '';
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

$username = mysqli_real_escape_string($con, $username);

$success = "";

if ($act == "edit") {
    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $con->prepare("UPDATE `admin` SET `username` = ?, `password` = ? WHERE `username` = ?");
    $stmt->bind_param("sss", $username, $hashed_password, $_SESSION['username']);
    
    if ($stmt->execute()) {
        $success = "Successfully Updated";
        $_SESSION['username'] = $username; // Update session username if changed
    } else {
        die("Error updating record");
    }

    $stmt->close();
}

$stmt = $con->prepare("SELECT * FROM `admin` WHERE `username` = ?");
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    die("Error fetching data");
}

$stmt->close();
?>

<!DOCTYPE html>
<html>
<title>Cyber Aware</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
a {
  text-decoration: none;
}

body, h1, h2, h3, h4, h5, h6 {font-family: "Poppins", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

/* Full height image header */
.bgimg-1 {
  background-position: top;
  background-attachment: fixed;
  background-size: cover;
  background-image: url("images/banner.jpg");
  background-color: rgba(0, 0, 0, 0.5);
  background-blend-mode: overlay;
  min-height: 100%;
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body class="bgimg-1">
<?php include("menu-admin.php"); ?>

<!--- Toast Notification -->
<?php 
if ($success) {
    echo "<script>alert('Successfully Updated');</script>";
}
?>

<div class="" >
    <div class="w3-padding-32"></div>
    <div class=" w3-center w3-text-white w3-padding-32">
        <span class="w3-xxlarge"><b>PROFILE</b></span><br>
    </div>

    <div class="w3-container w3-padding" id="contact">
        <div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:500px">
            <div class="w3-padding">
                <form method="post" action="" >
                    <h3>Admin Profile</h3>
                    <hr class="w3-clear">
                    <div class="w3-section" >
                        <label>Username *</label>
                        <input class="w3-input w3-border w3-round" type="text" name="username" value="<?php echo htmlspecialchars($data['username']); ?>" required>
                    </div>
                    <div class="w3-section">
                        <label>Password *</label>
                        <input class="w3-input w3-border w3-round" type="password" name="password" required>
                    </div>
                    <hr class="w3-clear">
                    <input type="hidden" name="act" value="edit" >
                    <button type="submit" class="w3-button w3-wide w3-block w3-padding-large w3-indigo w3-margin-bottom w3-round"><b>UPDATE</b></button>
                </form>
            </div>
        </div>
    </div>

    <div class="w3-padding-16"></div>
</div>

<script>
// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");

function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
    } else {
        mySidebar.style.display = 'block';
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
}
</script>

</body>
</html>
