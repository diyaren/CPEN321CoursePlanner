
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250"> 
<title>...</title>
<style>
.reminderTable th{
margin: auto;
text-align:center;

color:#2CB5D7 ;
}

.reminderTable td{
text-align:center;

color: #2CB5D7;
}
</style>
</head>
<body>
</html>

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
    //Get current session
  require('session.php');
   $session = Session::getInstance();
    $uid = $session->userID;
//$uid = 1100;

$sql = "SELECT `reminder`,`Start_Date`,`End_Date`,`Title`,`Info`,`Location`,`Date`, `Start`,`End` FROM `Unique Calendar Entry` WHERE `userID`= $uid AND `courseID` IS NULL";
$result = $conn->query($sql);
date_default_timezone_set('America/Vancouver');
$date_array = getdate();

//foreach ( $date_array as $key => $val ){
  //   print "$key = $val<br />";
   //}
    $formated_date = '';
    $formated_date .= $date_array['year'] ."/";
    if( strlen($date_array['mon'])<2){
    $formated_date .= "0".$date_array['mon'] ."/";
  } else {
     $formated_date .= $date_array['mon'] ."/";
  }
   if( strlen($date_array['mday'])<2){
    $formated_date .= "0".$date_array['mday'];
  }else{
    $formated_date .= $date_array['mday'];
  }

    //  echo $formated_date;



//for set up abbreviation weekday
switch ($date_array['weekday']){
case "Monday":
      $abbrDate = 'mon';
      $abbrNum  = 1;
      break;
case "Tuesday":
      $abbrDate = 'tue';
      $abbrNum  = 2;
      break;
case "Wednesday":
      $abbrDate = 'wed';
      $abbrNum  = 3;
      break;      
case "Thursday":
      $abbrDate = 'thu';
      $abbrNum  = 4;
      break;
case "Friday":
      $abbrDate = 'fri';
      $abbrNum  = 5;
      break;
case "Saturday":
      $abbrDate = 'sat';
      $abbrNum  = 6;
      break;
case "Sunday":
      $abbrDate = 'sun';
      $abbrNum  = 7;
      break;
    
}

