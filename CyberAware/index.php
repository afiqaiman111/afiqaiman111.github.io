<?PHP
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cyber Awareness</title>
    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <style>
        body, h1, h2, h3, h4, h5, h6 {font-family: "Poppins", sans-serif}

        body, html {
            height: 100%;
            line-height: 1.8;
            margin: 0;
        }

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

        .w3-text-primary {
            color: #1a73e8 !important;
        }

        .content-container {
            max-width: 1200px;
            margin: auto;
        }

        .owl-carousel .item {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .info-box {
            background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
            padding: 20px;
            margin: 10px;
            border-radius: 8px;
            color: #fff;
            height: 300px;
            width: 280px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .info-box div {
            margin-bottom: 10px;
        }

        .info-box .title {
            font-size: 18px;
            font-weight: bold;
        }

        .info-box .subtitle {
            font-size: 14px;
            color: #FFD700;
        }

        .info-box p {
            font-size: 14px;
            margin: 0;
        }

        .w3-center .w3-button {
            margin-bottom: 10px;
        }

        .w3-center .w3-button:first-child {
            margin-right: 10px;
        }

        .w3-jumbo.welcome {
            font-size: 4em;
            color: #FFD700;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?PHP include("menu.php"); ?>

<div class="bgimg-1">
    <div class="w3-padding-64"></div>
    <div class="w3-jumbo w3-center w3-text-white welcome">Welcome</div>
    <div class="w3-jumbo w3-center w3-text-white"><b>Cyber Security Awareness</b></div>
    <div class="w3-xxlarge w3-center w3-text-white"><b>Learning Platform For Parents</b></div>

    <div class="w3-center w3-padding-16">
        <a href="login.php" class="w3-button w3-round w3-blue">Get Started</a>
        <a href="about.php" class="w3-button w3-round w3-white w3-text-indigo">Learn More</a>
    </div>
    <div class="w3-padding-16"></div>

    <div class="w3-container w3-padding-16" id="contact">
        <div class="w3-content content-container">
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <div class="info-box">
                        <div class="title">Awareness Program</div>
                        <div class="subtitle">Support & Service</div>
                        <p>Our cybersecurity awareness program equips users with the knowledge and tools to protect their families from online threats. Learn about common cybersecurity risks and best practices for online safety.</p>
                    </div>
                </div>
                <div class="item">
                    <div class="info-box">
                        <div class="title">Why Cybersecurity Matters</div>
                        <div class="subtitle">Cyber - Security</div>
                        <p>In today's digital age, cybersecurity is more important than ever. Protecting personal information, securing devices, and understanding online threats are essential skills for every user.</p>
                    </div>
                </div>
                <div class="item">
                    <div class="info-box">
                        <div class="title">Spread Awareness</div>
                        <div class="subtitle">Join Us</div>
                        <p>Join us in spreading awareness about cybersecurity. Share our program with friends, family, and colleagues to ensure that everyone has the knowledge to stay safe online.</p>
                    </div>
                </div>
                <div class="item">
                    <div class="info-box">
                        <div class="title">Cybersecurity Tips</div>
                        <div class="subtitle">Practical Advice</div>
                        <p>Follow these tips to enhance your family's online safety: Use strong passwords, enable two-factor authentication, educate children about online privacy, and keep software up to date.</p>
                    </div>
                </div>
                <div class="item">
                    <div class="info-box">
                        <div class="title">Online Privacy</div>
                        <div class="subtitle">Stay Safe</div>
                        <p>Understand the importance of online privacy. Learn how to protect your personal information and maintain privacy settings on social media and other online platforms.</p>
                    </div>
                </div>
                <div class="item">
                    <div class="info-box">
                        <div class="title">Phishing Awareness</div>
                        <div class="subtitle">Identify Scams</div>
                        <p>Learn how to recognize phishing scams and avoid falling victim to fraudulent emails and websites. Protect your personal and financial information from cybercriminals.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w3-padding-small"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    });
</script>

</body>
</html>
