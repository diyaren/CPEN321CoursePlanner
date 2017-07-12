<html>
<head>
<meta charset="utf-8>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>First Login Page</title>
   <link rel="stylesheet"
	 href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" type="text/css" href="css/sidebar.css">
   <script type="text/javascript" src="jquery-1.3.1.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   


<script>
     $(document).ready(function(){
        //<tr/>middle
        $("#tab tr").attr("align","center");
        
        //增加<tr/>
        $("#but").click(function(){
            var _len = $("#tab tr").length;        
            $("#tab").append("<tr id="+_len+" align='center'>"
                                +"<td>"+_len+"</td>"
                                +"<td>Course"+_len+"</td>"
                                +"<td><input type='text' name='desc"+_len+"' id='desc"+_len+"' /></td>"
                                +"<td><a href=\'#\' onclick=\'deltr("+_len+")\'>DELETE</a></td>"
                            +"</tr>");            
        })    
    })
    
    //删除<tr/>
    var deltr =function(index)
    {
        var _len = $("#tab tr").length;
        $("tr[id='"+index+"']").remove();//删除当前行
        for(var i=index+1,j=_len;i<j;i++)
        {
            var nextTxtVal = $("#desc"+i).val();
            $("tr[id=\'"+i+"\']")
                .replaceWith("<tr id="+(i-1)+" align='center'>"
                                +"<td>"+(i-1)+"</td>"
                                +"<td>Course "+(i-1)+"</td>"
                                +"<td><input type='text' name='desc"+(i-1)+"' value='"+nextTxtVal+"' id='desc"+(i-1)+"'/></td>"
                                +"<td><a href=\'#\' onclick=\'deltr("+(i-1)+")\'>DELETE</a></td>"
                            +"</tr>");
        }    
        
    }
</script>
</head>
    <body>
    <?php
    include("inc/sideBar.html");
    include("inc/backToMainPanel.html");
    
    ?>
    <div style="text-align: center; margin: 100;">
    <h1 style="text-align:center;">WE WOULD LIKE TO KNOW MORE ABOUT
      YOU</h1>
   
    <style>
    body{background-color:pink}
    </style>
    <p>1.what's your name     <input type="text" name=""></p>
    <input id="man" type="radio" checked="checked" name="1"/>Male
    <input id="woman" type="radio"  name="1"/>Female 
    <p>2.what year are you in?</p>
    <input id="Year1" type="radio" checked="checked" name ="2"/>Year1
    <input id="Year2" type="radio"  name ="2"/>Year2
    <input id="Year3" type="radio"  name ="2"/>Year3
    <input id="Year4" type="radio"  name ="2"/>Year4
    <input id="Year5+" type="radio" name ="2"/>Year5+
    <p>3.what's your faculty</p>
<select id = "falculty-select">
  <option value ="Applied Science">Applied Science</option>
  <option value ="Architecture and Landscape Architecture, School of">Architecture and Landscape Architecture</option>
  
  <option value="Arts">Arts</option>
  <option value="Audiology and Speech Science">Audiology and Speech Sciences</option>
  <option value ="Business">Business</option>
  <option value ="Community and Regional Planning">Community and Regional Planning</option>
  <option value="Continuing Studies">Continuing Studies</option>
  <option value="Dentistry">Dentistry</option>
   <option value ="Education">Education</option>
  <option value ="Forestry">Forestry</option>
  
  <option value="Graduate and Postdoctoral Studies">Graduate and Postdoctoral Studies</option>
  <option value="Journalism">Journalism</option>
  <option value ="Kinesiology">Kinesiology</option>
  <option value ="Land and Food Systems">Land and Food Systems</option>
  <option value="Law, Peter A.">Law, Peter A.</option>
  <option value="Library, Archival and Information Studies">Library,
  Archival and Information Studies</option>
   <option value ="Medicine">Medicine</option>
  <option value ="Music">Music</option>
  
  <option value="Nursing">Nursing</option>
  <option value="Pharmaceutical Sciences">Pharmaceutical Sciences</option>
  <option value ="Population and Public Health">Population and Public Health</option>
  <option value ="Science">Science</option>
  <option value="Social Work">Social Work</option>
  <option value="UBC Vantage College">UBC Vantage College</option>
   <option value ="Vancouver School of Economics">Vancouver School of Economics</option>
  
</select>


   <p>4.what courses are you taking?</p>

 <table id="tab" border="1" width="60%" align="center" style="margin-top:20px">
        <tr>
            <td width="20%">Number</td>
            <td>List</td>
            <td>Course Name</td>
            <td>Delete Course</td>
       </tr>
    </table>
  
    <div style="border:2px; 
                border-color:red; 
                margin-left:20%;
                margin-top:30px;
		text-align
              ">
        <input type="button" id="but" value="Add Course">
    </div>
 

    <script src="js/courseSelectBar.js"></script>
    <script src="js/sideBar.js"></script>
 
<div style="text-align: center; margin: 100;">   
    <input type="submit" name="b1" value="submit" onClick="javascript:location.href='mainPanelWithoutRefer.php'">
   
</div>
</body>
</html>
