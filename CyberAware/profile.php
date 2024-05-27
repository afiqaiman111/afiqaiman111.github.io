<?PHP
session_start();
include("database.php");

$id_user = $_SESSION["id_user"];
?>
<?PHP    
$act    = (isset($_POST['act'])) ? trim($_POST['act']) : '';    

$name           = (isset($_POST['name'])) ? trim($_POST['name']) : '';
$phone          = (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$age            = (isset($_POST['age'])) ? trim($_POST['age']) : '0';
$qualification  = (isset($_POST['qualification'])) ? trim($_POST['qualification']) : '';
$username       = (isset($_POST['username'])) ? trim($_POST['username']) : '';
$password       = (isset($_POST['password'])) ? trim($_POST['password']) : '';

$success = "";

if($act == "edit")
{    
    // Hash the password before saving it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL update statement
    $stmt = $con->prepare("UPDATE `user` SET 
                            `name` = ?, 
                            `phone` = ?, 
                            `age` = ?, 
                            `qualification` = ?, 
                            `password` = ? 
                           WHERE `username` = ?");
    $stmt->bind_param("ssisss", $name, $phone, $age, $qualification, $hashed_password, $_SESSION['username']);

    if ($stmt->execute()) {
        $success = "Successfully Updated";
    } else {
        die("Error in query: ".$stmt->error);
    }

    $stmt->close();
}

// Prepare the SQL select statement
$stmt = $con->prepare("SELECT * FROM `user` WHERE `username` = ?");
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_array(MYSQLI_ASSOC);
$stmt->close();

// Sanitize output to prevent XSS
function sanitize_output($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html>
<title>Cyber Aware</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="css/table.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
<style>
a {
  text-decoration: none;
}

body,h1,h2,h3,h4,h5,h6 {font-family: "Poppins", sans-serif}

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
  min-height: 100%;
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body class="bgimg-1">

<?PHP include("menu.php"); ?>

<!--- Toast Notification -->
<?PHP 
if($success) { Notify("success", $success, "profile.php"); }
?>    

<div class="" >

    <div class="w3-padding-48"></div>
        
    
<div class="w3-container w3-padding" id="contact">
    <div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:500px">
        <div class="w3-padding">
        
            <form method="post" action="" >
                <h3>My Profile</h3>
                <hr class="w3-clear">
                <div class="w3-section" >
                    Full Name *
                    <input class="w3-input w3-border w3-round" type="text" name="name" value="<?PHP echo sanitize_output($data["name"]); ?>" required>
                </div>
              
                <div class="w3-section">
                    Contact No *
                    <input class="w3-input w3-border w3-round" type="text" name="phone" value="<?PHP echo sanitize_output($data["phone"]); ?>" required>
                </div>
                
                <div class="w3-section">
                    Age *
                    <input class="w3-input w3-border w3-round" type="number" name="age" value="<?PHP echo sanitize_output($data["age"]); ?>" required>
                </div>
                
                <div class="w3-section">
                    Qualification *
                    <input class="w3-input w3-border w3-round" type="text" name="qualification" value="<?PHP echo sanitize_output($data["qualification"]); ?>" required>
                </div>
    
                <div class="w3-section" >
                    Username *
                    <input class="w3-input w3-border w3-round" type="text" name="username" value="<?PHP echo sanitize_output($data["username"]); ?>"  disabled>
                </div>

                <div class="w3-section">
                    Password *
                    <input class="w3-input w3-border w3-round" type="password" name="password" value="" required>
                </div>
                
                <hr class="w3-clear">
                <input type="hidden" name="act" value="edit" >
                <button type="submit" class="w3-button w3-block w3-padding-large w3-indigo w3-margin-bottom w3-round"><b>SAVE CHANGES</b></button>

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
