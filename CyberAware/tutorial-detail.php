<?php
session_start();
include("database.php");

$id_tutorial = (isset($_REQUEST['id_tutorial'])) ? trim($_REQUEST['id_tutorial']) : '0';

// Ensure $id_tutorial is an integer
$id_tutorial = intval($id_tutorial);

$stmt = $con->prepare("SELECT * FROM `tutorial` WHERE `id_tutorial` = ?");
$stmt->bind_param("i", $id_tutorial);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_array(MYSQLI_ASSOC);

$title = $data["title"];
$tutorial = $data["tutorial"];

$stmt->close();
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
  background-attachment:fixed;
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

<div class="w3-padding-64 w3-xxlarge w3-center w3-text-white"><b><?PHP echo $title;?></b></div>

<div class="w3-padding-32"></div>

<div class="w3-container w3-padding-16 w3-white " id="contact">
    <div class="w3-content w3-container " >
		
		<div class="w3-padding-16"></div>
		
		<div class="w3-padding">

			<?PHP echo $tutorial;?>
			
			
		</div>
		<div class="w3-padding-16"></div>
		
		<div class="w3-center " >
			<a href="tutorial.php" class="w3-button w3-indigo w3-text-white  w3-round"><i class="fa fa-fw fa-chevron-left"></i> ALL TUTORIAL</a>
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
