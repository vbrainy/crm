
(function($){

	$(document).ready(function(){
		var charts = $('.chart');
		initializeCharts(charts);
	});

	var getChartLineDataSet = function(lineIndex) {

		var lineSets = [
            {
                fillColor : "rgba(220,220,220,0.2)",
                strokeColor : "rgba(220,220,220,1)",
                pointColor : "rgba(220,220,220,1)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "rgba(220,220,220,1)"
            },
            {
                fillColor : "rgba(151,187,205,0.5)",
                strokeColor : "rgba(151,187,205,0.8)",
                pointColor : "rgba(151,187,205,1)",
                pointStrokeColor : "#fff",
                highlightFill : "rgba(151,187,205,0.75)",
                highlightStroke : "rgba(151,187,205,1)",
            },
            {
                fillColor : "rgba(220,220,220,0.2)",
                strokeColor : "rgba(220,220,220,1)",
                pointColor : "rgba(220,220,220,1)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "rgba(220,220,220,1)"
            },
            {
                fillColor : "rgba(151,187,205,0.5)",
                strokeColor : "rgba(151,187,205,0.8)",
                pointColor : "rgba(151,187,205,1)",
                pointStrokeColor : "#fff",
                highlightFill : "rgba(151,187,205,0.75)",
                highlightStroke : "rgba(151,187,205,1)",
            }
		];

		return lineSets[lineIndex];
	};

	var processLineChartData = function(lines) {

        if (!lines.length) return false;

		var data = {
			labels: [],
			datasets: []
		};

		for (var i = 0; i < lines[0].data.length; i++) {
			var label = lines[0].data[i].name;

			data.labels.push(label);
		}

		for (var l = 0; l < lines.length; l++) {

			var lineData = [];
			for (var ld = 0; ld < lines[l].data.length; ld++) {
				lineData.push(lines[l].data[ld].value);
			}

			var dataSet = getChartLineDataSet(l);

			dataSet.label = lines[l].group;
			dataSet.data = lineData;

			data.datasets.push(dataSet);
		}

		return data;

		// var randomScalingFactor = function(){ return Math.round(Math.random()*100);};
		// return {
		// 		labels : ["January","February","March","April","May","June","July"],
		// 		datasets : [
		// 			{
		// 				label: "My First dataset",
		// 				fillColor : "rgba(220,220,220,0.2)",
		// 				strokeColor : "rgba(220,220,220,1)",
		// 				pointColor : "rgba(220,220,220,1)",
		// 				pointStrokeColor : "#fff",
		// 				pointHighlightFill : "#fff",
		// 				pointHighlightStroke : "rgba(220,220,220,1)",
		// 				data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
		// 			},
		// 			{
		// 				label: "My Second dataset",
		// 				fillColor : "rgba(151,187,205,0.2)",
		// 				strokeColor : "rgba(151,187,205,1)",
		// 				pointColor : "rgba(151,187,205,1)",
		// 				pointStrokeColor : "#fff",
		// 				pointHighlightFill : "#fff",
		// 				pointHighlightStroke : "rgba(151,187,205,1)",
		// 				data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
		// 			}
		// 		]
		// 	};
	};

	var processBarChartData = function(bars) {

		var data = {
			labels: [],
			datasets: [{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data: []
			}]
		};

		for (var i = 0; i < bars.data.length; i++) {
			var label = bars.data[i].name,
				value = bars.data[i].value;

			data.labels.push(label);
			data.datasets[0].data.push(value);
		}

		return data;
	};


	var initializeCharts = function(charts) {

		charts.each(function(){

			var chartNode = $(this).get(0),
				chartId = $(this).attr('data-chart-id');

			switch (chartId) {
				case 'lead_volume_by_region': 
				case 'lead_volume_by_segment':
				case 'lead_volume_by_source':
					chartNode.chartType = 'line';
					break;
				default: 
					chartNode.chartType = 'bar';
					break;
			}


			chartNode.chartId = chartId;

			chartNode.chartGetData = function(options, callback) {
				var id = this.chartId,
					type = this.chartType;

				var params = options;
				params.chart = id;

				$.get('getChartData.php', params).success(function(response){
					var data = JSON.parse(response),
						processedData = [];

					if (type == 'line') {
						processedData = processLineChartData(data);
					} else if (type == 'bar') {
						processedData = processBarChartData(data);
					}

                    if (processedData)
					    callback(processedData, type);
				});
			};


			var ctx = chartNode.getContext("2d");

			chartNode.chartGetData({ filter: 'All' }, function(data, type){
				if (chartNode.chartType == 'bar') {
					chartNode.barchart = new Chart(ctx).Bar(data);
					chartNode.chartLoaded = true;
				} else {
					chartNode.linechart = new Chart(ctx).Line(data);
				}
			});

			chartNode.triggerFilter = function(filter) {

				var triggeredChart = this;

				$(triggeredChart).siblings('.no-data').remove();
				triggeredChart.barchart.destroy();
				triggeredChart.chartLoaded = false;
				
				triggeredChart.chartGetData({ filter: filter }, function(data, type) {
					if (data.labels.length) {
						var ctx = triggeredChart.getContext('2d');
						triggeredChart.barchart = new Chart(ctx).Bar(data);
					} else {
						$(triggeredChart).after('<div class="no-data">No data for specified period</div>');
					}
					triggeredChart.chartLoaded = true;
				});
			};

			// if bar chart show options
			if (chartNode.chartType == 'bar') {
				var $chart = $(chartNode);

				var tabsTemplate = function() {
					var html = '<div class="tabs">';

					html += '<span>1m</span>';
					html += '<span>3m</span>';
					html += '<span>6m</span>';
					html += '<span>9m</span>';
					html += '<span>1y</span>';
					html += '<span class="active">All</span>';

					html+= '</div>';

					return html;
				};

				$chart.wrap('<div class="chart-holder" />');
				$chart.parent().append(tabsTemplate());

				$chart.parent().on('click', '.tabs span', function() {
					var node = $(this).parents('.chart-holder').find('canvas').get(0);
					
					if (node.chartLoaded === true) {
						$(this).siblings('.active').removeClass('active');
						$(this).addClass('active');

						node.triggerFilter($(this).html());
					}
				});
			}

		});

	};


})(jQuery);