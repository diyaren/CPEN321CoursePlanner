<?php
	// parameters set up
	$serverName = 'courseplanner.cs9msqhnvnqr.us-west-2.rds.amazonaws.com'; //'localhost';//
	$userName = 'courseplanner'; //'root';//
	$password = 'cpen3210'; //'';//
	$databaseName = 'courseplanner';
	$table = 'Unique Calendar Entry';

	
	
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
	$returnNum = 0;

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        //only return the expected one
			$returnNum++;
			
	    }
	    echo $returnNum;
	} else {
	    echo "[Pulling Failed]: No such a tile in database ...\n";
	}
	$conn->close();
?>