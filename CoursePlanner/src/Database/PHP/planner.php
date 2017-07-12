<html>
<head>
<title>
<?php echo "crawl and fetch ubc ssc courses schedule and put into db";?>
</title>
</head>
<body>
<?php
//-------------------------------------------
//library to crawler
//-------------------------------------------
include_once("simple_html_dom.php");
//-------------------------------------------
//function to fetch https
//-------------------------------------------
function getHTTPS($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_HEADER,0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}
//-------------------------------------------
// Defining the basic scraping function
//-------------------------------------------
function scrape_between($data, $start, $end){
	$data = stristr($data, $start); // Stripping all data from before $start
	$data = substr($data, strlen($start));  // Stripping $start
	$stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
	$data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
	return $data;   // Returning the scraped data from the function
}
/*
//-------------------------------------------
// Get the level 1 link and save in a csv file
// The csv file will be edit to delet un-need link
// Then will take the new csv file to crawler again
//-------------------------------------------
// set target url to crawl
$url = "https://courses.students.ubc.ca/cs/main?pname=subjarea"; 
// open the web page
$html = new simple_html_dom();
$html->load_file($url);
// array to store scraped links
$links_level_1 = array();
// crawl the webpage for links
foreach($html->find("a") as $link){
    array_push($links_level_1, $link->href);
}
// remove duplicates from the links array
$links_level_1 = array_unique($links_level_1);
// set output headers to download file
header("Content-Type: text/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=links_level_1.csv");
// set file handler to output stream
$output = fopen("php://output", "w");
// output the scraped links
fputcsv($output, $links_level_1, "\n");
//-------------------------------------------
// Level 1 crawler clean up
//-------------------------------------------
//open the new csv file, store into array
//the array need implode to string
//and miss https://courses.students.ubc.ca
$links_level_1_new = array_map("str_getcsv",file("links_level_1_new.csv"));
foreach($links_level_1_new as &$item){
	$item = 'https://courses.students.ubc.ca'.implode($item);
}
*/
/*
//-------------------------------------------
// Level 2 crawler
//-------------------------------------------
// array to store scraped links
$links_level_2 = array();
foreach($links_level_1_new as &$item){
	// set target url to crawl
	$url = $item; 
	// open the web page
	$html = new simple_html_dom();
	$html->load_file($url);
	// crawl the webpage for links
	foreach($html->find("a") as $link){
		array_push($links_level_2, $link->href);
	}
	// remove duplicates from the links array
	$links_level_2 = array_unique($links_level_2);
}
// set output headers to download file
header("Content-Type: text/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=links_level_2.csv");
// set file handler to output stream
$output = fopen("php://output", "w");
// output the scraped links
fputcsv($output, $links_level_2, "\n");	
//-------------------------------------------
// Level 2 crawler clean up
//-------------------------------------------
//open the new csv file, store into array
//the array need implode to string
//and miss https://courses.students.ubc.ca
$links_level_2_new = array_map("str_getcsv",file("links_level_2_new.csv"));
foreach($links_level_2_new as &$item){
	$item = 'https://courses.students.ubc.ca'.implode($item);
}
//-------------------------------------------
// Level 3 crawler
//-------------------------------------------
// array to store scraped links
$links_level_3 = array();
foreach($links_level_2_new as &$item){
	// set target url to crawl
	$url = $item; 
	// open the web page
	$html = new simple_html_dom();
	$html->load_file($url);
	// crawl the webpage for links
	foreach($html->find("a") as $link){
		array_push($links_level_3, $link->href);
	}
	// remove duplicates from the links array
	$links_level_3 = array_unique($links_level_3);
}
// set output headers to download file
header("Content-Type: text/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=links_level_3.csv");
// set file handler to output stream
$output = fopen("php://output", "w");
// output the scraped links
fputcsv($output, $links_level_3, "\n");	
*/
//-------------------------------------------
// Level 3 crawler clean up
//-------------------------------------------
//open the new csv file, store into array
//the array need implode to string
//and miss https://courses.students.ubc.ca
$links_level_3_new = array_map("str_getcsv",file("links_level_3_new.csv"));
foreach($links_level_3_new as &$item){
	$item = 'https://courses.students.ubc.ca'.implode($item);
}

//------------------------------
//Below is to put the data into mysql
//------------------------------
	$servername = "courseplanner.cs9msqhnvnqr.us-west-2.rds.amazonaws.com:3306";
	$username = "courseplanner";
	$password = "cpen3210";
	$dbname = "courseplanner";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . mysqli_connect_error());
	}
