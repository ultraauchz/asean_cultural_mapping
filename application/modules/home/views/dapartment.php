	<style>
		.google-visualization-orgchart-table{
			border-collapse : inherit;
		}
	</style>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["orgchart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');

        data.addRows([
          <?php echo $rs; ?>
        ]);
         
		//data.setRowProperty(2, 'style', 'background-color:red;background-image:none;border: 1px solid red');
		//data.setRowProperty(3, 'style', 'background-color:green;background-image:none;border: 1px solid green');
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        chart.draw(data, {allowHtml:true,size:'medium'});
        
        
      }
      
   </script>

  <div id="chart_div" style="width: 800px"></div>