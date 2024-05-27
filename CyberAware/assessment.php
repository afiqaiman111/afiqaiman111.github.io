<?PHP
session_start();
include("database.php");
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

<div class="w3-padding-64 w3-xxlarge w3-center w3-text-white"><b>Assessment</b></div>

<div class="w3-padding-32"></div>

<div class="w3-container w3-padding-16 w3-white " id="contact">
    <div class="w3-content w3-container " >
		
		<div class="w3-padding-16"></div>
		
		<div class="w3-padding">

			<div class="w3-row">
				<?PHP
				$bil = 0;
				$SQL_list = "SELECT * FROM `assessment` ";
				$result = mysqli_query($con, $SQL_list) ;
				while ( $data	= mysqli_fetch_array($result) )
				{
					$bil++;
					$id_assessment 	= $data["id_assessment"];
					$assessment  	= $data["assessment"];
					$assessment 	= substrwords($assessment, 50, $end='...');
					
					$description 	= $data["description"];
					$description 	= substrwords($description, 50, $end='...');
				?>
				
				<div class="w3-col m4 w3-padding">
					<div class="w3-indigo w3-round w3-padding">
						<div class="w3-text-white w3-large"><b><?PHP echo $bil .". ". $assessment; ?></b></div>
						<p><?PHP echo $description;?></p>
						<?PHP if(isset($_SESSION["username"])) {?>
							<a href="question.php?id_assessment=<?PHP echo $id_assessment;?>" class="w3-button w3-block w3-round w3-white">Question <i class="fa fa-fw fa-chevron-right"></i></a>
						<?PHP } else { ?>
							<a href="#" class="w3-disabled w3-button w3-block w3-round w3-white">Question <i class="fa fa-fw fa-chevron-right"></i></a>
						<?PHP } ?>
					</div>
				</div>
				<?PHP } ?>

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
