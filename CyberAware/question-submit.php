<?php
session_start();
include("database.php");

$id_assessment = isset($_REQUEST['id_assessment']) ? trim($_REQUEST['id_assessment']) : '0';

// Use prepared statements to prevent SQL Injection
$stmt = $con->prepare("SELECT * FROM `assessment` WHERE `id_assessment` = ?");
$stmt->bind_param("i", $id_assessment); // Bind the parameter as an integer
$stmt->execute(); // Execute the prepared statement
$result = $stmt->get_result(); // Get the result set
$data = $result->fetch_array(); // Fetch the data as an associative array
$assessment = htmlspecialchars($data["assessment"], ENT_QUOTES, 'UTF-8'); // Sanitize the output

?>
<!DOCTYPE html>
<html>
<title>Cyber Aware</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Poppins", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

/* Full height image header */
.bgimg-1 {
  background-position: top;
  background-size: cover;
  min-height: 100%;
  background-attachment: fixed;
  background-image: url(images/banner.jpg);
  background-color: rgba(0, 0, 0, 0.5);
  background-blend-mode: overlay;
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body>

<?PHP include("menu.php"); ?>

<div class="bgimg-1" >

<div class="w3-padding-32"></div>

<div class="w3-padding-64 w3-xxlarge w3-center w3-text-white"><b><?PHP echo $assessment; // Output sanitized assessment ?></b></div>

<div class="w3-padding-32"></div>

<div class="w3-container w3-padding-16 w3-white" id="contact">
    <div class="w3-content w3-container" >
        
        <div class="w3-padding-16"></div>
        
    
        <div class="w3-padding w3-center">

    
            <?PHP 
            // Use prepared statements to prevent SQL Injection
            $stmt = $con->prepare("SELECT * FROM `question` WHERE id_assessment = ?");
            $stmt->bind_param("i", $id_assessment); // Bind the parameter as an integer
            $stmt->execute(); // Execute the prepared statement
            $result = $stmt->get_result(); // Get the result set
            $total_q = $result->num_rows;     
            $score = 0;
            
            for ($bil = 1; $bil <= $total_q; $bil++) {
                $score = $score + (isset($_POST["jawab$bil"]) ? (int)$_POST["jawab$bil"] : 0);
            }
            
            $percent = ($score / $total_q) * 100;
            
            if ($percent >= 75) {            
            ?>            
            <div class="w3-text-green w3-xxlarge">
                <i class="fa fa-thumbs-up fa-4x"></i><br>
                <b class="">PASS</b>
            </div>
            <?PHP } else { ?>
            <div class="w3-text-red w3-xxlarge">
                <i class="fa fa-thumbs-down fa-4x"></i><br>
                <b class="">FAIL</b>
            </div>
            <?PHP } ?>
            
            <div class="w3-padding-24"></div>
            
            <div class="w3-section" >
                <a href="assessment.php" class="w3-button w3-indigo w3-text-white w3-round"><i class="fa fa-fw fa-chevron-left"></i> ASSESSMENT</a>
                <a href="question.php?id_assessment=<?PHP echo htmlspecialchars($id_assessment, ENT_QUOTES, 'UTF-8'); ?>" class="w3-button w3-indigo w3-text-white w3-round">RETRY <i class="fa fa-fw fa-history"></i> </a>
            </div>
        </div>

        
        <div class="w3-padding-24"></div>
    </div>
</div>

    
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
