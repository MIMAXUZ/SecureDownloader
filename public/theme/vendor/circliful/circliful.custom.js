$( document ).ready(function() {



	$("#tasks").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 5,
		percent: 60,
		fontColor: '#000000',
		foregroundColor: '#fd8448',
		backgroundColor: 'rgba(0, 0, 0, 0.1)',
		icon: '\e85d',
		iconColor: '#fd8448',
		iconPosition: 'middle',
		text: 'Tasks',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,		
	});

	$("#trainings").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 5,
		percent: 70,
		fontColor: '#000000',
		foregroundColor: '#ffb445',
		backgroundColor: 'rgba(0, 0, 0, 0.1)',
		icon: '\e54b',
		iconColor: '#ffb445',
		iconPosition: 'middle',
		text: 'Trainings',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,		
	});
	
	$("#friends").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 5,
		percent: 80,
		fontColor: '#000000',
		foregroundColor: '#00b894',
		backgroundColor: 'rgba(0, 0, 0, 0.1)',
		icon: '\e853',
		iconColor: '#00b894',
		iconPosition: 'middle',
		text: 'Friends',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,
	});





	$("#direct").circliful({
		animation: 1,
		animationStep: 5,
		foregroundBorderWidth: 20,
		backgroundBorderWidth: 10,
		percent: 78,
		fontColor: '#000000',
		foregroundColor: '#f23f3f',
		backgroundColor: '#dddddd',
		multiPercentage: 1,
		percentages: [10, 20, 30]
	});
	$("#referrals").circliful({
		animation: 1,
		animationStep: 5,
		foregroundBorderWidth: 20,
		backgroundBorderWidth: 10,
		percent: 43,
		fontColor: '#000000',
		foregroundColor: '#ffb400',
		backgroundColor: '#dddddd',
		multiPercentage: 1,
		percentages: [10, 20, 30]
	});
	$("#search-engines").circliful({
		animation: 1,
		animationStep: 5,
		foregroundBorderWidth: 20,
		backgroundBorderWidth: 10,
		percent: 29,
		fontColor: '#000000',
		foregroundColor: '#74b749',
		backgroundColor: '#dddddd',
		multiPercentage: 1,
		percentages: [10, 20, 30]
	});
	
	// With Icons
	$("#likes").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 15,
		percent: 50,
		fontColor: '#000000',
		foregroundColor: '#d8ff79',
		backgroundColor: 'rgba(0, 0, 0, 0.05)',
		icon: '\e08c',
		iconColor: '#d8ff79',
		iconPosition: 'middle',
		text: 'Likes',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,		
	});

	$("#tweets").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 15,
		percent: 65,
		fontColor: '#000000',
		foregroundColor: '#adff2f',
		backgroundColor: 'rgba(0, 0, 0, 0.05)',
		icon: '\e08d',
		iconColor: '#adff2f',
		iconPosition: 'middle',
		text: 'Tweets',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,		
	});
	
	$("#shares").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 15,
		percent: 75,
		fontColor: '#000000',
		foregroundColor: '#ffef33',
		backgroundColor: 'rgba(0, 0, 0, 0.05)',
		icon: '\e08b',
		iconColor: '#ffef33',
		iconPosition: 'middle',
		text: 'shares',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,
	});

	$("#on-trials").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 15,
		percent: 35,
		fontColor: '#000000',
		foregroundColor: '#00ffff',
		backgroundColor: 'rgba(0, 0, 0, 0.05)',
		icon: '\ea48',
		iconColor: '#00ffff',
		iconPosition: 'middle',
		text: 'Trails',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,		
	});

	$("#base-plan").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 15,
		percent: 50,
		fontColor: '#000000',
		foregroundColor: '#d8ff79',
		backgroundColor: 'rgba(0, 0, 0, 0.05)',
		icon: '\e87e',
		iconColor: '#d8ff79',
		iconPosition: 'middle',
		text: 'Base',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,		
	});

	$("#premium-plan").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 15,
		percent: 65,
		fontColor: '#000000',
		foregroundColor: '#adff2f',
		backgroundColor: 'rgba(0, 0, 0, 0.05)',
		icon: '\e86b',
		iconColor: '#adff2f',
		iconPosition: 'middle',
		text: 'Premium',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,		
	});
	
	$("#platinum-plan").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 15,
		percent: 75,
		fontColor: '#000000',
		foregroundColor: '#ffef33',
		backgroundColor: 'rgba(0, 0, 0, 0.05)',
		icon: '\e068',
		iconColor: '#ffef33',
		iconPosition: 'middle',
		text: 'Platinum',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,
	});

	$("#delivered").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 15,
		percent: 35,
		fontColor: '#000000',
		foregroundColor: '#00ffff',
		backgroundColor: 'rgba(0, 0, 0, 0.05)',
		icon: '\ea48',
		iconColor: '#00ffff',
		iconPosition: 'middle',
		text: 'Delivered',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,		
	});

	$("#ordered").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 15,
		percent: 50,
		fontColor: '#000000',
		foregroundColor: '#d8ff79',
		backgroundColor: 'rgba(0, 0, 0, 0.05)',
		icon: '\e87e',
		iconColor: '#d8ff79',
		iconPosition: 'middle',
		text: 'Ordered',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,		
	});

	$("#reported").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 15,
		percent: 65,
		fontColor: '#000000',
		foregroundColor: '#adff2f',
		backgroundColor: 'rgba(0, 0, 0, 0.05)',
		icon: '\e86b',
		iconColor: '#adff2f',
		iconPosition: 'middle',
		text: 'Reporeted',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,		
	});
	
	$("#arrived").circliful({
		animationStep: 5,
		foregroundBorderWidth: 5,
		backgroundBorderWidth: 15,
		percent: 75,
		fontColor: '#000000',
		foregroundColor: '#ffef33',
		backgroundColor: 'rgba(0, 0, 0, 0.05)',
		icon: '\e068',
		iconColor: '#ffef33',
		iconPosition: 'middle',
		text: 'Arrived',
		textBelow: true,
		animation: 1,
		animationStep: 1,
		start: 2,
		showPercent: 1,
	});

	$("#fb-likes").circliful({
		animationStep: 5,
		foregroundBorderWidth: 15,
		backgroundBorderWidth: 15,
		percent: 82,
		textSize: 30,
		fontColor: '#000000',
		foregroundColor: '#7190d4',
		backgroundColor: 'rgba(0, 0, 0, 0.05)',
		start: 2,
		multiPercentage: 1,
	});

	$("#tw-tweets").circliful({
		animationStep: 5,
		foregroundBorderWidth: 15,
		backgroundBorderWidth: 15,
		percent: 75,
		textSize: 30,
		fontColor: '#000000',
		foregroundColor: '#91d0ff',
		backgroundColor: 'rgba(0, 0, 0, 0.05)',
		start: 2,
		multiPercentage: 1,
	});

	$("#lk-posts").circliful({
		animationStep: 5,
		foregroundBorderWidth: 15,
		backgroundBorderWidth: 15,
		percent: 58,
		textSize: 30,
		fontColor: '#000000',
		foregroundColor: '#2db0f3',
		backgroundColor: 'rgba(0, 0, 0, 0.05)',
		start: 2,
		multiPercentage: 1,
	});

	$("#gp-shares").circliful({
		animationStep: 5,
		foregroundBorderWidth: 15,
		backgroundBorderWidth: 15,
		percent: 49,
		textSize: 30,
		fontColor: '#000000',
		foregroundColor: '#f37673',
		backgroundColor: 'rgba(0, 0, 0, 0.05)',
		start: 2,
		multiPercentage: 1,
	});

});

