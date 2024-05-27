<?PHP
session_start();
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

<div class="w3-padding-64 w3-xxlarge w3-center w3-text-white"><b>Frequently Asked Question</b></div>

<div class="w3-padding-32"></div>

<div class="w3-container w3-padding-16 w3-white " id="contact">
    <div class="w3-content w3-container " >
		<div class="w3-padding">

			<button onclick="myFunction('Faq1')" class="w3-button w3-block w3-padding-16 w3-white w3-card w3-left-align">
			<b>Why do I need to worry about Cyber Security?</b><span class="w3-right"><i class="fa fa-plus fa-lg"></i></span></button>
			<div id="Faq1" class="w3-hide w3-container w3-border">
				<p>Cyber Security protects unauthorized access and or criminal use of your data. Our lives rely heavily on technology and are vulnerable through communication (email, smartphones), shopping (online shopping, credit cards), entertainment (social media, applications) and medicine (medical records) and so much more</p>
			</div>
			
			<div class="w3-padding"></div>

			<button onclick="myFunction('Faq2')" class="w3-button w3-block w3-padding-16 w3-white w3-card w3-left-align">
			<b>Should I have a different password for every website?</b><span class="w3-right"><i class="fa fa-plus fa-lg"></i></span></button>
			<div id="Faq2" class="w3-hide w3-container w3-border">
				<p>Yes. If you use the same password on every website and someone gets access to it, they can figure out that the password works on other sites as well. They may be able to access your banking information, Social Security number, etc.</p>
			</div>
			
			<div class="w3-padding"></div>
			
			<button onclick="myFunction('Faq3')" class="w3-button w3-block w3-padding-16 w3-white w3-card w3-left-align">
			<b>How can I remember all of my passwords?</b><span class="w3-right"><i class="fa fa-plus fa-lg"></i></span></button>
			<div id="Faq3" class="w3-hide w3-container w3-border">
				<p>You can use a password manager. There are free options and low cost ones. You will have to remember one password to unlock the password manager. It generates strong passwords and stores them.</p>
			</div>
			
			<div class="w3-padding"></div>
			
			<button onclick="myFunction('Faq4')" class="w3-button w3-block w3-padding-16 w3-white w3-card w3-left-align">
			<b>What is Phishing?</b><span class="w3-right"><i class="fa fa-plus fa-lg"></i></span></button>
			<div id="Faq4" class="w3-hide w3-container w3-border">
				<p>Phishing is a type of attack carried out to get money or steal information. The attacks can occur in many ways, i.e. email, texts, phone calls, social media, etc.</p>
			</div>
			
			<div class="w3-padding"></div>
			
			<button onclick="myFunction('Faq5')" class="w3-button w3-block w3-padding-16 w3-white w3-card w3-left-align">
			<b>Do mobile devices present security risks?</b><span class="w3-right"><i class="fa fa-plus fa-lg"></i></span></button>
			<div id="Faq5" class="w3-hide w3-container w3-border">
				<p>Mobile devices do bring great utility in terms of convenience and allowing individuals to be “online all the time.” Governments have widely deployed mobile devices for accessing resources and greater workforce productivity. However, the use of mobile devices for communicating and for sharing data create inherent security issues and add more points of access to the network. Mobile malware threats are certainly growing and a significant security concern with mobile devices is the loss of the device. Additional risks related to mobile devices are personal devices being used in the workplace and authentication of the user. The National Institute of Standards and Technologies (NIST) publication “Guidelines for Managing the Security of Mobile Devices in the Enterprise” (SP 800-124) outlines a number of items for government organizations should follow.</p>
			</div>
			
			<div class="w3-padding"></div>
			
			<button onclick="myFunction('Faq6')" class="w3-button w3-block w3-padding-16 w3-white w3-card w3-left-align">
			<b>What are the risks of cyberbullying?</b><span class="w3-right"><i class="fa fa-plus fa-lg"></i></span></button>
			<div id="Faq6" class="w3-hide w3-container w3-border">
				<p>Cyberbullying can have severe emotional and psychological effects on victims, leading to anxiety, depression, and even suicide. It's essential to raise awareness about cyberbullying and take steps to prevent it.</p>
			</div>

			<div class="w3-padding"></div>

			<button onclick="myFunction('Faq7')" class="w3-button w3-block w3-padding-16 w3-white w3-card w3-left-align">
			<b>What are the risks of scams?</b><span class="w3-right"><i class="fa fa-plus fa-lg"></i></span></button>
			<div id="Faq7" class="w3-hide w3-container w3-border">
				<p>scam is a fraudulent scheme performed by a dishonest individual, group, or company in an attempt to obtain money or something else of value. Scams can take many forms, such as fake emails, phone calls, or websites, promising prizes, jobs, or financial benefits to deceive victims into providing personal or financial information or sending money.</p>
			</div>

			<div class="w3-padding"></div>

			<button onclick="myFunction('Faq8')" class="w3-button w3-block w3-padding-16 w3-white w3-card w3-left-align">
			<b>Other Question ?</b><span class="w3-right"><i class="fa fa-plus fa-lg"></i></span></button>
			<div id="Faq8" class="w3-hide w3-container w3-border">
				<p>Description here..</p>
			</div>
			
			<div class="w3-padding"></div>

			</div>
			<script>
			function myFunction(id) {
			  var x = document.getElementById(id);
			  if (x.className.indexOf("w3-show") == -1) {
				x.className += " w3-show";
				x.previousElementSibling.className = 
				x.previousElementSibling.className.replace("w3-black", "w3-red");
			  } else { 
				x.className = x.className.replace(" w3-show", "");
				x.previousElementSibling.className = 
				x.previousElementSibling.className.replace("w3-red", "w3-black");
			  }
			}
			</script>
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
