<?php
	// parameters set up
	$serverName = 'courseplanner.cs9msqhnvnqr.us-west-2.rds.amazonaws.com'; //'localhost';//
	$userName = 'courseplanner'; //'root';//
	$password = 'cpen3210'; //'';//
	$databaseName = 'courseplanner';
	$table = 'Unique Calendar Entry';

	$idArray = $_REQUEST['array'];//array(0,1);//
	
	// get user ID
	require('/var/www/html/session.php');
	$session = Session::getInstance();
	$uid = $session->userID;
	//$uid = 57;


	// **************************************************
	//
	//		Database connecting
	//
	// **************************************************
	// Create connection
	$conn = new mysqli($serverName, $userName, $password, $databaseName);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	// **************************************************
	//
	//		Getting data from database
	//
	// **************************************************
	$sql = "SELECT * FROM `$table` WHERE `userID`=$uid";
	$result = $conn->query($sql);
	//echo $idArray;

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {

	    	//echo $idArray;
	    	
	    	if (!in_array($row["ID"],$idArray)){
	    		unset($row["userID"]);
				echo json_encode($row);
				
				break;
	    	}
			

			
	    }
	    
	} else {
	    echo "[Pulling Failed]: No such a tile in database ...\n";
	}
	$conn->close();
?>







