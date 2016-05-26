<html>
<head>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>

	<script type="text/javascript" src="chart-helper.js"></script>

	<style>
		/* STYLE RESET ONLY FOR THIS PAGE */
		* {
			font-family: sans-serif;
		}
		body {
			width: 600px;
			margin: 0 auto;
			padding-top: 40px;
		}
		h1 {
			margin-top: 60px;
		}
		h2 {
			color: #555;
			padding-left: 10px;
			margin-top: 40px;
		}

		/* STYLE FOR BAR CHART TIME FILTERS */
		.chart-holder {
			position: relative;
			padding-top: 40px;
		}
		.chart-holder .tabs {
			position: absolute;
			top: 0;
			left: 0;
			border: 4px solid #eee;
			background: #eee;
		}
		.chart-holder .tabs span {
			padding: 5px 10px;
			color: #555;
			cursor: pointer;
			display: inline-block;
		}
		.chart-holder .tabs span.active {
			background: #fff;
			color: #333;
		}
		.chart-holder .tabs span:hover {
			background: rgba(255,255,255,0.5);
		}
	</style>
</head>
<body>

<h1>Marketing strategy insights</h1>

<div class="chart-wrapper">
	<h2>Lead Volume by Region over time</h2>
	<canvas data-chart-id="lead_volume_by_region" class="chart" height="200" width="500"></canvas>
</div>

<div class="chart-wrapper">
	<h2>Lead Volume by Segment Over Time</h2>
	<canvas data-chart-id="lead_volume_by_segment" class="chart" height="200" width="500"></canvas>
</div>

<div class="chart-wrapper">
	<h2>Lead Volume by Source Over Time</h2>
	<canvas data-chart-id="lead_volume_by_source" class="chart" height="200" width="500"></canvas>
</div>

<h1>Business Development Performance</h1>

<div class="chart-wrapper">
	<h2>Total Value of Opportunities by Region</h2>
	<canvas data-chart-id="total_value_opportunities_by_region" class="chart" height="200" width="500"></canvas>
</div>

<div class="chart-wrapper">
	<h2>Total Value of Opportunities by Segment</h2>
	<canvas data-chart-id="total_value_opportunities_by_segment" class="chart" height="200" width="500"></canvas>
</div>

<div class="chart-wrapper">
	<h2>Average Value of Opportunities by Stage</h2>
	<canvas data-chart-id="average_value_opportunities_by_stage" class="chart" height="200" width="500"></canvas>
</div>

<div class="chart-wrapper">
	<h2>Average Value of Opportunities by Segment</h2>
	<canvas data-chart-id="average_value_opportunities_by_segment" class="chart" height="200" width="500"></canvas>
</div>

<h1>Business Development Effectiveness</h1>

<div class="chart-wrapper">
	<h2>Total Value of Opportunities by Stage</h2>
	<canvas data-chart-id="total_value_opportunities_by_stage" class="chart" height="200" width="500"></canvas>
</div>

<div class="chart-wrapper">
	<h2>Total Number of Opportunities by Stage</h2>
	<canvas data-chart-id="total_opportunities_by_stage" class="chart" height="200" width="500"></canvas>
</div>


</body>
</html>