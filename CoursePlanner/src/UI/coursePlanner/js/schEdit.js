$("#new-task").load("inc/schUpdateCalendar.html"); 
$("#new-task").hide();

var editTask = function(db_entry) {
    //write content
    $("#new-task").show();
    $(".add-entry").hide();
    //document.getElementsByClassName("add-entry").style.display = "none";
    $( "#new-task" ).dialog({
        title: "Edit Task/Course",
        modal: true,
        width: 400,
        buttons: {
            'Edit Task!': function () {
            	var bg = document.getElementById("bg-color-dropdown-menu");
				var t = document.getElementById("text-color-dropdown-menu");
                var target = {
                	title: $('input[name="title"]').val(),
                	date: db_entry[db_key_date],
                	start: db_entry[db_key_start],
                	end: db_entry[db_key_end],
                	location: $('input[name="title"]').val(),
                	info: $('input[name="info"]').val(),
                	bgC: bg.options[bg.selectedIndex].value,
                	textC: t.options[t.selectedIndex].value
                };


                console.log("Updating new task ...");
                console.log(target);

                $.ajax({
                    type: "POST",
                    url: 'php/uploadEntry.php',
                    data: {title: target["title"], date: target["date"], start: target["start"], end: target["end"], location: target["location"], info: target["info"], bg_color: target["bgC"], text_color: target["textC"]},
                    success: function(data){
                       alert(data);
                       location.reload();
                    },
                    error : function() {        
                        alert("Exception from uploadEntry.php");    
                    }    
                });
            

                $(this).dialog('close');
                

                
            },
            'Cancel': function () {
                $(this).dialog('close');

            }
        }
    });

}