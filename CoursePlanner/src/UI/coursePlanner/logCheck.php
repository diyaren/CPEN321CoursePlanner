<?php
        require("session.php");
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

        $response = array();
        //Create new session
        $session = Session::getInstance();
        if( isset($_REQUEST['facebookid']) ){
            //FB userID from Javascript above (should be unique for every user)
            $fbID = $_REQUEST['facebookid'];
            //If user already exists, don't add a new db entry, otherwise create one
            if( $conn->query("INSERT INTO `User Profile` (`fbID`) VALUES ('$fbID')") === TRUE ){
                $response = array('firstLogin' => 'TRUE');
            } else{
                $response = array('firstLogin' => 'FALSE');
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
        $conn->close();
        echo json_encode($response);
?>

