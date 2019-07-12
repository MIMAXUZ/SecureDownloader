// Denmark
$(function(){
	$('#mapDenmark').vectorMap({
		map: 'dk_mill',
		zoomOnScroll: false,
		regionStyle:{
			initial: {
				fill: '#2c9e9e',
			},
			hover: {
				"fill-opacity": 0.8
			},
			selected: {
				fill: '#A9BD7A'
			},
		},
		backgroundColor: 'transparent',
	});
});