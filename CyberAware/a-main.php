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
$SQL_view 	= " SELECT * FROM `admin` WHERE `username` =  '". $_SESSION["username"] ."'";
$result 	= mysqli_query($con, $SQL_view);
$data		= mysqli_fetch_array($result);

$today = date("Y-m-d");

$tot_assessment	= numRows($con, "SELECT * FROM `assessment`");
$tot_tutorial	= numRows($con, "SELECT * FROM `tutorial`");
$tot_user		= numRows($con, "SELECT * FROM `user`");
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
body, h1, h2, h3, h4, h5, h6 {
    font-family: "Poppins", sans-serif;
}

body, html {
    height: 100%;
    line-height: 1.8;
}

/* Full height image header */
.bgimg-1 {
    background-position: top;
    background-size: cover;
    background-attachment: fixed;
    background-image: url("images/banner.jpg");
    background-color: rgba(0, 0, 0, 0.5);
    background-blend-mode: overlay;
    min-height: 100%;
}

.w3-bar .w3-button {
    padding: 16px;
}

.dashboard-card {
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    color: white;
}

.bg-assessment {
    background-color: #4CAF50; /* Green */
}

.bg-tutorial {
    background-color: #2196F3; /* Blue */
}

.bg-user {
    background-color: #FF9800; /* Orange */
}

.card-header {
    font-size: 18px;
    margin-bottom: 15px;
}

.card-value {
    font-size: 32px;
    text-align: center;
}
</style>

<body class="bgimg-1">

<?PHP include("menu-admin.php"); ?>

<div class="w3-padding-32"></div>

<div class="w3-center w3-text-white w3-padding-32">
    <span class="w3-xxlarge"><b>DASHBOARD</b></span><br>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1000px;">    
    <!-- The Grid -->
    <div class="w3-row">

        <div class="w3-padding w3-padding-16">
            <div class="w3-card w3-padding w3-round w3-white">
                <div class="w3-xlarge w3-padding-24 w3-padding">
                    <div class="w3-padding">Welcome, Admin</div>
                </div>
                
                <div class="w3-row w3-padding-24">
                    <div class="w3-col m4 w3-container">
                        <div class="dashboard-card bg-assessment">
                            <div class="card-header">
                                Assessment <i class="fa fa-question fa-lg w3-right"></i> 
                            </div>
                            <hr style="border-top: 1px dashed; margin: 1px 0 15px !important;">
                            <div class="card-value"><?PHP echo $tot_assessment;?></div>
                        </div>
                    </div>
        
                    <div class="w3-col m4 w3-container">
                        <div class="dashboard-card bg-tutorial">
                            <div class="card-header">
                                Tutorial <i class="fa fa-inbox fa-lg w3-right"></i> 
                            </div>
                            <hr style="border-top: 1px dashed; margin: 1px 0 15px !important;">
                            <div class="card-value"><?PHP echo $tot_tutorial;?></div>
                        </div>
                    </div>
                    
                    <div class="w3-col m4 w3-container">
                        <div class="dashboard-card bg-user">
                            <div class="card-header">
                                User <i class="fa fa-user fa-lg w3-right"></i> 
                            </div>
                            <hr style="border-top: 1px dashed; margin: 1px 0 15px !important;">
                            <div class="card-value"><?PHP echo $tot_user;?></div>
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>

    <!-- End Grid -->
    </div>
<!-- End Page Container -->
</div>

<div class="w3-padding-24"></div>

<script>
function w3_open() {
    var mySidebar = document.getElementById("mySidebar");
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
    } else {
        mySidebar.style.display = 'block';
    }
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}
</script>

</body>
</html>
