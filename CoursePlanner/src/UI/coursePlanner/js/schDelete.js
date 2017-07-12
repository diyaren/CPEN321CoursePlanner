// functions of deleting a task or class
var confirm_delete = function(id) {

	console.log("confir delete ...");
    document.getElementById("confirm-delete").innerHTML = "Are you sure to remove the information of this tile? <br> If this is a regular time session, you are deleting all the sessions in your calendar.";
    
    $( "#confirm-delete" ).dialog({
        title: "Confirm removement",
        modal: true,
        width: 400,
        buttons: {
            'Yes': function () {
                

                db_delete(id);
                
                $(this).dialog('close');
                $( "#onclick-dialog" ).dialog('close');

            },
            'Cancel': function () {
                $(this).dialog('close');

            }
        }
    });
}




var db_delete = function(id) {
	$.ajax({
        type: "POST",
        url: 'php/deleteEntry.php',
        data: { id : id },
        success: function(data){
            location.reload();

        },
        error : function() {        
            alert("Exception from deleteEntry.php");    
        }    
    });
}









