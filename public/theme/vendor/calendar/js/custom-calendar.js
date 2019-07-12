 $(function() {
 	"use strict";
 	$('#calendar1').fullCalendar({
 		header: {
 			left: 'prev,next today',
 			center: 'title',
 			right: 'month,agendaWeek,agendaDay'
 		},
 		
 		navLinks: true, // can click day/week names to navigate views
 		selectable: true,
 		selectHelper: true,
 		select: function(start, end) {
 			var title = prompt('Event Title:');
 			var eventData;
 			if (title) {
 				eventData = {
 					title: title,
 					start: start,
 					end: end
 				};
 				$('#calendar1').fullCalendar('renderEvent', eventData, true); // stick? = true
 			}
 			$('#calendar1').fullCalendar('unselect');
 		},
 		editable: true,
 		eventLimit: true, // allow "more" link when too many events
 		events: [{
 			title: 'All Day Event',
 			start: '2019-02-01',
 			color: '#67caf0'
 		}, {
 			title: 'Long Event',
 			start: '2019-02-07',
 			end: '2019-02-10',
 			color: '#80bcdc'
 		}, {
 			id: 999,
 			title: 'Repeating Event',
 			start: '2019-02-09T16:00:00',
 			color: '#fd7274'
 		}, {
 			id: 999,
 			title: 'Repeating Event',
 			start: '2019-02-16T16:00:00',
 			color: '#a5ca7b'
 		}, {
 			title: 'Conference',
 			start: '2019-02-11',
 			end: '2019-02-13',
 			color: '#f68d60'
 		}, {
 			title: 'Meeting',
 			start: '2019-02-12T10:30:00',
 			end: '2019-02-12T12:30:00',
 			color: '#f9be52'
 		}, {
 			title: 'Lunch',
 			start: '2019-02-12T12:00:00',
 			color: '#ff8087'
 		}, {
 			title: 'Meeting',
 			start: '2019-02-12T14:30:00',
 			color: '#ac92ec'
 		}, {
 			title: 'Happy Hour',
 			start: '2019-02-12T17:30:00',
 			color: '#41ca94'
 		}, {
 			title: 'Dinner',
 			start: '2019-02-12T20:00:00',
 			color: '#ffb445'
 		}, {
 			title: 'Birthday Party',
 			start: '2019-02-13T07:00:00',
 			color: '#89bf52'
 		}, {
 			title: 'Click for Google',
 			url: 'http://google.com/',
 			start: '2019-02-28',
 			color: '#00b894'
 		}]
 	});




 	$('#calendar').fullCalendar({
 		header: {
 			left: 'prev,next today',
 			center: 'title',
 			right: 'listDay,listWeek,month'
 		},
 		// customize the button names,
 		// otherwise they'd all just say "list"
 		views: {
 			listDay: {
 				buttonText: 'day'
 			},
 			listWeek: {
 				buttonText: 'week'
 			}
 		},
 		defaultView: 'listMonth',
 		
 		navLinks: true, // can click day/week names to navigate views
 		editable: true,
 		eventLimit: true, // allow "more" link when too many events
 		events: [{
 			title: 'All Day Event',
 			start: '2019-02-01'
 		}, {
 			title: 'Long Event',
 			start: '2019-02-07',
 			end: '2018-03-10'
 		}, {
 			id: 999,
 			title: 'Repeating Event',
 			start: '2019-02-09T16:00:00'
 		}, {
 			id: 999,
 			title: 'Repeating Event',
 			start: '2019-02-16T16:00:00'
 		}, {
 			title: 'Conference',
 			start: '2019-02-11',
 			end: '2019-02-13'
 		}, {
 			title: 'Meeting',
 			start: '2019-02-12T10:30:00',
 			end: '2019-02-12T12:30:00'
 		}, {
 			title: 'Lunch',
 			start: '2019-02-12T12:00:00'
 		}, {
 			title: 'Meeting',
 			start: '2019-02-12T14:30:00'
 		}, {
 			title: 'Happy Hour',
 			start: '2019-02-12T17:30:00'
 		}, {
 			title: 'Dinner',
 			start: '2019-02-12T20:00:00'
 		}, {
 			title: 'Birthday Party',
 			start: '2019-02-13T07:00:00'
 		}, {
 			title: 'Click for Google',
 			url: 'http://google.com/',
 			start: '2019-02-28'
 		}]
 	});
 	
});