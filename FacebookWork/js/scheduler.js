//Data field
var mon = [jQuery.parseJSON('{"title": "Math", "time": "8am-9am", "location": "building-room", "infor": "some infor"}')];
var tue = [jQuery.parseJSON('{"title": "English", "time": "8am-9am", "location": "building-room", "infor": "some infor"}')];
var wed = [jQuery.parseJSON('{"title": "", "time": "8am-9am", "location": "building-room", "infor": "some infor"}')];
var thu = [jQuery.parseJSON('{"title": "Physics", "time": "8am-9am", "location": "building-room", "infor": "some infor"}')];
var fri = [jQuery.parseJSON('{"title": "", "time": "8am-9am", "location": "building-room", "infor": "some infor"}')];
var sat = [jQuery.parseJSON('{"title": "Music!!!", "time": "8am-9am", "location": "building-room", "infor": "some infor"}')];
var sun = [jQuery.parseJSON('{"title": "Badminton", "time": "8am-9am", "location": "building-room", "infor": "some infor"}')];
var first_col = [jQuery.parseJSON('{"title": "1"}')];

var row0 = ["#", "Monday", "Tuesday", "Wednesday", "Tuesday", "Friday", "Saturday", "Sunday"];
var row1 = [ first_col[0], mon[0], tue[0], wed[0], thu[0], fri[0], sat[0], sun[0]];

var table = [row0, row1];


var inputTitle = "";
var inputTime = "";
var inputLocation = "";
var inputInfor = "";




//show infor
var dialogInfor = function(i,j) {
    if (j==0) return;
    console.log("i = " + i + " ;  j = " + j);
    //store information to the dialogbox
    $( "#view-edit-tile" ).data("dialog_title", table[i][j]);

    //write content
    document.getElementById("view-edit-tile").innerHTML = 'Time: ' + table[i][j]["time"] + '<br>' +
                                                            'Location: ' + table[i][j]["location"] + '<br>' +
                                                            table[i][j]["infor"];
    //open the dialog box
    $( "#view-edit-tile" ).dialog({
        title: $("#view-edit-tile").data('dialog_title')["title"],
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,

        buttons: {
            "Edit": function() {
                edit($("#view-edit-tile").data('dialog_title'));
                //$( this ).dialog( "close" );
            },
            "Remove": function() {
                remove($("#view-edit-tile").data('dialog_title'));
                $( this ).dialog( "close" );
            },
            Ok: function() {
                $( this ).dialog( "close" );
            }
        }
    });

    
}

//****************************************************
//
//      load data from UI to local to server(achieve later)
//
//****************************************************
var edit = function(target) {
    console.log("Editing ...");

    //write content
    document.getElementById("edit-tile").innerHTML = 'Title: <input type="text" style="z-index:10000" name="title"><br>Time: <input type="text" style="z-index:10000" name="time"><br>Location: <input type="text" style="z-index:10000" name="location"><br>Infor: <input type="text" style="z-index:10000" name="infor"><br>';
    //open the dialog box
    $( "#edit-tile" ).dialog({
        title: "Edit the Tile",
        modal: true,
        buttons: {
            'OK': function () {
                target["title"] =  $('input[name="title"]').val();
                target["time"] = $('input[name="time"]').val();
                target["location"] = $('input[name="location"]').val();
                target["infor"] = $('input[name="infor"]').val();

                loadTable("data-table", table);

                $(this).dialog('close');
                $( "#view-edit-tile" ).dialog('close');
            },
            'Cancel': function () {
                $( "#view-edit-tile" ).dialog('close');
                $(this).dialog('close');

            }
        }
    });


    
}

var remove = function(target) {
    target["title"] = "";
    target["time"] = "";
    target["location"] = "";
    target["infor"] = "";
}

var addRow = function() {
    var position_of_new_row = table.length - 1;

    mon.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    tue.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    wed.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    thu.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    fri.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    sat.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    sun.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    first_col.push(new jQuery.parseJSON('{"title": ""}'));
    first_col[position_of_new_row]["title"] = table.length;

    table.push([first_col[position_of_new_row], mon[position_of_new_row], tue[position_of_new_row], wed[position_of_new_row], thu[position_of_new_row], fri[position_of_new_row], sat[position_of_new_row], sun[position_of_new_row]]);
}

var newRow = document.getElementById("add-row");
newRow.onclick = function(){
    addRow();
    
    loadTable("data-table", table);
}


var removeLastRow = function() {

    var num_of_editable_row = table.length - 1;
    if (num_of_editable_row < 1) {
        alert("No row to be removed ...");
    } 
    else {

        table.pop();
        mon.pop();
        tue.pop();
        wed.pop();
        thu.pop();
        fri.pop();
        sat.pop();
        sun.pop();
    }

    loadTable("data-table", table);

}

var confirm_remove = function() {

    document.getElementById("confirm_remove").innerHTML = "Are you sure to remove the last row from the table?";
    
    $( "#confirm_remove" ).dialog({
        title: "Confirm removement",
        modal: true,
        buttons: {
            'Yes': function () {
                
                removeLastRow();
                
                $( "#confirm_remove" ).dialog('close');
            },
            'Cancel': function () {
                $(this).dialog('close');

            }
        }
    });
}

var removeRow = document.getElementById("remove-last-row");
removeRow.onclick = function(){
    confirm_remove();
}

//****************************************************
//
//      load data from local and from server to UI
//
//****************************************************
//function to load data
var loadTable = function(tableId, data) {
    var rows = '';

    // load the first row
    var row = '<tr>';
    for (var i=0; i<row0.length; i++) {
        row += '<td class="uneditable">' + data[0][i] + '</td>';
        
    }
    rows += row + '<tr>';

    // load the other rows
    for (var i=1; i<data.length; i++) {
        var row = '<tr>';
        for (var j=0; j<data[i].length; j++) {
            var temp = data[i][j];

            if (j==0) row += '<td class="uneditable" onclick="dialogInfor(' + i + ',' + j + ')">' + temp["title"] + '</td>';
            else row += '<td class="editable" onclick="dialogInfor(' + i + ',' + j + ')">' + temp["title"] + '</td>';
        }
        rows += row + '<tr>';
    }
    
    // load all the rows to DOM
    $('#' + tableId).html(rows);
}

//initialize the table
loadTable("data-table", table);