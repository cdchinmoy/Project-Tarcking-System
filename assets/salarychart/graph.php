<!--<html>
<body >
<div class="PT_Care_vitals_swa_ofcurv_left"  onclick="getPatientVitalInfo();"></div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">google.load('visualization', '1.0', {'packages':['corechart']});</script>
<script type="text/javascript">

	$(document).ready(function(e){
		  // barsVisualization must be global in our script tag to be able
		  // to get and set selection.
		  var barsVisualization;

		  function drawMouseoverVisualization() {
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Year');
			data.addColumn('number', 'Score');
			data.addRows([
			  ['2005',3.6],
			  ['2006',4.1],
			  ['2007',3.8],
			  ['2008',3.9],
			  ['2009',4.6]
			]);

			barsVisualization = new google.visualization.ColumnChart(document.getElementById('mouseoverdiv'));
			barsVisualization.draw(data, null);

			// Add our over/out handlers.
			google.visualization.events.addListener(barsVisualization, 'onmouseover', barMouseOver);
			google.visualization.events.addListener(barsVisualization, 'onmouseout', barMouseOut);
		  }

		  function barMouseOver(e) {
			barsVisualization.setSelection([e]);
		  }

		  function barMouseOut(e) {
			barsVisualization.setSelection([{'row': null, 'column': null}]);
		  }
	});

</script>
</body>
</html>-->

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        /*var data = new google.visualization.arrayToDataTable([
          ['Year', 'Salary', 'Percentage'],
          ["2017", "10000", 11.12],
          ["2016", "9000", 12.5],
          ["2015", "8000", 33.34],
          ["2014", "6000", 50],
          ['2013', '4000', 0]
        ]);*/
		/*var data = new google.visualization.arrayToDataTable([
          ['Year', 'Percentage', 'Salary'],
          ["2017", 11.12, "10000"],
          ["2016", 12.5, "9000"],
          ["2015", 33.34, "8000"],
          ["2014", 50, "6000"],
          ['2013', 0, '4000']
        ]);*/

		/*var data = new google.visualization.arrayToDataTable([
		array("['Year']"=>"['2017'],['2016'],['2015'],['2014'],['2013']", "['Percentage']"=>"[11.12],[12.5],[33.34],[50],[0]");
          
        ]);*/
		
		var data = new google.visualization.DataTable();
		  data.addColumn('string', 'Year');
		  data.addColumn('number', 'Salary');
		  data.addColumn('number', 'Percentage');
		  data.addRows([
			['2017', 11000, 11.12],
			['2016', 10000, 12.5],
			['2015', 8000, 33.34],
			['2014', 6000, 50],
			['2013', 4000, 2]
		  ]);
		
        var options = {
          title: 'Chess opening moves',
          width: 900,
          legend: { position: 'none' },
          chart: { title: 'Chess opening moves',
                   subtitle: 'popularity by percentage' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Percentage'} // Top x-axis.
			 // 0: { side: 'bottom', label: 'Salary'}
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
  </head>
  <body>
    <div id="top_x_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>