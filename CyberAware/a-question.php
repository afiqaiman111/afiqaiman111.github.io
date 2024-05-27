<?PHP
session_start();

include("database.php");
// Verify if the user is an admin
if( !verifyAdmin($con) ) 
{
	header( "Location: index.php" );
	exit();  // Stop further script execution after redirection
}
?>
<?PHP
// Retrieve and sanitize request parameters
$id_asmt_find   = (isset($_REQUEST['id_asmt_find'])) ? intval($_REQUEST['id_asmt_find']) : 0; // Ensure it's an integer
$id_question    = (isset($_REQUEST['id_question'])) ? intval($_REQUEST['id_question']) : 0; // Ensure it's an integer
$id_assessment  = (isset($_REQUEST['id_assessment'])) ? intval($_REQUEST['id_assessment']) : 0; // Ensure it's an integer

$act            = (isset($_REQUEST['act'])) ? htmlspecialchars(trim($_REQUEST['act'])) : ''; // Prevent XSS

$question       = (isset($_POST['question'])) ? trim($_POST['question']) : '';
$option1        = (isset($_POST['option1'])) ? trim($_POST['option1']) : '';
$option2        = (isset($_POST['option2'])) ? trim($_POST['option2']) : '';
$option3        = (isset($_POST['option3'])) ? trim($_POST['option3']) : '';
$option4        = (isset($_POST['option4'])) ? trim($_POST['option4']) : '';
$answer         = (isset($_POST['answer'])) ? intval($_POST['answer']) : 0; // Ensure it's an integer

// Escape strings for safe SQL execution
$question       = mysqli_real_escape_string($con, $question);
$option1        = mysqli_real_escape_string($con, $option1);
$option2        = mysqli_real_escape_string($con, $option2);
$option3        = mysqli_real_escape_string($con, $option3);
$option4        = mysqli_real_escape_string($con, $option4);

$success = "";