foreach($links_level_3_new as &$item){
	// Downloading home page to variable $scraped_page *$links_level_3_new[]
	$scraped_page = getHTTPS($item);
	// Scraping downloaded dara in $scraped_page for content between tags
	$scraped_data = scrape_between($scraped_page, "<body>", "</body>");
	// split the string to array string list
	$scraped_data = preg_replace("/[^A-Za-z0-9,.-]/"," ",$scraped_data);
	$data2string = preg_split("/[\s]+/", $scraped_data);
	//echo $key = array_search("Seminar",$data2string);
	//set the part of the page from 'worklist' to 'contact'
	//comparing with the real website
	$x = 0;
	array_splice($data2string, 0, array_search("Worklist",$data2string));
	array_splice($data2string, 0, array_search("h4",$data2string)+1);
	//dept
	$dept = $data2string[0];
	//courseID
	$courseID = $data2string[1];
	//sectionID
	$sectionID = $data2string[2];
	//course type
	$coursetype = '';
	for($x=3; $x<array_search("h4",$data2string); $x++){
		$coursetype .= $data2string[$x]." ";
	}
	 $coursetype;
	//course title
	array_splice($data2string, 0, array_search("h5",$data2string)+1);
	$coursetitle = '';
	for($x=0; $x<array_search("h5",$data2string); $x++){
		$coursetitle .= $data2string[$x]." ";
	}
	 $coursetitle;
	//course info
	array_splice($data2string, 0, $x+2);
	$courseinfo = '';
	for($x=0; $x<array_search("p",$data2string); $x++){
		$courseinfo .= $data2string[$x]." ";
	}
	 $courseinfo;
	//course credit
	array_splice($data2string, 0, $x);
	array_splice($data2string, 0, array_search("Credits",$data2string));
	if($data2string[1]=='n' and $data2string[2]=='a') $coursecredits = 'N/A';
	else $coursecredits = $data2string[1];
	 $coursecredits;
	//course location
	array_splice($data2string, 0, array_search("Location",$data2string));
	$courselocation = $data2string[1];
	 $courselocation;
	//course term
	array_splice($data2string, 0, array_search("Term",$data2string));
	$courseterm = '';
	for($x=0; $x<=array_search("br",$data2string); $x++){
		if($data2string[$x]=='b'){
			$x++;
			$courseterm .= '(';
		}
		if($data2string[$x]=='br'){
		$courseterm .= ')';
		break;
		}
		$courseterm .= $data2string[$x]." ";
	}
	 $courseterm;
	//course day table row 1
	array_splice($data2string, 0, array_search("Room",$data2string));
	array_splice($data2string, 0, array_search("thead",$data2string));
	array_splice($data2string, 0, array_search("td",$data2string));
	$courseday_row1_term = '';
	if($data2string[1]!='td'){ 
		$courseday_row1_term  = $data2string[1];
		array_splice($data2string, 0, 4);
	}
	else array_splice($data2string, 0, 3);
	 $courseday_row1_term;
	$courseday_row1_day = "";
	if($data2string[0]!='td'){ 
		for($x=0; $x<array_search("td",$data2string); $x++){
			if($data2string[$x]!='td') 
				$courseday_row1_day .= $data2string[$x]." ";
		}
		array_splice($data2string, 0, $x+2);
	}
	else array_splice($data2string, 0, 2);
	 $courseday_row1_day;
	$courseday_row1_start = '';
	if($data2string[0]!='td'){ 
		$courseday_row1_start = $data2string[0].':'.$data2string[1];
		array_splice($data2string, 0, 4);
	}
	else array_splice($data2string, 0, 2);
	 $courseday_row1_start;
	$courseday_row1_end = '';
	if($data2string[0]!='td'){ 
		$courseday_row1_end = $data2string[0].':'.$data2string[1];
		array_splice($data2string, 0, 4);
	}
	else array_splice($data2string, 0, 2);
	 $courseday_row1_end;

	$courseday_row1_building = '';
	if($data2string[0]!='td'){ 
		for($x=0; $x<array_search("td",$data2string); $x++){
			if($data2string[$x]!='td') 
				$courseday_row1_building .= $data2string[$x]." ";
		}
		array_splice($data2string, 0, $x+2);
	}
	else array_splice($data2string, 0, 3);
	 $courseday_row1_building;
	$courseday_row1_room = '';
	if(in_array('roomID',$data2string)){
		array_splice($data2string, 0, array_search("roomID",$data2string)+1);
		$courseday_row1_room = $data2string[0];
	}
	$courseday_row1_room;
	if($data2string[8]=='colspan' or $data2string[9]=='colspan') array_splice($data2string, 0, 20);
	array_splice($data2string, 0, array_search("td",$data2string)+1);
	//course day table row 2
	$courseday_row2_term = '';
	$courseday_row2_day = '';
	$courseday_row2_start = '';
	$courseday_row2_end = '';
	$courseday_row2_building = '';
	$courseday_row2_room = '';
	if($data2string[0]=='tr'){
		array_splice($data2string, 0, array_search("td",$data2string));
		
		if($data2string[1]!='td'){ 
			$courseday_row2_term  = $data2string[1];
			array_splice($data2string, 0, 4);
		}
		else array_splice($data2string, 0, 3);
		$courseday_row2_term;
		
		if($data2string[0]!='td'){ 
			for($x=0; $x<array_search("td",$data2string); $x++){
				if($data2string[$x]!='td') 
					$courseday_row2_day .= $data2string[$x]." ";
			}
			array_splice($data2string, 0, $x+2);
		}
		else array_splice($data2string, 0, 2);
		$courseday_row2_day;
		
		if($data2string[0]!='td'){ 
			$courseday_row2_start = $data2string[0].':'.$data2string[1];
			array_splice($data2string, 0, 4);
		}
		else array_splice($data2string, 0, 2);
		$courseday_row2_start;
		
		if($data2string[0]!='td'){ 
			$courseday_row2_end = $data2string[0].':'.$data2string[1];
			array_splice($data2string, 0, 4);
		}
		else array_splice($data2string, 0, 2);
		$courseday_row2_end;
		
		if($data2string[0]!='td'){ 
			for($x=0; $x<array_search("td",$data2string); $x++){
				if($data2string[$x]!='td') 
					$courseday_row2_building .= $data2string[$x]." ";
			}
			array_splice($data2string, 0, $x+2);
		}
		else array_splice($data2string, 0, 3);
		$courseday_row2_building;
		
		if(in_array('roomID',$data2string)){
			array_splice($data2string, 0, array_search("roomID",$data2string)+1);
			$courseday_row2_room = $data2string[0];
		}
		$courseday_row2_room;
		array_splice($data2string, 0, array_search("td",$data2string)+1);
	}
	

	
	// Instructor
	$Instructor = '';
	if(in_array("Instructor",$data2string) and array_search("Instructor",$data2string)<array_search("book",$data2string)){
		array_splice($data2string, 0, array_search("Instructor",$data2string));
		if($data2string[3]!='a') $Instructor = $data2string[3];
		else if($data2string[3]=='a'){
			array_splice($data2string, 0, array_search("a",$data2string)+1);
			while($data2string[2]!='table'){
				array_splice($data2string, 0, array_search("section",$data2string)+2);
				for($x=0; $x < array_search("a",$data2string); $x++){
					$Instructor .= $data2string[$x];
				}
				if($data2string[7]=='TA') break;
				if($data2string[$x+3]!='table') $Instructor .= '; ';
				if($data2string[$x+3]=='table' or $data2string[$x+4]=='table') break;
				array_splice($data2string, 0, array_search("a",$data2string)+1);
			}
			array_splice($data2string, 0, array_search("table",$data2string)+1);
		}
	}

	//3 books
	$book1 = '';
	$book2 = '';
	$book3 = '';
	array_splice($data2string, 0, array_search("table-striped",$data2string)+1);
	if($data2string[0]!='section-summary'){
		array_splice($data2string, 0, array_search("td",$data2string)+1);
		for($x=0; $x<array_search("td",$data2string); $x++){
			$book1 .= $data2string[$x].' ';
		}		
	}
	else{
		//book 1
		array_splice($data2string, 0, array_search("class",$data2string)+2);
		
		$book1 .= 'Book Title: ';
		for($x=0; $x<array_search("td",$data2string); $x++){
			$book1 .= $data2string[$x].' ';
		}
		array_splice($data2string, 0, array_search("class",$data2string)+2);
		$book1 .= '('.$data2string[0].')'.' Author: ';
		array_splice($data2string, 0, array_search("class",$data2string)+2);
		for($x=0; $x<array_search("td",$data2string); $x++){
			$book1 .= $data2string[$x].' ';
		}
		array_splice($data2string, 0, array_search("class",$data2string)+2);
		$book1 .= 'ISB: '.$data2string[0];
		if($data2string[3]=='table') goto endbook;
		//book 2
		array_splice($data2string, 0, array_search("class",$data2string)+2);
		$book2 .= 'Book Title: ';
		for($x=0; $x<array_search("td",$data2string); $x++){
			$book2 .= $data2string[$x].' ';
		}
		array_splice($data2string, 0, array_search("class",$data2string)+2);
		$book2 .= '('.$data2string[0].')'.' Author: ';
		array_splice($data2string, 0, array_search("class",$data2string)+2);
		for($x=0; $x<array_search("td",$data2string); $x++){
			$book2 .= $data2string[$x].' ';
		}
		array_splice($data2string, 0, array_search("class",$data2string)+2);
		$book2 .= 'ISB: '.$data2string[0];
		if($data2string[3]=='table') goto endbook;
		//book 3
		array_splice($data2string, 0, array_search("class",$data2string)+2);
		$book3 .= 'Book Title: ';
		for($x=0; $x<array_search("td",$data2string); $x++){
			$book3 .= $data2string[$x].' ';
		}
		array_splice($data2string, 0, array_search("class",$data2string)+2);
		$book3 .= '('.$data2string[0].')'.' Author: ';
		array_splice($data2string, 0, array_search("class",$data2string)+2);
		for($x=0; $x<array_search("td",$data2string); $x++){
			$book3 .= $data2string[$x].' ';
		}
		array_splice($data2string, 0, array_search("class",$data2string)+2);
		$book3 .= 'ISB: '.$data2string[0];
		if($data2string[3]=='table') goto endbook;
	}
	endbook:
		 $book1;
		 $book2;
		 $book3;
		
	if($courseday_row1_term=='Last'){
		$courseday_row1_term = '';
		$courseday_row1_day = '';
		$courseday_row1_start = '';
		$courseday_row1_end = '';
		$courseday_row1_building = '';
		$courseday_row1_room = '';
		$courseday_row2_term = '';
		$courseday_row2_day = '';
		$courseday_row2_start = '';
		$courseday_row2_end = '';
		$courseday_row2_building = '';
		$courseday_row2_room = '';
	}
	
	if(strpos($book1,'end of Main Content')){
		$book1='Information for the books required for this section is not available. ';
		$book2='';
		$book3='';
	}
	
	//echo $courseday_row1_term,$courseday_row1_day,$courseday_row1_start,$courseday_row1_end,$courseday_row1_building,$courseday_row1_room,$courseday_row2_term,$courseday_row2_day,$courseday_row2_start,$courseday_row2_end,$courseday_row2_building,$courseday_row2_room,$Instructor,$book1,$book2,$book3;
	
	
	
	
	//insert data
//		$sql = "INSERT INTO `courseplanner`.`course` (`dept`, `courseID`, `sectionID`, `course_type`, `course_title`, `course_info`, `course_credit`, `course_location`, `course_term`, `course_schedule_term_row1`, `course_schedule_day_row1`, `course_schedule_day_start_row1`, `course_schedule_day_end_row1`, `course_schedule_building_row1`, `course_schedule_room_row1`, `course_schedule_term_row2`, `course_schedule_day_row2`, `course_schedule_day_start_row2`, `course_schedule_day_end_row2`, `course_schedule_building_row2`, `course_schedule_room_row2`, `course_instructors`, `course_book1`, `course_book2`, `course_book3`, `ID`) VALUES ('$dept', '$courseID', '$sectionID', '$coursetype', '$coursetitle', '$courseinfo', '$coursecredits', '$courselocation', '$courseterm', '$courseday_row1_term', '$courseday_row1_day', '$courseday_row1_start', '$courseday_row1_end', '$courseday_row1_building', '$courseday_row1_room', '$courseday_row2_term', '$courseday_row2_day', '$courseday_row2_start', '$courseday_row2_end', '$courseday_row2_building', '$courseday_row2_room', '$Instructor', '$book1', '$book2', '$book3', NULL);";

	//update data
	$sql = "UPDATE `course` SET `dept`='$dept',`courseID`='$courseID',`sectionID`='$sectionID',`course_type`='$coursetype',`course_title`='$coursetitle',`course_info`='$courseinfo',`course_credit`='$coursecredits',`course_location`='$courselocation',`course_term`='$courseterm',`course_schedule_term_row1`='$courseday_row1_term',`course_schedule_day_row1`='$courseday_row1_day',`course_schedule_day_start_row1`='$courseday_row1_start',`course_schedule_day_end_row1`='$courseday_row1_end',`course_schedule_building_row1`='$courseday_row1_building',`course_schedule_room_row1`='$courseday_row1_room',`course_schedule_term_row2`='$courseday_row2_term',`course_schedule_day_row2`='$courseday_row2_day',`course_schedule_day_start_row2`='$courseday_row2_start',`course_schedule_day_end_row2`='$courseday_row2_end',`course_schedule_building_row2`='$courseday_row2_building',`course_schedule_room_row2`='$courseday_row2_room',`course_instructors`='$Instructor',`course_book1`='$book1',`course_book2`='$book2',`course_book3`='$book3' WHERE `dept`='$dept' and `courseID`='$courseID' and `sectionID`='$sectionID' and `course_type`='$coursetype';";
	
	if ($conn->query($sql) != TRUE) {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
		
}
echo 'done';
$conn->close();

?>
</body>
</html>