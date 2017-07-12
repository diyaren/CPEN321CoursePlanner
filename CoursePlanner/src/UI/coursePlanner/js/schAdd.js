// functions of adding a task or class



var invalidTime = function(start_time, end_time){
    if (start_time === end_time) return true;
    var new_start_time = parseInt(start_time.replace(":",""));
    var new_end_time = parseInt(end_time.replace(":",""));
    if(new_start_time <= new_end_time) return false;
    else return true;
}

var invalidDate = function(start_date, end_date){
    if (start_time === end_time) return true;
    var new_start_date = parseInt(start_date.replace("-",""));
    var new_end_date = parseInt(end_date.replace("-",""));
    if(new_start_time <= new_end_time) return false;
    else return true;
}



//function to add increase a day
function dateAddDays( /*yyyy/mm/dd*/ date_in){
  var nwdate =  new Date(date_in.split("-").join("/"));
  nwdate.setDate(nwdate.getDate() + 1);
  return [  nwdate.getFullYear(),
            zeroPad(nwdate.getMonth()+1, 10),
            zeroPad(nwdate.getDate(), 10)
         ].join('-');
}
//function to add zero to date/month < 10
function zeroPad(nr, base){
  var len = (String(base).length - String(nr).length) + 1;
  return len > 0? new Array(len).join('0') + nr : nr;
}

// get day from date.format()
var weekday = ["sun","mon","tue","wed","thu","fri","sat"];
function getDay(date_in){
    var nwdate =  new Date(date_in.split("-").join("/"));
    return weekday[nwdate.getDay()];
}

var addTask = function(date) {
    //write content

    $("#new-task").show();
    $( "#new-task" ).dialog({
        title: "New Task",
        modal: true,
        width: 400,
        buttons: {
            'Create Task!': function () {
                var bg = document.getElementById("bg-color-dropdown-menu");
                var t = document.getElementById("text-color-dropdown-menu");
                var d = document.getElementById("date-dropdown-menu");
                var s = document.getElementById("start-time-dropdown-menu");
                var e = document.getElementById("end-time-dropdown-menu");
                var sd = document.getElementById("start-date-user-input");
                var ed = document.getElementById("end-date-user-input");
                var rem = document.getElementById("reminder-dropdown-menu");

                if (sch_weekly_task) {
                    var target = {
                        title: $('input[name="title"]').val(),
                        date: d.options[d.selectedIndex].value,
                        startT: s.options[s.selectedIndex].value,
                        endT: e.options[e.selectedIndex].value,
                        startD: sd.value,
                        endD: ed.value,
                        location: $('input[name="location"]').val(),
                        info: $('input[name="info"]').val(),
                        bgC: bg.options[bg.selectedIndex].value,
                        textC: t.options[t.selectedIndex].value,
                        reminder: rem.options[rem.selectedIndex].value
                    };
                } else {
                    var target = {
                        title: $('input[name="title"]').val(),
                        date: getDay(date.stripTime().format()),
                        startT: s.options[s.selectedIndex].value,
                        endT: e.options[e.selectedIndex].value,
                        startD: date.format(),
                        endD: dateAddDays(date.stripTime().format()),
                        location: $('input[name="location"]').val(),
                        info: $('input[name="info"]').val(),
                        bgC: bg.options[bg.selectedIndex].value,
                        textC: t.options[t.selectedIndex].value,
                        reminder: rem.options[rem.selectedIndex].value
                    };
                }
                

                if (invalidTime(s.options[s.selectedIndex].value, e.options[e.selectedIndex].value)) {
                    alert("Start time must be earlier than end time.");
                } else {
                    console.log("Adding new task ...");
                    console.log(target);

                    $.ajax({
                        type: "POST",
                        url: 'php/uploadEntry.php',
                        data: {title: target["title"], date: target["date"], startT: target["startT"], endT: target["endT"], startD: target["startD"], endD: target["endD"], location: target["location"], info: target["info"], bg_color: target["bgC"], text_color: target["textC"], reminder: target["reminder"]},
                        success: function(data){
                           alert(data);
                           location.reload();
                        },
                        error : function() {        
                            alert("Exception from uploadEntry.php");    
                        }    
                    });
                

                    $(this).dialog('close');
                }

                
            },
            'Cancel': function () {
                $(this).dialog('close');

            }
        }
    });

}


