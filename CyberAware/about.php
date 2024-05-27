<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Cyber Aware</title>
    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body, h1, h2, h3, h4, h5, h6 {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
        }

        body, html {
            height: 100%;
            line-height: 1.6;
            scroll-behavior: smooth;
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
            color: #fff;
        }

        .w3-bar .w3-button {
            padding: 16px;
        }

        .content-container {
            max-width: 800px;
            margin: auto;
        }

        .about-section {
            padding: 40px 20px;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .about-section img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: auto;
            margin-bottom: 20px;
        }

        .about-section h3 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .about-section p {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }
    </style>
</head>
<body>

<?php include("menu.php"); ?>

<div class="bgimg-1">
    <div class="w3-padding-64"></div>
    <div class="w3-jumbo w3-center"><b>About Us</b></div>

    <div class="w3-content content-container">
        <div class="about-section">
            <h3>Who are we?</h3>
            <div class="w3-center"><img src="images/logo.png" alt="Cyber Guardian Logo"></div>
            <p><b>Cyber Aware</b> is committed to promoting cybersecurity awareness. We believe that cybersecurity is essential for everyone, whether you're a business leader or an individual user. Our goal is to provide valuable insights and practical advice to help you stay safe online.</p>
            <p>We offer role-based training tailored to different levels of expertise, ensuring that each member of your organization understands their role in maintaining cybersecurity. By empowering individuals with relevant information, we aim to create a culture of security awareness that extends beyond the workplace.</p>
            <p>At Cyber Aware, we understand that cybersecurity is a dynamic field, constantly evolving to combat emerging threats. That's why we're dedicated to staying up-to-date with the latest developments in cybersecurity and sharing that knowledge with our community.</p>
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
