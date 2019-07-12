var options = {
	chart: {
		height: 350,
		type: 'line',
		zoom: {
			enabled: false
		}
	},
	dataLabels: {
		enabled: false
	},
	stroke: {
		curve: 'straight',
		width: 3,
	},
	series: [{
		name: "Macbooks",
		data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
	}],
	title: {
		text: 'Product Sales by Month',
		align: 'center'
	},
	grid: {
		row: {
			colors: ['#f4f5fb', '#ffffff'], // takes an array which will be repeated on columns
			opacity: 0.5
		},
	},
	xaxis: {
		categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
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
		opacity: 0.2,
		colors: ["#1177be"],
		strokeColor: "#fff",
		strokeWidth: 2,
		hover: {
			size: 7,
		}
	},
}

var chart = new ApexCharts(
	document.querySelector("#basic-line-graph"),
	options
);

chart.render();