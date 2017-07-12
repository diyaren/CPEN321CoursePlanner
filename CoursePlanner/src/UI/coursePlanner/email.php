<?php

$serverName = 'courseplanner.cs9msqhnvnqr.us-west-2.rds.amazonaws.com';
$userName = 'courseplanner';
$password = 'cpen3210';
$databaseName = 'courseplanner';
//Create a new database object and connect to it
$conn = new mysqli($serverName, $userName, $password, $databaseName);
if($conn->connect_error){
	die("Error: ". $conn->connect_error);
}

//Get the current date (db uses 1 for sunday 7 for saturday)
$date_array = getdate();
$year = $date_array['year'];
$month = $date_array['mon'];
$dayOfMonth = $date_array['mday'];
$dayOfWeek = $date_array['wday'];
if($dayOfWeek == 0)
	$dayOfWeekStr = 'sun';
if($dayOfWeek == 1)
	$dayOfWeekStr = 'mon';
if($dayOfWeek == 2)
	$dayOfWeekStr = 'tue';
if($dayOfWeek == 3)
	$dayOfWeekStr = 'wed';
if($dayOfWeek == 4)
	$dayOfWeekStr = 'thu';
if($dayOfWeek == 5)
	$dayOfWeekStr = 'fri';
if($dayOfWeek == 6)
	$dayOfWeekStr = 'sat';

//E-mail parameters
$subject = "Here's your CoursePlanner schedule for today!";
$header = 'From: CoursePlanner<no-reply@courseplanner.de>' . 
			"\r\n". 'X-Mailer: PHP/'. phpversion().
			"MIME-Version: 1.0\r\n".
			"Content-type: text/html;charset=UTF-8\r\n";

//Get user information
$sql = "SELECT `email`, `ID`, `Name` FROM `User Profile` WHERE `remind`='y'";
$result = $conn->query($sql);
while( $row = $result->fetch_assoc() ){
	$email = $row['email'];
	if($email != NULL){
		$to = $email;
		$uid = $row['ID'];
		$name = explode( " ", $row['Name'] );
		if(count($name) != 0)
			$first = $name[0];
		else
			$first = "";
		//grab schedule info ordered by their time, ascending by default
		//i.e. earliest to latest
		$sql = "SELECT * FROM `Unique Calendar Entry` WHERE `userID`=$uid 
				AND `Date`='$dayOfWeekStr' AND `courseID` IS NULL ORDER BY `Start`";
		$tasks = $conn->query($sql);
		echo $conn->error;
		if( $tasks->num_rows > 0 ){
			$title = array();
			$location = array();
			$time = array();
			while( $tasksRow = $tasks->fetch_assoc() ){
				$rowStart = explode( "/", $tasksRow['Start_Date'] );
				$rowEnd = explode( "/", $tasksRow['End_Date'] );
				//if the task period has started and has not expired yet
				if( ($year >= $rowStart[0] && ($month > $rowStart[1] || ($month == $rowStart[1] && $dayOfMonth >= $rowStart[2]))) &&
					($year <= $rowEnd[0] && ($month < $rowEnd[1] || ($month == $rowEnd[1] && $dayOfMonth <= $rowEnd[2]))) ){

					$title[] = $tasksRow['Title'];
					$location[] = $tasksRow['Location'];
					$time[] = $tasksRow['Start'];
				}	
			}
			$message = <<<EMAIL
			<html>
			<body>
				<p>Hey $first, here's your schedule for the day!</p>
				<table rules="all" style="border-color: #666;" cellpadding="10">
				<tr style='background: #eee'>
					<th><strong>Task</strong></th>
					<th><strong>Time</strong></th>
					<th><strong>Location</strong></th>
				</tr>
EMAIL;
			for( $i = 0, $size = count($title); $i < $size; $i++ ){
				$message .= "<tr>";
				$message .= "<td> $title[$i] </td>";
				$message .= "<td> $time[$i] </td>";
				$message .= "<td> $location[$i] </td>";
				$message .= "</tr>";
			}
			//add <img src="http://courseplanner.de/img/cp-logo-text.png" alt="CP-Logo" height="84" width="275">
			$message .= <<<EMAIL
				</table>
				<p>From your friends at CoursePlanner, have a great day!</p>
			</body>
			</html>
EMAIL;
			$retval = mail($to,$subject,$message,$header);
			if( $retval == true )
				echo "Message sent\n";
			else
				echo "Message not sent\n";
		}
	}
}
$conn->close();
