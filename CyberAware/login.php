<?php
session_start();
?>
<?php
include("database.php");

$act = isset($_POST['act']) ? trim($_POST['act']) : '';

$error = "";

if ($act == "login") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM `user` WHERE `username` = ? AND `password` = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data) {
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        $_SESSION["id_user"] = $data["id_user"];
        header("Location: assessment.php");
        exit();
    } else {
        $error = "Invalid";
        header("refresh:1;url=login.php");
    }
    $stmt->close();
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
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Poppins", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

a:link {
  text-decoration: none;
}

/* Full height image header */
.bgimg-1 {
  background-position: top;
  background-size: cover;
  background-attachment:fixed;
  background-image: url(images/banner.jpg);
  min-height:100%;
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body class="bgimg-1">

<?PHP include("menu.php"); ?>


<div  >

	<div class="w3-padding-32"></div>
		
	<div class=" w3-center w3-text-white w3-padding">
		<span class="w3-large"></span><br>
	</div>


<div class="w3-container w3-padding-16" id="contact">
    <div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:500px">
		<div class="w3-padding">
			<form action="" method="post">
			<img src="images/logo.png" class="w3-image">
			<hr>
			<h3><b>Login User</b></h3>
			
			<?PHP if($error) { ?>			
			<div class="w3-container w3-padding-32" id="contact">
				<div class="w3-content w3-container w3-red w3-round w3-card" style="max-width:600px">
					<div class="w3-padding w3-center">
					<h3>Error! Invalid login</h3>
					<p>Please try again...</p>
					</div>
				</div>
			</div>	
			<?PHP } ?>
			
			
			  <div class="w3-section" >
				<label>Username *</label>
				<input class="w3-input w3-border w3-round" type="username" name="username"  required>
			  </div>
			  <div class="w3-section">
				<label>Password *</label>
				<input class="w3-input w3-border w3-round" type="password" name="password" required>
			  </div>
	
			  <input name="act" type="hidden" value="login">
			  <button type="submit" class="w3-button w3-block w3-padding-large w3-indigo w3-round"><b>LOGIN</b></button>
			</form>
			
		</div>
		
		<div class="w3-center ">Forgot Password? <a href="reset.php" class="w3-text-indigo"><b>Reset</b></a></div>
		<div class="w3-center w3-padding">Don't have an account yet? <a href="register.php" class="w3-text-indigo"><b>Register Now!</b></a></div>

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
