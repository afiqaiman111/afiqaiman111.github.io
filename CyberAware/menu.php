<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-card" id="myNavbar">

	&nbsp;<a href="index.php" class="w3-bar-item1"><img src="images/logo.png" height="55"></a>


    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small"> 
	  
		<a href="index.php" class="w3-bar-item w3-button">HOME</a>
	  
		<?PHP if(!isset($_SESSION["username"])) {?>
		<a href="about.php" class="w3-bar-item1 w3-button">ABOUT</a>
		<?PHP } ?>
		
		<a href="faq.php" class="w3-bar-item1 w3-button">FAQ</a>	

		<a href="contact.php" class="w3-bar-item1 w3-button">CONTACT</a>			

		<a href="assessment.php" class="w3-bar-item1 w3-button <?PHP if(isset($_SESSION["username"])) { echo "w3-text-indigo"; } ?>">ASSESSMENT</a>
		
		<?PHP if(isset($_SESSION["username"])) {?>		
		<a href="tutorial.php" class="w3-bar-item1 w3-button w3-text-indigo">TUTORIAL</a>
		<a href="profile.php" class="w3-bar-item1 w3-button w3-text-indigo">PROFILE</a>
		<?PHP } ?>

		<?PHP if(isset($_SESSION["username"])) {?>
		<a href="logout.php" class="w3-padding w3-round-xlarge w3-border w3-border-white w3-white w3-bar-item1 w3-button w3-text-indigo"><i class="fa fa-fw fa-lg fa-power-off"></i>   LOGOUT</a>
		<?PHP } else { ?>
		<a href="login.php" class="w3-padding w3-round-xlarge w3-border w3-border-white w3-white w3-bar-item1 w3-button"><i class="fa fa-fw fa-lg fa-lock"></i>   LOGIN</a>
		<?PHP } ?>

		<?PHP if(!isset($_SESSION["username"])) {?>
		<a href="admin.php" class="w3-bar-item1 w3-button">ADMIN</a>
		<?PHP } ?>

    </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->


	<a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
	

  </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-light-blue w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
	<a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
	
	<?PHP if(!isset($_SESSION["username"])) {?>
	<a href="about.php" onclick="w3_close()" class="w3-bar-item w3-button">ABOUT</a>
	<?PHP } ?>
	
	<a href="faq.php" onclick="w3_close()" class="w3-bar-item w3-button">FAQs</a>	
	
	<a href="assessment.php" onclick="w3_close()" class="w3-bar-item w3-button">ASSESSMENT</a>
	
	<?PHP if(isset($_SESSION["username"])) {?>	
	<a href="tutorial.php" onclick="w3_close()" class="w3-bar-item w3-button">TUTORIAL</a>
	<a href="profile.php" onclick="w3_close()" class="w3-bar-item w3-button">PROFILE</a>
	<?PHP } ?>
	
	<?PHP if(isset($_SESSION["username"])) {?>
	<a href="logout.php" onclick="w3_close()" class="w3-bar-item w3-button">LOGOUT</a>
	<?PHP } else { ?>
	<a href="login.php" onclick="w3_close()" class="w3-bar-item w3-button">LOGIN</a>
	<?PHP } ?>
	
	<?PHP if(!isset($_SESSION["username"])) {?>
	<a href="admin.php" onclick="w3_close()" class="w3-bar-item w3-button">ADMIN</a>
	<?PHP } ?>
	
	<a href="contact.php" onclick="w3_close()" class="w3-bar-item w3-button">CONTACTx</a>

</nav>