// Apex Over All Rating
var options = {
	chart: {
		height: 280,
		type: 'area',
		toolbar: {
			show: false, 
		},
	},
	dataLabels: {
		enabled: true
	},
	stroke: {
		curve: 'smooth',
		width: 3,
		dashArray: [0, 3],
	},
	grid: {
		show: false,
	},
	colors: ['#80bcdc', '#666666'],
	fill: {
		type: 'gradient',
		gradient: {
			shadeIntensity: 1,
			inverseColors: false,
			opacityFrom: 0.5,
			opacityTo: 0,
			stops: [0, 90, 100]
		}
	},
	series: [{
		name: 'Ratings',
		data: [15, 20, 30, 40, 30, 45, 55]
	}, {
		name: 'Reviews',
		data: [5, 10, 10, 15, 10, 20, 15],
	}],
	legend: {
		show: true,
		position: 'bottom',
		horizontalAlign: 'center', 
		markers: {
			width: 10,
			height: 10,
			radius: 20,
		},
		itemMargin: {
			horizontal: 15,
			vertical: 10
		},
	},
	xaxis: {
		categories: [
			"Sun",
			"Mon",
			"Tue",
			"Wed",
			"Thu",
			"Fri",
			"Sat"
		]
	},
}
var chart = new ApexCharts(
	document.querySelector("#overAllRating"),
	options
);
chart.render();
























// Apex Orders
var options2 = {
	chart: {
		height: 280,
		type: 'bar',
		toolbar: {
			show: false,
		},
	},
	plotOptions: {
		bar: {
			horizontal: false,
			endingShape: 'arrow',
			columnWidth: '50%',
		},
	},
	dataLabels: {
		enabled: false
	},
	colors: ['#67caf0', '#ff8087'],
	stroke: {
		show: true,
		width: 2,
		colors: ['transparent']
	},
	series: [{
		name: 'Online',
		data: [33, 47, 35, 65, 72]
	}, {
		name: 'Offline',
		data: [28, 41, 27, 47, 58]
	}],
	legend: {
		show: true,
		position: 'bottom',
		horizontalAlign: 'center', 
		markers: {
			width: 10,
			height: 10,
			radius: 20,
		},
		itemMargin: {
			horizontal: 15,
			vertical: 12
		},
	},
	xaxis: {
		categories: [
			"Mon",
			"Tue",
			"Wed",
			"Thu",
			"Fri",
		],
	},
	yaxis: {
		title: {
			text: '$ (thousands)'
		}
	},
	fill: {
		opacity: 1
	},
	tooltip: {
		y: {
			formatter: function (val) {
				return "$" + val + " thousands"
			}
		}
	}
}
var chart = new ApexCharts(
	document.querySelector("#apexOrders"),
	options2
);
chart.render();






























// Apex Customers
var options3 = {
	chart: {
		height: 280,
		type: 'bar',
		stacked: true,
		toolbar: {
			show: false,
		},
	},
	colors: ['#1da8df','#ff8087'],
	plotOptions: {
		bar: {
			horizontal: true,
			barHeight: '40%',
		},
	},
	dataLabels: {
		enabled: false,
	},
	stroke: {
		width: 0,
		colors: ["#ffffff"]
	},
	series: [{
		name: 'Male',
		data: [10, 20, 30, 40, 50, 60]
	},{
		name: 'Female',
		data: [-10, -20, -30, -40, -50, -60],
	}],
	grid: {
		show: false,
		xaxis: {
			showLines: false
		}
	},
	yaxis: {
		min: -60,
		max: 60,
		title: {
			text: 'Age',
		},
	},
	tooltip: {
		shared: false,
		x: {
			formatter: function(val) {
				return val
			}
		},
		y: {
			formatter: function(val) {
				return Math.abs(val) + "%"
			}
		}
	},
	legend: {
		show: true,
		position: 'bottom',
		horizontalAlign: 'center',
		markers: {
			width: 10,
			height: 10,
			radius: 20,
		},
		itemMargin: {
			horizontal: 15,
			vertical: 10
		},
	},
	xaxis: {
		categories: ['60+', '50-59', '40-49', '30-39', '20-29', '15-19'],
		labels: {
			formatter: function(val) {
				return Math.abs(Math.round(val)) + "%"
			}
		}
	},
}
var chart = new ApexCharts(
	document.querySelector("#customers"),
	options3
);
chart.render();






























// Apex Traffic
var options4 = {
	chart: {
		height: 289,
		type: 'radialBar',
		toolbar: {
			show: false, 
		},
	},
	colors: ['#1177be', '#9ec94a', '#fd7274'],
	plotOptions: {
		radialBar: {
			dataLabels: {
				name: {
					fontSize: '.8rem',
				},
				value: {
					fontSize: '1.4rem',
				},
				total: {
					show: true,
					label: 'Traffic',
					formatter: function (w) {
						return 5000
					}
				}
			}
		}
	},
	fill: {
		type: 'gradient',
		gradient: {
			gradientToColors: ['#f2d6d3', '#ddf2b5', '#b2e5f0'],
			shadeIntensity: 1,
			inverseColors: false,
			opacityFrom: 1,
			opacityTo: 1,	
			stops: [0, 100]
		}
	},
	series: [50, 60, 70],
	labels: ['Others', 'Direct', 'Referrals'],
}
var chart = new ApexCharts(
	document.querySelector("#traffic"),
	options4
);
chart.render();























