<?PHP
session_start();

include("database.php");
if( !verifyAdmin($con) ) 
{
	header( "Location: index.php" );
	return false;
}
?>
<?PHP	
$id_tutorial= (isset($_REQUEST['id_tutorial'])) ? trim($_REQUEST['id_tutorial']) : '';	
$act 		= (isset($_POST['act'])) ? trim($_POST['act']) : '';	

$tutorial	= (isset($_POST['tutorial'])) ? trim($_POST['tutorial']) : '';
$title		= (isset($_POST['title'])) ? trim($_POST['title']) : '';

$tutorial	=	mysqli_real_escape_string($con, $tutorial);
$title=	mysqli_real_escape_string($con, $title);

$success = "";

if($act == "add")
{	
	$SQL_insert = " 
	INSERT INTO `tutorial`(`id_tutorial`, `tutorial`, `title`) 
						VALUES (NULL, '$tutorial', '$title')";		
										
	$result = mysqli_query($con, $SQL_insert);
	
	$success = "Successfully Add";
	
	//print "<script>self.location='a-package.php';</script>";
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

<!-- include summernote css-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- include summernote js-->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


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

<?PHP include("menu-admin.php"); ?>

<!--- Toast Notification -->
<?PHP 
if($success) { Notify("success", $success, "a-tutorial.php"); }
?>	


<div class="" >

	<div class="w3-padding-48"></div>
		
	
<div class="w3-container w3-padding" id="contact">
    <div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:1000px">
		<div class="w3-padding">
		
			

		<div class="w3-container w3-padding">
		
		<form action="" method="post" >
			<div class="w3-padding"></div>
			<b class="w3-large">Add Tutorial</b>
			<hr>
			
				<div class="w3-section" >
					<label>Title *</label>
					<input class="w3-input w3-border w3-round" type="text" name="title" required>
				</div>
				
				<div class="w3-section" >
					<label>Tutorial *</label>
					<textarea class="w3-input w3-border w3-round" name="tutorial" id="makeMeSummernote2"  rows="5"  required></textarea>
				</div>
			  
			  <hr class="w3-clear">
			  
			  <div class="w3-section" >
				<input name="act" type="hidden" value="add">
				<a href="a-tutorial.php" class="w3-button w3-grey w3-text-white w3-margin-bottom w3-round"><i class="fa fa-fw fa-chevron-left"></i> BACK</a>
				<button type="submit" class="w3-button w3-indigo w3-text-white w3-margin-bottom  w3-round">SUBMIT</button>
			  </div>
			</div>  
		</form> 
		</div>
	
			
		</div>
    </div>
</div>


<div class="w3-padding-16"></div>
	
</div>


<!-- Script -->
<script type="text/javascript">
	$('#makeMeSummernote,#makeMeSummernote2').summernote({
		height:500,
	});
</script>

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