//creat an array
if($result->num_rows>0){
echo "<table class=\"reminderTable\" border=\"3\" valign=\"center\" bordercolor=\"2CB5D7\" WIDTH=\"515px\">
      <tr>
      <th >TITLE</th>
     
      <th >INFO</th>
      
      <th >LOCATION</th>
     
      <th >DATE</th>
      
      <th >START</th>
      
      <th >END</th>
      </tr>";
while($row = $result->fetch_assoc()){

if($row["reminder"]==0){
if($row["End_Date"]==NULL){
  if($row["Start_Date"]==$formated_date||$row["Start_Date"]==date("Y-m-d")){
    if(($row["Info"]==NULL)&&($row["Location"]!=NULL)){
    echo"<tr>
         <td >".$row["Title"]."</td>
        
         <td>"."None"."</td>
        
         <td>".$row["Location"]."</td>
         <td>".ucfirst($row["Date"])."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
       
      
         </tr>";
       } else if(($row["Info"]!=NULL)&&($row["Location"]==NULL)){
    echo"<tr>
         <td >".$row["Title"]."</td>
        
         <td>".$row["Info"]."</td>
        
         <td>"."None"."</td>
         <td>".ucfirst($row["Date"])."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
       
      
         </tr>";
       }else if(($row["Info"]==NULL)&&($row["Location"]==NULL)){
     echo"<tr>
         <td >".$row["Title"]."</td>
        
         <td>"."None"."</td>
        
         <td>"."None"."</td>
         <td>".ucfirst($row["Date"])."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
       
      
         </tr>";
       }  else {  
        echo"<tr>
         <td>".$row["Title"]."</td>

         <td>".$row["Info"]."</td>

         <td>".$row["Location"]."</td>

         <td>".ucfirst($row["Date"])."</td>

         <td>".$row["Start"]."</td>

         <td>".$row["End"]."</td>
         </tr>";

       }
  }
} else if($row["End_Date"]!=NULL){
  if((($row["Start_Date"]<=$formated_date)&&($formated_date<=$row["End_Date"]))||(($row["Start_Date"]<=date("Y-m-d"))&&(date("Y-m-d")<=$row["End_Date"]))){
    if($row["Date"]==$abbrDate){
 if(($row["Info"]==NULL)&&($row["Location"]!=NULL)){
    echo"<tr>
         <td >".$row["Title"]."</td>
        
         <td>"."None"."</td>
        
         <td>".$row["Location"]."</td>
         <td>".ucfirst($row["Date"])."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
       
      
         </tr>";
       } else if(($row["Info"]!=NULL)&&($row["Location"]==NULL)){
    echo"<tr>
         <td >".$row["Title"]."</td>
        
         <td>".$row["Info"]."</td>
        
         <td>"."None"."</td>
         <td>".ucfirst($row["Date"])."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
       
      
         </tr>";
       }else if(($row["Info"]==NULL)&&($row["Location"]==NULL)){
     echo"<tr>
         <td >".$row["Title"]."</td>
        
         <td>"."None"."</td>
        
         <td>"."None"."</td>
         <td>".ucfirst($row["Date"])."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
       
      
         </tr>";
       }  else {  
        echo"<tr>
         <td>".$row["Title"]."</td>

         <td>".$row["Info"]."</td>

         <td>".$row["Location"]."</td>

         <td>".ucfirst($row["Date"])."</td>

         <td>".$row["Start"]."</td>

         <td>".$row["End"]."</td>
         </tr>";

       
    }
      
 }

     }
   }
  

} else if($row["reminder"]!=0){
   
if($row["End_Date"]==NULL){

  if((date("Y/m/d",time(time($row["Start_Date"])-$row['reminder']*86400))==$formated_date)||(date("Y-m-d",time(time($row["Start_Date"])-$row['reminder']*86400))==date("Y-m-d"))){
    if(($row["Info"]==NULL)&&($row["Location"]!=NULL)){
    echo"<tr>
         <td >".$row["Title"]."</td>
        
         <td>"."None"."</td>
        
         <td>".$row["Location"]."</td>
         <td>".ucfirst($row["Date"])."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
       
      
         </tr>";
       } else if(($row["Info"]!=NULL)&&($row["Location"]==NULL)){
    echo"<tr>
         <td >".$row["Title"]."</td>
        
         <td>".$row["Info"]."</td>
        
         <td>"."None"."</td>
         <td>".ucfirst($row["Date"])."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
       
      
         </tr>";
       }else if(($row["Info"]==NULL)&&($row["Location"]==NULL)){
     echo"<tr>
         <td >".$row["Title"]."</td>
        
         <td>"."None"."</td>
        
         <td>"."None"."</td>
         <td>".ucfirst($row["Date"])."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
       
      
         </tr>";
       }  else {  
        echo"<tr>
         <td>".$row["Title"]."</td>

         <td>".$row["Info"]."</td>

         <td>".$row["Location"]."</td>

         <td>".ucfirst($row["Date"])."</td>

         <td>".$row["Start"]."</td>

         <td>".$row["End"]."</td>
         </tr>";

       }
  }

} else if($row["End_Date"]!=NULL){

  if((($row["Start_Date"]-$row["reminder"]<=$formated_date)&&($formated_date<=$row["End_Date"]))||(($row["Start_Date"]-$row["reminder"]<=date("Y-m-d"))&&(date("Y-m-d")<=$row["End_Date"]))){
 
    switch ($row["Date"]){
      case "mon":
      if($row["reminder"]==1){
         $remindemME = "sun";
      }else if($row["reminder"]==2){
         $remindemME = "sat";
      }else if($row["reminder"]==3){
         $remindemME = "fri";
      }else if($row["reminder"]==4){
         $remindemME = "thu";
      }else if($row["reminder"]==5){
         $remindemME = "wed";
      }

      break; 
      
      case "tue":
       if($row["reminder"]==1){
         $remindemME = "mon";
      }else if($row["reminder"]==2){
         $remindemME = "sun";
      }else if($row["reminder"]==3){
         $remindemME = "sat";
      }else if($row["reminder"]==4){
         $remindemME = "fri";
      }else if($row["reminder"]==5){
         $remindemME = "thu";
      }
      break;
      
      case "wed":
      if($row["reminder"]==1){
         $remindemME = "tue";
      }else if($row["reminder"]==2){
         $remindemME = "mon";
      }else if($row["reminder"]==3){
         $remindemME = "sun";
      }else if($row["reminder"]==4){
         $remindemME = "sat";
      }else if($row["reminder"]==5){
         $remindemME = "fri";
      }
      break; 
      
      case "thu":
      if($row["reminder"]==1){
         $remindemME = "wed";
      }else if($row["reminder"]==2){
         $remindemME = "tue";
      }else if($row["reminder"]==3){
         $remindemME = "mon";
      }else if($row["reminder"]==4){
         $remindemME = "sun";
      }else if($row["reminder"]==5){
         $remindemME = "sat";
      }
      break;
      case "fri":
      if($row["reminder"]==1){
         $remindemME = "thu";
      }else if($row["reminder"]==2){
         $remindemME = "wed";
      }else if($row["reminder"]==3){
         $remindemME = "tue";
      }else if($row["reminder"]==4){
         $remindemME = "mon";
      }else if($row["reminder"]==5){
         $remindemME = "sun";
      }
      break; 
     
      case "sat":
      if($row["reminder"]==1){
         $remindemME = "fri";
      }else if($row["reminder"]==2){
         $remindemME = "thu";
      }else if($row["reminder"]==3){
         $remindemME = "wed";
      }else if($row["reminder"]==4){
         $remindemME = "tue";
      }else if($row["reminder"]==5){
         $remindemME = "mon";
      }
      break;
      
      case "sun":
      if($row["reminder"]==1){
         $remindemME = "sat";
      }else if($row["reminder"]==2){
         $remindemME = "fri";
      }else if($row["reminder"]==3){
         $remindemME = "thu";
      }else if($row["reminder"]==4){
         $remindemME = "wed";
      }else if($row["reminder"]==5){
         $remindemME = "tue";
      }
      break; 
      
    }
    if($remindemME==$abbrDate){
       if(($row["Info"]==NULL)&&($row["Location"]!=NULL)){
    echo"<tr>
         <td >".$row["Title"]."</td>
        
         <td>"."None"."</td>
        
         <td>".$row["Location"]."</td>
         <td>".ucfirst($row["Date"])."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
       
      
         </tr>";
       } else if(($row["Info"]!=NULL)&&($row["Location"]==NULL)){
    echo"<tr>
         <td >".$row["Title"]."</td>
        
         <td>".$row["Info"]."</td>
        
         <td>"."None"."</td>
         <td>".ucfirst($row["Date"])."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
       
      
         </tr>";
       }else if(($row["Info"]==NULL)&&($row["Location"]==NULL)){
     echo"<tr>
         <td >".$row["Title"]."</td>
        
         <td>"."None"."</td>
        
         <td>"."None"."</td>
         <td>".ucfirst($row["Date"])."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
       
      
         </tr>";
       }  else {  
        echo"<tr>
         <td>".$row["Title"]."</td>

         <td>".$row["Info"]."</td>

         <td>".$row["Location"]."</td>

         <td>".ucfirst($row["Date"])."</td>

         <td>".$row["Start"]."</td>

         <td>".$row["End"]."</td>
         </tr>";

       
    }

      
 }

     }
  }


}
}


echo "</table>";
}
else{
    echo "YEAH!! No tasks today!!!";
}



$conn->close();

?>
