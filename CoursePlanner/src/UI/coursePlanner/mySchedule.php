<!DOCTYPE html>
<html>
    <head>
        <title>My Schedule</title>
        <meta charset='utf-8' />
        <!-- jquery for dialog-->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- fullcalendar for cal-->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.0/fullcalendar.css' />
        <link rel='stylesheet' href='css/jquery-ui.css' />

        <link rel='stylesheet' href='css/sidebar.css' />
        <link rel='stylesheet' href='css/page-footer.css' />

        <!-- time-picker-->
        <link href="css/foundation-datepicker.css" rel="stylesheet">

        <!-- Bootstrap for page header-->
          <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel = "stylesheet">

       
          
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

         <!-- time-picker-->
        <script src="libJS/foundation-datepicker.js"></script>
        
        <!-- fullcalendar for cal-->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.0/fullcalendar.min.js'></script>


        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




    </head>
    <body>
      <?php 
        include("inc/sidebar.html");
      ?>
    
          <div>
            <div id="onclick-dialog"></div>
            <div id="confirm-delete"></div>
            <div id="new-task"></div>
          </div>
          <div id='cal-container'><div id='calendar'>Loading</div></div>
      </div>

    
    <script type="text/javascript">
      // create footer
      var footer = document.createElement("div"); 
      var footer_text = document.createTextNode("CPEN321 Team Course Planner");
      footer.appendChild(footer_text);
      footer.id = "footer";
      document.body.appendChild(footer);

      // loading new task
      $("#new-task").load("inc/schUpdateCalendar.html"); 
      $("#new-task").hide();
    </script>

    
    
    
    
    
    <script type="text/javascript" src="js/sidebar.js"></script>
    <script type="text/javascript" src="js/schDBParameters.js"></script>
    <script type="text/javascript" src='js/schAPIInterface.js'></script>
    <script type="text/javascript" src="js/schLoadAndDisplay.js"></script>
    <script type="text/javascript" src="js/schOnClickDialog.js"></script>
    <script type="text/javascript" src="js/schDelete.js"></script>
    <script type="text/javascript" src="js/schAdd.js"></script>

  </body>
</html>