function DrawGoogleCal(calid){
    /* initialize the external events
     -----------------------------------------------------------------*/
    $('#external-events div.external-event').each(function() {
        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
        };
        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);
        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
        });
    });
    /* initialize the calendar
     -----------------------------------------------------------------*/
    var calendar = $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        selectable: true,
        selectHelper: true,
        googleCalendarApiKey: 'AIzaSyC-6h_lg_B3D1TxlBsv74t6NlFgtUd_kmA',
        events: {
            googleCalendarId: calid
        },
        select: function(start, end, allDay) {
            var form = $('<form id="event_form">'+
            '<div class="form-group has-success has-feedback">'+
            '<label">Event name</label>'+
            '<div>'+
            '<input type="text" id="newevent_name" class="form-control" placeholder="Name of event">'+
            '</div>'+
            '<label>Description</label>'+
            '<div>'+
            '<textarea rows="3" id="newevent_desc" class="form-control" placeholder="Description"></textarea>'+
            '</div>'+
            '</div>'+
            '</form>');
            var buttons = $('<button id="event_cancel" type="cancel" class="btn btn-default btn-label-left">'+
            '<span><i class="fa fa-clock-o txt-danger"></i></span>'+
            'Cancel'+
            '</button>'+
            '<button type="submit" id="event_submit" class="btn btn-primary btn-label-left pull-right">'+
            '<span><i class="fa fa-clock-o"></i></span>'+
            'Add'+
            '</button>');
            OpenModalBox('Add event', form, buttons);
            $('#event_cancel').on('click', function(){
                CloseModalBox();
            });
            $('#event_submit').on('click', function(){
                var new_event_name = $('#newevent_name').val();
                if (new_event_name !== ''){
                    calendar.fullCalendar('renderEvent',
                        {
                            title: new_event_name,
                            description: $('#newevent_desc').val(),
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true // make the event "stick"
                    );
                }
                CloseModalBox();
            });
            calendar.fullCalendar('unselect');
        },
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function(date, allDay) { // this function is called when something is dropped
            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);
            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }
        },
        eventRender: function (event, element, icon) {
            if (event.description !== "") {
                element.attr('title', event.description);
            }
        },
        eventClick: function(calEvent, jsEvent, view) {
            var form = $('<form id="event_form">'+
            '<div class="form-group has-success has-feedback">'+
            '<label">Event name</label>'+
            '<div>'+
            '<input type="text" id="newevent_name" value="'+ calEvent.title +'" class="form-control" placeholder="Name of event">'+
            '</div>'+
            '<label>Description</label>'+
            '<div>'+
            '<textarea rows="3" id="newevent_desc" class="form-control" placeholder="Description">'+ calEvent.description +'</textarea>'+
            '</div>'+
            '</div>'+
            '</form>');
            var buttons = $('<button id="event_cancel" type="cancel" class="btn btn-default btn-label-left">'+
            '<span><i class="fa fa-clock-o txt-danger"></i></span>'+
            'Cancel'+
            '</button>'+
            '<button id="event_delete" type="cancel" class="btn btn-danger btn-label-left">'+
            '<span><i class="fa fa-clock-o txt-danger"></i></span>'+
            'Delete'+
            '</button>'+
            '<button type="submit" id="event_change" class="btn btn-primary btn-label-left pull-right">'+
            '<span><i class="fa fa-clock-o"></i></span>'+
            'Save changes'+
            '</button>');
            OpenModalBox('Change event', form, buttons);
            $('#event_cancel').on('click', function(){
                CloseModalBox();
            });
            $('#event_delete').on('click', function(){
                calendar.fullCalendar('removeEvents' , function(ev){
                    return (ev._id == calEvent._id);
                });
                CloseModalBox();
            });
            $('#event_change').on('click', function(){
                calEvent.title = $('#newevent_name').val();
                calEvent.description = $('#newevent_desc').val();
                calendar.fullCalendar('updateEvent', calEvent);
                CloseModalBox();
            });
        }
    });
    $('#new-event-add').on('click', function(event){
        event.preventDefault();
        var event_name = $('#new-event-title').val();
        var event_description = $('#new-event-desc').val();
        if (event_name != ''){
            var event_template = $('<div class="external-event" data-description="'+event_description+'">'+event_name+'</div>');
            $('#events-templates-header').after(event_template);
            var eventObject = {
                title: event_name,
                description: event_description
            };
            // store the Event Object in the DOM element so we can get to it later
            event_template.data('eventObject', eventObject);
            event_template.draggable({
                zIndex: 999,
                revert: true,
                revertDuration: 0
            });
        }
    });
}
function HalfFullCal(calid) {
    if (!jQuery().fullCalendar) {
        return;
    }
    /* initialize the external events
     -----------------------------------------------------------------*/
    $('#external-events div.external-event').each(function() {
        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
        };
        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);
        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
        });
    });
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    var h = {};

    if ($('#calendar').width() <= 400) {
        $('#calendar').addClass("mobile");
        h = {
            left: 'title, prev, next',
            center: '',
            right: 'today,month,agendaWeek,agendaDay'
        };
    } else {
        $('#calendar').removeClass("mobile");
        if (Metronic.isRTL()) {
            h = {
                right: 'title',
                center: '',
                left: 'prev,next,today,month,agendaWeek,agendaDay'
            };
        } else {
            h = {
                left: 'title',
                center: '',
                right: 'prev,next,today,month,agendaWeek,agendaDay'
            };
        }
    }

    $('#calendar').fullCalendar('destroy'); // destroy the calendar
    $('#calendar').fullCalendar({ //re-initialize the calendar
        disableDragging: false,
        header: h,
        selectable: true,
        selectHelper: true,
        googleCalendarApiKey: 'AIzaSyC-6h_lg_B3D1TxlBsv74t6NlFgtUd_kmA',
        events: {
            googleCalendarId: calid
        },
        editable: true,
        droppable: false,
        drop: function(date, allDay) { // this function is called when something is dropped
            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);
            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }
        },
        eventRender: function (event, element, icon) {
            if (event.description != "") {
                element.attr('title', event.description);
            }
        },
    });
}
//
//  Helper for open ModalBox with requested header, content and bottom
// TODO: meld this with the metronic modal style
//
//
function OpenModalBox(header, inner, bottom){
    var modalbox = $('#modalbox');
    modalbox.find('.modal-header-name span').html(header);
    modalbox.find('.devoops-modal-inner').html(inner);
    modalbox.find('.devoops-modal-bottom').html(bottom);
    modalbox.fadeIn('fast');
    $('body').addClass("body-expanded");
}
//
//  Close modalbox
//
//
function CloseModalBox(){
    var modalbox = $('#modalbox');
    modalbox.fadeOut('fast', function(){
        modalbox.find('.modal-header-name span').children().remove();
        modalbox.find('.devoops-modal-inner').children().remove();
        modalbox.find('.devoops-modal-bottom').children().remove();
        $('body').removeClass("body-expanded");
    });
}
