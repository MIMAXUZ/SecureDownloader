var options = {
	chart: {
		height: 120,
		type: 'line',
		toolbar: {
			show: false,
		},
	},
	dataLabels: {
		enabled: false,
	},
	stroke: {
		curve: 'smooth'
	},
	grid: {
		show: false,
	},
	series: [{
		name: 'Customers',
		data: [5, 40, 50, 90, 100, 85, 95]
	}],
	xaxis: {
		labels: {
			show: false,
		},
		axisBorder: {
			show: false,
		},
		categories: [
			"Sunday",
			"Monday",
			"Tuesday",
			"Wednesday",
			"Thursday",
			"Friday",
			"Saturday",
		]
	},
	theme: {
		monochrome: {
			enabled: true,
			color: '#1da8df',
			shadeIntensity: 0.1
		},
	},
	fill: {
		type: 'gradient',
		gradient: {
			shade: 'light',
			gradientToColors: [ '#67caf0'],
			shadeIntensity: 1,
			type: 'horizontal',
			opacityFrom: 1,
			opacityTo: 1,
			stops: [0, 100, 100, 100, 100]
		},
	},
	markers: {
		size: 0,
		colors: ["#67caf0"],
		strokeColor: "#fff",
		strokeWidth: 2,
		hover: {
			size: 7,
		}
	},
}

var chart = new ApexCharts(
	document.querySelector("#apexLineChartGradient"),
	options
);

chart.render();






















var options2 = {
	chart: {
		height: 120,
		type: 'line',
		toolbar: {
			show: false,
		},
	},
	dataLabels: {
		enabled: false,
	},
	stroke: {
		curve: 'smooth'
	},
	grid: {
		show: false,
	},
	series: [{
		name: 'Revenue',
		data: [25, 40, 50, 60, 80, 75, 95]
	}],
	xaxis: {
		labels: {
			show: false,
		},
		axisBorder: {
			show: false,
		},
		categories: [
			"Sunday",
			"Monday",
			"Tuesday",
			"Wednesday",
			"Thursday",
			"Friday",
			"Saturday",
		]
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
			gradientToColors: [ '#f38559'],
			shadeIntensity: 1,
			type: 'horizontal',
			opacityFrom: 1,
			opacityTo: 1,
			stops: [0, 100, 100, 100, 100]
		},
	},
	markers: {
		size: 0,
		opacity: 0.2,
		colors: ["#f38559"],
		strokeColor: "#fff",
		strokeWidth: 2,
		hover: {
			size: 7,
		}
	},
}

var chart = new ApexCharts(
	document.querySelector("#apexLineChartGradient2"),
	options2
);

chart.render();




















var options3 = {
	chart: {
		height: 120,
		type: 'line',
		toolbar: {
			show: false,
		},
	},
	dataLabels: {
		enabled: false,
	},
	stroke: {
		curve: 'smooth'
	},
	grid: {
		show: false,
	},
	series: [{
		name: 'Expenses',
		data: [15, 40, 50, 90, 70, 90, 80]
	}],
	xaxis: {
		labels: {
			show: false,
		},
		axisBorder: {
			show: false,
		},
		categories: [
			"Sunday",
			"Monday",
			"Tuesday",
			"Wednesday",
			"Thursday",
			"Friday",
			"Saturday",
		]
	},
	theme: {
		monochrome: {
			enabled: true,
			color: '#ff8087',
			shadeIntensity: 0.1
		},
	},
	fill: {
		type: 'gradient',
		gradient: {
			shade: 'light',
			gradientToColors: [ '#EC87C0'],
			shadeIntensity: 1,
			type: 'horizontal',
			opacityFrom: 1,
			opacityTo: 1,
			stops: [0, 100, 100, 100, 100]
		},
	},
	markers: {
		size: 0,
		opacity: 0.2,
		colors: ["#EC87C0"],
		strokeColor: "#fff",
		strokeWidth: 2,
		hover: {
			size: 7,
		}
	},
}

var chart = new ApexCharts(
	document.querySelector("#apexLineChartGradient3"),
	options3
);

chart.render();























var options4 = {
	chart: {
		height: 120,
		type: 'line',
		toolbar: {
			show: false,
		},
	},
	dataLabels: {
		enabled: false,
	},
	stroke: {
		curve: 'smooth'
	},
	grid: {
		show: false,
	},
	series: [{
		name: 'Expenses',
		data: [35, 40, 50, 90, 100, 80, 65]
	}],
	xaxis: {
		labels: {
			show: false,
		},
		axisBorder: {
			show: false,
		},
		categories: [
			"Sunday",
			"Monday",
			"Tuesday",
			"Wednesday",
			"Thursday",
			"Friday",
			"Saturday",
		]
	},
	theme: {
		monochrome: {
			enabled: true,
			color: '#AC92EC',
			shadeIntensity: 0.1
		},
	},
	fill: {
		type: 'gradient',
		gradient: {
			shade: 'light',
			gradientToColors: [ '#967ADC'],
			shadeIntensity: 1,
			type: 'horizontal',
			opacityFrom: 1,
			opacityTo: 1,
			stops: [0, 100, 100, 100, 100]
		},
	},
	markers: {
		size: 0,
		opacity: 0.2,
		colors: ["#967ADC"],
		strokeColor: "#fff",
		strokeWidth: 2,
		hover: {
			size: 7,
		}
	},
}

var chart = new ApexCharts(
	document.querySelector("#apexLineChartGradient4"),
	options4
);

chart.render();