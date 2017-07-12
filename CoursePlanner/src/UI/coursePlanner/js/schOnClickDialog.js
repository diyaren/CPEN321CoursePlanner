// display the db entry info when click on corresponding tile
var showInfoDialog = function(id) {
	// find the entry with the id 
	// and set variable
	var dialog_index = -1;
	for (var i=0; i<dbEntries.length; i++) {
		if (dbEntries[i][db_key_id] == id) {
			dialog_index = i;
			break;
		}
	}

	if (dialog_index == -1) {
		alert("[ERROR]Unexpected Entry ID ...")
		return;
	}

	// display all info on a new dialog
	$( "#onclick-dialog" ).dialog({
        title: dbEntries[dialog_index][db_key_title],
        modal: true,
        width: 600,
        buttons: {
        	'OK': function () {
           		$(this).dialog('close');
           
            },
            'Delete' : function () {
            	confirm_delete(id);
            }
            
        }
        
    });
	// write in the info
    document.getElementById("onclick-dialog").innerHTML = 'Time: ' + dbEntries[i][db_key_start_time] + '-' + dbEntries[i][db_key_end_time] + '<br>Location: ' + dbEntries[i][db_key_location] + '<br><br>' + dbEntries[i][db_key_info];

}







