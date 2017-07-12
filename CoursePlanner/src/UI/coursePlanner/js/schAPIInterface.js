// array thats going to be displayed on calendar
var display_events  = [
  /*{
    
      id     : '2',
      title  : 'Dentist',
      start: "10:00",
      end: "23:00",
      backgroundColor: 'green',
      textColor: 'black',
      dow: [1,4],
      ranges: [
      { start: moment('2016/11/07','YYYY/MM/DD'), // include start
        end: moment('2016/11/12','YYYY/MM/DD') }  // exclude end
      ]
      
  }
  */
];

// interface function to pass the array enevts
function getEvents(){
    console.log("----->> get Events: ");
  console.log(display_events);
  return display_events;
}




var rerender = function() {
    $(document).ready(function() {

      $('#calendar').remove();
    
      $( '#cal-container' ).append( '<div id="calendar"></div>');
        // page is ready
        $('#calendar').fullCalendar({
            // calendar properties
            minTime: "04:00:00",
            maxTime: "24:00:00",
            // enable theme
            theme: true,
            // emphasizes business hours
            businessHours: true,
            // event dragging & resizing
            editable: true,
            // header
            header: {
              left: 'prev,next today',
              center: 'title',
              right: 'month,agendaWeek,agendaDay'
            },
            eventRender: function(event, element, view){
              console.log(event.start.format());
              return (event.ranges.filter(function(range){
                return (event.start.isBefore(range.end) &&
                  event.end.isAfter(range.start));
              }).length)>0;
            },
            events: getEvents(),
            eventClick: function(event) {
              showInfoDialog(event.id);
            },
            dayClick: function(date, jsEvent, view) {
              addTask(date);

              //alert('Clicked on: ' + date.format());

            }
        });
    });
}