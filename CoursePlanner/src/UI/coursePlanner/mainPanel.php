
<!DOCTYPE HTML>

<html>
<head>
<meta charset="utf-8">

	<title>Main Panel</title>
    <!-- Bootstrap for page header-->
    <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel = "stylesheet">
	<link rel="stylesheet" type="text/css" href="css/sidebar.css">
	<link rel="stylesheet" type="text/css" href="css/mainPanel.css">	
</head>

<body>
<?php
    include("inc/sidebar.html");
    include("infoFillIn.php");  
?>


<h1 style="text-align: center;">
        Welcome to Course Planner!
</h1>
<h2 style="text-align: center;">
        CPEN311 Team CP
</h2>

<?php 
include("newReminderButton.php");
?>
                <div class="container">
                        <div class="column column-one column-offset-2">Diya Ren</div>
                        <div class="column column-two column-inset-1">Andrew Dombowsky</div>
                        <div class="column column-three column-offset-1">Chance Gao</div>
                        <div class="column column-four column-inset-2">Mengxi Zhang</div>
                        <div class="column column-five">Pitr Crandall</div>
                </div>
                <div class="container">
                        <div class="column column-one column-offset-2">CPEN</div>
                        <div class="column column-two column-inset-1">CPEN</div>
                        <div class="column column-three column-offset-1">CPEN</div>
                        <div class="column column-four column-inset-2">CPEN</div>
                        <div class="column column-five">CPEN</div>
                </div>
                <div class="container">
                        <div class="column column-one column-offset-2">
                                <img src="img/DiyaR.jpg" alt="Mountain View" style="max-width:100%;max-height:100%;">
                        </div>
                        <div class="column column-two column-inset-1">
                                <img src="img/AndrewD.jpg" alt="Mountain View" style="max-width:100%;max-height:100%;">
                        </div>
                        <div class="column column-three column-offset-1">
                                <img src="img/ChanceG.jpg" alt="Mountain View" style="max-width:100%;max-height:100%;">
                        </div>
                        <div class="column column-four column-inset-2">
                                <img src="img/MengxiZ.jpg" alt="Mountain View" style="max-width:100%;max-height:100%;">
                        </div>
                        <div class="column column-five">
                                <img src="img/PietrC.jpg" alt="Mountain View" style="max-width:100%;max-height:100%;">
                        </div>
                </div>
	</div>
    <script type="text/javascript">
      // create footer
      var footer = document.createElement("div"); 
      var footer_text = document.createTextNode("CPEN321 Team Course Planner");
      footer.appendChild(footer_text);
      footer.id = "footer";
      document.body.appendChild(footer);
    </script>

<script src="js/sidebar.js"></script>

<?php
        /*require("session.php");
        //Access the database connection created on login
        //$conn = $session->db;
        $serverName = "courseplanner.cs9msqhnvnqr.us-west-2.rds.amazonaws.com:3306";
        $userName = "courseplanner";
        $password = "cpen3210";
        $databaseName = "courseplanner";
        //Create a new database object and connect to it
        $conn = new mysqli($serverName, $userName, $password, $databaseName);

        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        //Create new session
        $session = Session::getInstance();
        if( isset($_POST['facebookid']) ){
            //FB userID from Javascript above (should be unique for every user)
            $fbID = $_POST['facebookid'];
            //If user already exists, don't add a new db entry, otherwise create one
            if( $conn->query("INSERT INTO `User Profile` (`fbID`) VALUES ('$fbID')") === TRUE ){
                echo "New record created!";
            } else{
                echo $conn->error;
            }
            //Get the unique row ID for the new user, or retrieve their old one
            $result = $conn->query("SELECT ID FROM `User Profile` WHERE `fbID`='". $fbID. "'");
            if( $result->num_rows > 0 ){
                while($row = $result->fetch_assoc()){
                    $uid = $row["ID"];
                }
            }
            //Store the user's ID in the session for use later
            $session->userID = $uid;
            //$session->db = $conn;
        }
        $conn->close();*/
?>
</body>
</html>
