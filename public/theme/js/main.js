/*!
 * Bootstrap 4 multi dropdown navbar ( https://bootstrapthemes.co/demo/resource/bootstrap-4-multi-dropdown-navbar/ )
 * Copyright 2017.
 * Licensed under the GPL license
*/

$(document).ready(function(){
	$('.dropdown-menu a.dropdown-toggle').on('click', function (e){
		var $el = $(this);
		var $parent = $(this).offsetParent(".dropdown-menu");
		if (!$(this).next().hasClass('show')){
			$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
		}
		var $subMenu = $(this).next(".dropdown-menu");
		$subMenu.toggleClass('show');
		
		$(this).parent("li").toggleClass('show');

		$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e){
			$('.dropdown-menu .show').removeClass("show");
		});
		
		if (!$parent.parent().hasClass('navbar-nav')){
			$el.next().css({"top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
		}
		return false;
	});
});




// Date Range
$(function() {
	var start = moment().subtract(29, 'days');
	var end = moment();
	function cb(start, end) {
		$('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
	}
	$('#reportrange').daterangepicker({
		opens: 'left',
		startDate: start,
		endDate: end,
		ranges: {
			'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		}
	}, cb);
	cb(start, end);
});




// Todays Date
$(function() {
	var interval = setInterval(function() {
		var momentNow = moment();
		$('#today-date').html(momentNow.format('DD') + 'th ' + ''
		+ momentNow.format('- dddd').substring(0, 12));
	}, 100);
});




// Loading
$(function() {
	$("#loading-wrapper").fadeOut(3000);
});




// Bootstrap JS ***********

// Tooltip
$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})

$(function () {
	$('[data-toggle="popover"]').popover()
})