// Handle add action
if($act == "add")
{   
    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("
    INSERT INTO `question`(`id_assessment`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`) 
    VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('isssssi', $id_assessment, $question, $option1, $option2, $option3, $option4, $answer);
    $stmt->execute();
    $stmt->close();

    $success = "Successfully Added";
}

// Handle edit action
if($act == "edit")
{   
    $stmt = $con->prepare("
    UPDATE
        `question`
    SET
        `id_assessment` = ?, `question` = ?, `option1` = ?, `option2` = ?, `option3` = ?, `option4` = ?, `answer` = ?
    WHERE `id_question` = ?");
    $stmt->bind_param('isssssii', $id_assessment, $question, $option1, $option2, $option3, $option4, $answer, $id_question);
    $stmt->execute();
    $stmt->close();

    $success = "Successfully Updated";
}

// Handle delete action
if($act == "del")
{
    $stmt = $con->prepare("DELETE FROM `assessment` WHERE `id_assessment` = ?");
    $stmt->bind_param('i', $id_assessment);
    $stmt->execute();
    $stmt->close();

    $success = "Successfully Deleted";
}
?>
<!DOCTYPE html>
<html>
<title>Cyber Aware</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href="css/table.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

<style>
a { text-decoration : none ;}

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
  background-color: rgba(0, 0, 0, 0.5);
  background-blend-mode: overlay;
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
if($success) { 
    // Display success notification
    Notify("success", htmlspecialchars($success), "a-question.php?id_asmt_find=$id_assessment"); 
} 
?> 

<div class="" >

    <div class="w3-padding-32"></div>
    
    <div class=" w3-center w3-text-white w3-padding-32">
        <span class="w3-xxlarge"><b>QUESTION LIST</b></span><br>
    </div>


    <!-- Page Container -->
    <div class="w3-container w3-content" style="max-width:1200px;">    
      <!-- The Grid -->
      <div class="w3-row w3-white w3-card w3-padding">
      
        <div class="w3-padding"></div>
        <form action="" method="post" >
            <div class="w3-row" >                                
                <select class="w3-col s4 w3-select w3-border w3-round w3-padding" name="id_asmt_find" required>
                    <option value="">- Select Assessment - </option>
                    <?PHP 
                    // Retrieve and display assessments
                    $rst = mysqli_query($con , "SELECT * FROM `assessment`");
                    while ($dat = mysqli_fetch_array($rst) )
                    {
                    ?>
                    <option value="<?PHP echo intval($dat["id_assessment"]);?>" <?PHP if($id_asmt_find == $dat["id_assessment"]) echo "selected";?>><?PHP echo htmlspecialchars($dat["assessment"]);?></option>
                    <?PHP } ?>
                </select>
                
                <button type="submit" class="w3-button w3-indigo w3-text-white  w3-round">RETRIEVE</button>
            </div>
        </form> 
        
        <hr>
        
        <a onclick="document.getElementById('add01').style.display='block'; " class="w3-margin-bottom w3-right w3-button w3-indigo w3-round "><i class="fa fa-fw fa-lg fa-plus"></i> Add</a>
        
        <div class="w3-row w3-margin ">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?PHP
            // Retrieve and display questions
            $bil = 0;
            $stmt = $con->prepare("SELECT * FROM `question` WHERE `id_assessment` = ?");
            $stmt->bind_param('i', $id_asmt_find);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($data = $result->fetch_assoc())
            {
                $bil++;
                $id_question = $data["id_question"];
            ?>
            <tr>
                <td><?PHP echo htmlspecialchars($bil);?></td>
                <td><?PHP echo htmlspecialchars($data["question"]);?></td>
                <td><?PHP echo htmlspecialchars($data["answer"]);?></td>
                <td>
                <a href="#" onclick="document.getElementById('idEdit<?PHP echo $bil;?>').style.display='block'" class=""><i class="fa fa-fw fa-edit fa-lg"></i></a>
                
                <a title="Delete" onclick="document.getElementById('idDelete<?PHP echo $bil;?>').style.display='block'" class="w3-text-red"><i class="fa fa-fw fa-trash-alt fa-lg"></i></a>
                </td>
            </tr>
            
<div id="idEdit<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10;">
    <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:600px">
        <header class="w3-container w3-indigo"> 
            <span onclick="document.getElementById('idEdit<?PHP echo $bil;?>').style.display='none'" class="w3-button w3-indigo w3-xlarge w3-display-topright w3-hover-red"><i class="fa fa-fw fa-lg fa-close"></i></span>
            <h4>Edit Question</h4>
        </header>
        <div class="w3-container ">
            <form action="" method="post" >
            <div class="w3-section">
                <input type="hidden" name="id_assessment" value="<?PHP echo intval($id_asmt_find); ?>">
                <input type="hidden" name="id_question" value="<?PHP echo intval($id_question); ?>">
                <input type="hidden" name="act" value="edit">
                
                <label><b>Question</b></label>
                <textarea type="text" class="w3-input w3-border w3-round w3-margin-bottom" name="question" required><?PHP echo htmlspecialchars($data["question"]);?></textarea>

                <label><b>Option 1</b></label>
                <input type="text" class="w3-input w3-border w3-round w3-margin-bottom" name="option1" value="<?PHP echo htmlspecialchars($data["option1"]);?>" required>

                <label><b>Option 2</b></label>
                <input type="text" class="w3-input w3-border w3-round w3-margin-bottom" name="option2" value="<?PHP echo htmlspecialchars($data["option2"]);?>" required>

                <label><b>Option 3</b></label>
                <input type="text" class="w3-input w3-border w3-round w3-margin-bottom" name="option3" value="<?PHP echo htmlspecialchars($data["option3"]);?>" required>

                <label><b>Option 4</b></label>
                <input type="text" class="w3-input w3-border w3-round w3-margin-bottom" name="option4" value="<?PHP echo htmlspecialchars($data["option4"]);?>" required>

                <label><b>Answer</b></label>
                <select class="w3-select w3-border w3-round w3-margin-bottom" name="answer" required>
                    <option value="1" <?PHP if($data["answer"] == "1") echo "selected";?> >Option 1</option>
                    <option value="2" <?PHP if($data["answer"] == "2") echo "selected";?> >Option 2</option>
                    <option value="3" <?PHP if($data["answer"] == "3") echo "selected";?> >Option 3</option>
                    <option value="4" <?PHP if($data["answer"] == "4") echo "selected";?> >Option 4</option>
                </select>
                
                <button class="w3-button w3-block w3-indigo w3-section w3-padding w3-round" type="submit">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
            
<div id="idDelete<?PHP echo $bil;?>" class="w3-modal" style="z-index:10;">
    <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
        <header class="w3-container w3-indigo"> 
            <span onclick="document.getElementById('idDelete<?PHP echo $bil;?>').style.display='none'" class="w3-button w3-indigo w3-xlarge w3-display-topright w3-hover-red"><i class="fa fa-fw fa-lg fa-close"></i></span>
            <h4>Delete</h4>
        </header>
        <div class="w3-container">
            <p>Are you sure you want to delete this question?</p>
            <div class="w3-section w3-right-align">
            <form action="" method="post" >
                <input type="hidden" name="id_assessment" value="<?PHP echo intval($id_asmt_find); ?>">
                <input type="hidden" name="id_question" value="<?PHP echo intval($id_question); ?>">
                <input type="hidden" name="act" value="del">
                <button class="w3-button w3-indigo w3-round" type="submit">Confirm</button>
                <button onclick="document.getElementById('idDelete<?PHP echo $bil;?>').style.display='none'" type="button" class="w3-button w3-indigo w3-round">Cancel</button>
            </form>
            </div>
        </div>
    </div>
</div>
            <?PHP
            }
            $stmt->close();
            ?>
            </tbody>
        </table>
        </div>
        </div>
        
      </div>
    </div>
</div>

<div id="add01" class="w3-modal" style="z-index:10;">
    <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:600px">
        <header class="w3-container w3-indigo"> 
            <span onclick="document.getElementById('add01').style.display='none'" class="w3-button w3-indigo w3-xlarge w3-display-topright w3-hover-red"><i class="fa fa-fw fa-lg fa-close"></i></span>
            <h4>Add Question</h4>
        </header>
        <div class="w3-container ">
            <form action="" method="post" >
            <div class="w3-section">
                <input type="hidden" name="id_assessment" value="<?PHP echo intval($id_asmt_find); ?>">
                <input type="hidden" name="act" value="add">
                
                <label><b>Question</b></label>
                <textarea type="text" class="w3-input w3-border w3-round w3-margin-bottom" name="question" required></textarea>

                <label><b>Option 1</b></label>
                <input type="text" class="w3-input w3-border w3-round w3-margin-bottom" name="option1" required>

                <label><b>Option 2</b></label>
                <input type="text" class="w3-input w3-border w3-round w3-margin-bottom" name="option2" required>

                <label><b>Option 3</b></label>
                <input type="text" class="w3-input w3-border w3-round w3-margin-bottom" name="option3" required>

                <label><b>Option 4</b></label>
                <input type="text" class="w3-input w3-border w3-round w3-margin-bottom" name="option4" required>

                <label><b>Answer</b></label>
                <select class="w3-select w3-border w3-round w3-margin-bottom" name="answer" required>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                    <option value="4">Option 4</option>
                </select>
                
                <button class="w3-button w3-block w3-indigo w3-section w3-padding w3-round" type="submit">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>

</body>
</html>
