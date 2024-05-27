<?php
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
    min-height: 100%;
    background-attachment: fixed;
    background-image: url(images/banner.jpg);
    background-color: rgba(0, 0, 0, 0.5);
    background-blend-mode: overlay;
}

.w3-bar .w3-button {
    padding: 16px;
}

.tutorial-box {
    background-color: #607d8b;
    color: #fff;
    border-radius: 10px;
    padding: 20px;
    height: 300px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.tutorial-title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 15px;
}

.tutorial-content {
    flex-grow: 1;
}

.read-more-button {
    background-color: #fff;
    color: #607d8b;
    border-radius: 5px;
    text-align: center;
    padding: 10px;
    text-decoration: none;
}

.read-more-button:hover {
    background-color: #e0e0e0;
}
</style>

<body>

<?php include("menu.php"); ?>

<div class="bgimg-1">

    <div class="w3-padding-32"></div>

    <div class="w3-padding-64 w3-xxlarge w3-center w3-text-white"><b>Tutorial</b></div>

    <div class="w3-padding-32"></div>

    <div class="w3-container w3-padding-16 w3-white" id="contact">
        <div class="w3-content w3-container">

            <div class="w3-padding-16"></div>

            <div class="w3-padding">

                <div class="w3-row">
                    <?php
                    $bil = 0;
                    $SQL_list = "SELECT * FROM `tutorial`";
                    $result = mysqli_query($con, $SQL_list);
                    while ($data = mysqli_fetch_array($result)) {
                        $bil++;
                        $id_tutorial = $data["id_tutorial"];
                        $title = $data["title"];
                        $title = substrwords($title, 50, $end = '...');

                        $tutorial = $data["tutorial"];
                        $tutorial = substrwords($tutorial, 100, $end = '...');
                    ?>

                    <div class="w3-col m4 w3-padding">
                        <div class="tutorial-box">
                            <div class="tutorial-title"><?php echo $bil . ". " . $title; ?></div>
                            <div class="tutorial-content"><?php echo $tutorial; ?></div>
                            <a href="tutorial-detail.php?id_tutorial=<?php echo $id_tutorial; ?>" class="read-more-button">Read More... <i class="fa fa-fw fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <?php } ?>
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
