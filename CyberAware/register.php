<?php
include("database.php");

// Retrieve and sanitize POST data
$act = (isset($_POST['act'])) ? trim($_POST['act']) : '';
$name = (isset($_POST['name'])) ? trim($_POST['name']) : '';
$phone = (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$age = (isset($_POST['age'])) ? trim($_POST['age']) : '0';
$qualification = (isset($_POST['qualification'])) ? trim($_POST['qualification']) : '';
$username = (isset($_POST['username'])) ? trim($_POST['username']) : '';
$password = (isset($_POST['password'])) ? trim($_POST['password']) : '';
$repassword = (isset($_POST['repassword'])) ? trim($_POST['repassword']) : '';

// Prevent XSS by escaping output
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$phone = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
$age = htmlspecialchars($age, ENT_QUOTES, 'UTF-8');
$qualification = htmlspecialchars($qualification, ENT_QUOTES, 'UTF-8');
$username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

$found = 0;
$error = "";
$success = false;

if($act == "register") {
    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM `user` WHERE `username` = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $found = $result->num_rows;
    $stmt->close();

    if($found) {
        $error ="Username already registered";
    } elseif($password !== $repassword) {
        $error = "Confirm password not matched";
    } elseif(!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[@$!%*?&])[0-9A-Za-z@$!%*?&]{8,}$/', $password)) {
        $error = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
    }

    if(!$error) {
        // Hash the password before storing to enhance security
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        // Use prepared statements to prevent SQL injection
        $stmt = $con->prepare("
            INSERT INTO `user`(`id_user`, `name`, `phone`, `age`, `qualification`, `username`, `password`) 
            VALUES (NULL, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("ssisss", $name, $phone, $age, $qualification, $username, $password_hashed);
        if ($stmt->execute()) {
            $success = true;
        } else {
            // Generic error message to prevent information exposure
            $error = "Error in registration. Please try again.";
        }
        $stmt->close();
    }
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {
    font-family: "Poppins", sans-serif;
}

body, html {
    height: 100%;
    line-height: 1.8;
}

.bgimg-1 {
    background-position: center;
    background-size: cover;
    background-attachment: fixed;
    background-image: url('images/banner.jpg');
    min-height: 100%;
}

a:link {
    text-decoration: none;
}

.w3-bar .w3-button {
    padding: 16px;
}

.w3-container {
    background-color: rgba(255, 255, 255, 0.85);
    border-radius: 10px;
}

.w3-input {
    border-radius: 10px;
}

.w3-button {
    border-radius: 10px;
}

.w3-section label {
    font-weight: bold;
}
</style>
</head>
<body class="bgimg-1">

<?php include("menu.php"); ?>

<div class="w3-padding-32"></div>

<div class="w3-container w3-padding-16" id="contact">
    <div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:500px">
        <div class="w3-padding">
            
<?php if($success) { ?>
<div class="w3-panel w3-blue w3-display-container w3-animate-zoom">
    <span onclick="this.parentElement.style.display='none'"
    class="w3-button w3-large w3-display-topright">&times;</span>
    <h3>Success!</h3>
    <p>Your registration was successful! You may now <a href="login.php" class="w3-xlarge">Login.</a> </p>
</div>
<?php } ?>

<?php if($error) { ?>
<div class="w3-panel w3-red w3-display-container w3-animate-zoom">
    <span onclick="this.parentElement.style.display='none'"
    class="w3-button w3-large w3-display-topright">&times;</span>
    <h3>Error!</h3>
    <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); // Prevent XSS by escaping error message ?></p>
</div>
<?php } ?>

<?php if(!$success) { ?>    
    <form action="" method="post">
        <img src="images/logo.png" class="w3-image" alt="Logo">
        <hr>
        <h3><b>Registration</b></h3>
        
        <div class="w3-section">
            <label>Full Name *</label>
            <input class="w3-input w3-border w3-round" type="text" name="name" required>
        </div>
        
        <div class="w3-section">
            <label>Contact No *</label>
            <input class="w3-input w3-border w3-round" type="text" name="phone" required>
        </div>
        
        <div class="w3-section">
            <label>Age *</label>
            <input class="w3-input w3-border w3-round" type="number" name="age" required>
        </div>
        
        <div class="w3-section">
            <label>Qualification *</label>
            <input class="w3-input w3-border w3-round" type="text" name="qualification" required>
        </div>
        
        <div class="w3-section">
            <label>Username *</label>
            <input class="w3-input w3-border w3-round" type="text" name="username" required>
        </div>
        
        <div class="w3-section">
            <label>Password *</label>
            <input class="w3-input w3-border w3-round" type="password" name="password" required>
        </div>
        
        <div class="w3-section">
            <label>Confirm Password *</label>
            <input class="w3-input w3-border w3-round" type="password" name="repassword" required>
        </div>
        
        <input type="hidden" name="act" value="register">
        <button type="submit" class="w3-button w3-block w3-padding-large w3-indigo w3-margin-bottom w3-round"><b>SUBMIT</b></button>
    </form>
<?php } ?>

<div class="w3-center">Already registered? <a href="login.php" class="w3-text-indigo"><b>Login here</b></a></div>
</div>

</div>
</div>

<div class="w3-padding-24"></div>

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
