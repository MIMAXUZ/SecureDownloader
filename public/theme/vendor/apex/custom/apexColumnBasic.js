// Apex Column Basic Example 1

var options = {
	chart: {
		height: 180,
		type: 'bar',
		toolbar: {
			show: false,
			autoSelected: 'zoom' 
		},
	},
	plotOptions: {
		bar: {
			horizontal: false,
			endingShape: 'arrow',
			columnWidth: '25%',
		},
	},
	dataLabels: {
		enabled: false
	},
	grid: {
		show: false,
	},
	stroke: {
		show: true,
		width: 0,
		colors: ['transparent']
	},
	theme: {
		monochrome: {
			enabled: true,
			color: '#f38559',
			shadeIntensity: 0.1
		},
	},
	fill: {
		type: 'gradient',
		gradient: {
		shade: 'light',
		type: "horizontal",
		shadeIntensity: 0.5,
		gradientToColors: undefined,
		inverseColors: true,
		opacityFrom: 1,
		opacityTo: 1,
		stops: [0, 50, 100]
		}
	},
	series: [{
		name: 'Emails Sent',
		data: [20, 30, 50, 60, 40, 25, 15]
	}],
	xaxis: {
		categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
	},
	tooltip: {
		y: {
			formatter: function (val) {
				return val
			}
		}
	}
}

var chart = new ApexCharts(
	document.querySelector("#apexColumnBasic"),
	options
);

chart.render();































// Apex Column Basic Example 2

var options2 = {
	chart: {
		height: 180,
		type: 'bar',
		toolbar: {
			show: false,
			autoSelected: 'zoom' 
		},
	},
	plotOptions: {
		bar: {
			horizontal: false,
			endingShape: 'arrow',
			columnWidth: '25%',
		},
	},
	dataLabels: {
		enabled: false
	},
	grid: {
		show: false,
	},
	stroke: {
		show: true,
		width: 0,
		colors: ['transparent']
	},
	theme: {
		monochrome: {
			enabled: true,
			color: '#f9be52',
			shadeIntensity: 0.1
		},
	},
	fill: {
		type: 'gradient',
		gradient: {
		shade: 'light',
		type: "horizontal",
		shadeIntensity: 0.5,
		gradientToColors: undefined,
		inverseColors: true,
		opacityFrom: 1,
		opacityTo: 1,
		stops: [0, 50, 100]
		}
	},
	series: [{
		name: 'SMS Sent',
		data: [20, 30, 50, 60, 40, 25, 15]
	}],
	xaxis: {
		categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
	},
	tooltip: {
		y: {
			formatter: function (val) {
				return val
			}
		}
	}
}

var chart = new ApexCharts(
	document.querySelector("#apexColumnBasic2"),
	options2
);

chart.render();





























// Apex Column Basic Example 3

var options3 = {
	chart: {
		height: 180,
		type: 'bar',
		toolbar: {
			show: false,
			autoSelected: 'zoom' 
		},
	},
	plotOptions: {
		bar: {
			horizontal: false,
			endingShape: 'arrow',
			columnWidth: '25%',
		},
	},
	dataLabels: {
		enabled: false
	},
	grid: {
		show: false,
	},
	stroke: {
		show: true,
		width: 0,
		colors: ['transparent']
	},
	theme: {
		monochrome: {
			enabled: true,
			color: '#67caf0',
			shadeIntensity: 0.1,
		},
	},
	fill: {
		type: 'gradient',
		gradient: {
		shade: 'light',
		type: "horizontal",
		shadeIntensity: 0.5,
		gradientToColors: undefined,
		inverseColors: true,
		opacityFrom: 1,
		opacityTo: 1,
		stops: [0, 50, 100]
		}
	},
	series: [{
		name: 'Deals',
		data: [20, 30, 50, 60, 40, 25, 15]
	}],
	xaxis: {
		categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
	},
	tooltip: {
		y: {
			formatter: function (val) {
				return val
			}
		}
	}
}

var chart = new ApexCharts(
	document.querySelector("#apexColumnBasic3"),
	options3
);

chart.render();