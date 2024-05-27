<?php
session_start();
include("database.php");

// Securely retrieve id_assessment from the request, defaulting to 0 if not set
$id_assessment = isset($_REQUEST['id_assessment']) ? (int)$_REQUEST['id_assessment'] : 0;

// Use prepared statements to prevent SQL Injection
$stmt = $con->prepare("SELECT * FROM `assessment` WHERE `id_assessment` = ?");
$stmt->bind_param("i", $id_assessment); // Bind the parameter as an integer
$stmt->execute(); // Execute the prepared statement
$result = $stmt->get_result(); // Get the result set
$data = $result->fetch_array(); // Fetch the data as an associative array

// Sanitize the output to prevent XSS attacks
$assessment = htmlspecialchars($data["assessment"], ENT_QUOTES, 'UTF-8');
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

<div class="bgimg-1">

<div class="w3-padding-32"></div>

<div class="w3-padding-64 w3-xxlarge w3-center w3-text-white"><b><?PHP echo $assessment; // Output sanitized assessment ?></b></div>

<div class="w3-padding-32"></div>

<div class="w3-container w3-padding-16 w3-white" id="contact">
    <div class="w3-content w3-container">

        <div class="w3-padding-16"></div>

        <form action="question-submit.php" method="post">
        <div class="w3-padding">

            <?PHP
                $bil = 0;
                // Use prepared statements to prevent SQL Injection
                $stmt = $con->prepare("SELECT * FROM `question` WHERE id_assessment = ?");
                $stmt->bind_param("i", $id_assessment); // Bind the parameter as an integer
                $stmt->execute(); // Execute the prepared statement
                $result = $stmt->get_result(); // Get the result set
                while ($data = $result->fetch_array()) { // Fetch data in a loop
                    $bil++;
                    // Sanitize all output to prevent XSS attacks
                    $question = htmlspecialchars($data["question"], ENT_QUOTES, 'UTF-8');
                    $option1 = htmlspecialchars($data["option1"], ENT_QUOTES, 'UTF-8');
                    $option2 = htmlspecialchars($data["option2"], ENT_QUOTES, 'UTF-8');
                    $option3 = htmlspecialchars($data["option3"], ENT_QUOTES, 'UTF-8');
                    $option4 = htmlspecialchars($data["option4"], ENT_QUOTES, 'UTF-8');
                    $answer = (int)$data["answer"]; // Ensure answer is treated as an integer
                ?>
                
                <div class="w3-padding">
                    
                    <div class="w3-large"><b><?PHP echo $bil .". ". $question; // Output sanitized question ?></b></div>
                        
                    <div class="w3-padding-small">
                        <input class="w3-radio w3-margin-right" type="radio" name="jawab<?PHP echo $bil; ?>" value="<?PHP echo $answer == 1 ? '1' : '0'; ?>" required><?PHP echo $option1; // Output sanitized option1 ?>
                    </div>
                    <div class="w3-padding-small">
                        <input class="w3-radio w3-margin-right" type="radio" name="jawab<?PHP echo $bil; ?>" value="<?PHP echo $answer == 2 ? '1' : '0'; ?>" required><?PHP echo $option2; // Output sanitized option2 ?>
                    </div>
                    <div class="w3-padding-small">
                        <input class="w3-radio w3-margin-right" type="radio" name="jawab<?PHP echo $bil; ?>" value="<?PHP echo $answer == 3 ? '1' : '0'; ?>" required><?PHP echo $option3; // Output sanitized option3 ?>
                    </div>
                    <div class="w3-padding-small">
                        <input class="w3-radio w3-margin-right" type="radio" name="jawab<?PHP echo $bil; ?>" value="<?PHP echo $answer == 4 ? '1' : '0'; ?>" required><?PHP echo $option4; // Output sanitized option4 ?>
                    </div>
                    
                </div>
                
                <div class="w3-padding-small"></div>
                <?PHP } ?>
            
            <div class="w3-section w3-center">
                <input name="id_assessment" type="hidden" value="<?PHP echo $id_assessment; // Output sanitized id_assessment ?>">
                <button type="submit" class="w3-button w3-indigo w3-text-white w3-round">SUBMIT ASSESSMENT  <i class="fa fa-fw fa-chevron-right"></i> </button>
            </div>
        </div>
        </form>
        
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