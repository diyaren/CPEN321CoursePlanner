<html>
<head>
<meta charset="utf-8">

    <title>My Schedule</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="css/mainPanel.css">
    <link rel="stylesheet" type="text/css" href="css/schedule.css">
    
  
</head>
    <body>
    <?php 
        include("inc/sidebar.html");
    ?>
        <h1 style="text-align: center;">
            Schedule your schedule
        </h1>

    
    <table id="data-table" align="center">
        <tr><td>There are no items...</td></tr>
    </table>

    <div style="text-align: center; margin: 60;">
        <button type="button" id="add-row">Add Row</button>
        <button type="button" id="remove-last-row">Remove Last Row</button>
    </div>
    
    <div id="confirm_remove"></div>
    <div id="view-edit-tile"></div>
    <div id="edit-tile"></div>
    
</div>

    <script src="js/scheduler.js"></script>
    <script src="js/sidebar.js"></script>
</body>
</html>