// Apex Sales
var options5 = {
	chart: {
		height: 280,
		type: 'bar',
		toolbar: {
			show: false,
		},
	},
	plotOptions: {
		bar: {
			horizontal: true,
			barHeight: '35%',
			endingShape: 'arrow',
		}
	},
	dataLabels: {
		enabled: false
	},
	colors: ['#67caf0', '#80bcdc'],
	fill: {
		gradient: {
			color: '#80bcdc',
			shadeIntensity: 1,
			inverseColors: false,
			opacityFrom: 0.8,
			opacityTo: 0,
			stops: [0, 90, 100]
		}
	},
	series: [{
		name: 'Orders',
		data: [1000, 2000, 3500, 5500, 2500, 3500, 4000]
	}],
	xaxis: {
		categories: [
			"Bakery",
			"Bevarages",
			"Beauty",
			"Clothing",
			"Electronics",
			"Fruits",
			"Groceries",
		],
	},
}
var chart = new ApexCharts(
	document.querySelector("#apexSales"),
	options5
);
chart.render();

























// Apex Deals
var options6 = {
	chart: {
		height: 280,
		type: 'bar',
		stacked: true,
		toolbar: {
			show: false,
		},
	},
	colors: ['#1da8df','#ff8087'],
	plotOptions: {
		bar: {
			horizontal: false,
			columnWidth: '35%',
			endingShape: 'arrow',
		},
	},
	dataLabels: {
		enabled: false,
	},
	stroke: {
		width: 0,
		colors: ["#ffffff"],
	},
	series: [{
		name: 'Deals Open',
		data: [700, 1400, 2100, 2800, 3500, 2800, 2100, 1400, 700]
	},{
		name: 'Deals Claimed',
		data: [-550, -1100, -1500, -2100, -2700, -2100, -1500, -1100, -550],
	}],
	grid: {
		show: false,
		xaxis: {
			showLines: false
		}
	},
	tooltip: {
		shared: false,
		x: {
			formatter: function(val) {
				return val
			}
		},
		y: {
			formatter: function(val) {
				return Math.abs(val)
			}
		}
	},
	legend: {
		show: true,
		position: 'bottom',
		horizontalAlign: 'center',
		markers: {
			width: 10,
			height: 10,
			radius: 20,
		},
		itemMargin: {
			horizontal: 15,
			vertical: 10
		},
	},
	xaxis: {
		categories: ['100', '200', '300', '400', '500', '600', '700', '800', '900' ],
		labels: {
			formatter: function(val) {
				return Math.abs(Math.round(val))
			}
		}
	},
}
var chart = new ApexCharts(
	document.querySelector("#deals"),
	options6
);
chart.render();























// var options5 = {
//   chart: {
//     height: 280,
//     type: 'line',
//     stacked: false,
//     toolbar: {
// 			show: false, 
// 		},
//   },
//   dataLabels: {
//     enabled: false
//   },
//   series: [{
//     name: 'Income',
//     type: 'column',
//     data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
//   }, {
//     name: 'Cashflow',
//     type: 'column',
//     data: [1.1, 3, 3.1, 4, 4.1, 4.9, 6.5, 8.5]
//   }, {
//     name: 'Revenue',
//     type: 'line',
//     data: [20, 29, 37, 36, 44, 45, 50, 58]
//   }],
//   stroke: {
//     width: [1, 1, 4]
//   },
//   xaxis: {
//     categories: [2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018],
//   },
//   yaxis: [
//     {
//       axisTicks: {
//         show: true,
//       },
//       axisBorder: {
//         show: true,
//         color: '#008FFB'
//       },
//       labels: {
//         style: {
//           color: '#008FFB',
//         }
//       },
//       title: {
//         text: "Income (thousand crores)",
//         style: {
//           color: '#008FFB',
//         }
//       },
//       tooltip: {
//         enabled: true
//       }
//     },

//     {
//       seriesName: 'Income',
//       opposite: true,
//       axisTicks: {
//         show: true,
//       },
//       axisBorder: {
//         show: true,
//         color: '#00E396'
//       },
//       labels: {
//         style: {
//           color: '#00E396',
//         }
//       },
//       title: {
//         text: "Operating Cashflow (thousand crores)",
//         style: {
//           color: '#00E396',
//         }
//       },
//     },{
//       seriesName: 'Revenue',
//       opposite: true,
//       axisTicks: {
//         show: true,
//       },
//       axisBorder: {
//         show: true,
//         color: '#FEB019'
//       },
//       labels: {
//         style: {
//           color: '#FEB019',
//         },
//       },
//       title: {
//         text: "Revenue (thousand crores)",
//         style: {
//           color: '#FEB019',
//         }
//       }
//     },
//   ],
//   tooltip: {
//     fixed: {
//       enabled: true,
//       position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
//       offsetY: 30,
//       offsetX: 60
//     },
//   },
//   legend: {
//     horizontalAlign: 'left',
//     offsetX: 40
//   }
// }
// var chart = new ApexCharts(
//   document.querySelector("#realTimeSales"),
//   options5
// );
// chart.render();