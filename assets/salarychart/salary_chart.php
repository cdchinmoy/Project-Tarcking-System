<?php

/* Include the `fusioncharts.php` file that contains functions	to embed the charts. */

include("src/fusioncharts.php");

/* The following 4 code lines contain the database connection information. Alternatively, you can 
move these code lines to a separate file and include the file here. You can also modify 
this code based on your database connection. */

   $hostdb = "localhost:3306";  // MySQl host
   $userdb = "root";  // MySQL username
   $passdb = "";  // MySQL password
   $namedb = "dummy_database";  // MySQL database name

   // Establish a connection to the database
   $dbhandle = mysqli_connect($hostdb, $userdb, $passdb, $namedb);

   /*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
   if (!$dbhandle) {
  	exit("There was an error with your connection: ".mysqli_connect_error());
   }
?>

<html>
   <head>
  	<title>FusionCharts XT - Column 2D Chart - Data from a database</title>
    <script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
    <script type="text/javascript" src="http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56"></script>	
  </head>

   <body>
  	<?php

     	// Form the SQL query that returns the top 10 most populous countries
     	$strQuery = "SELECT * FROM `user_salary` WHERE `user_id`=36 ORDER BY `user_salary`.`salary_id` ASC";

     	// Execute the query, or else return the error message.
     	$result = mysqli_query($dbhandle,$strQuery);

     	// If the query returns a valid response, prepare the JSON string
     	if ($result) {
      	// The `$arrData` array holds the chart attributes and data
      	$arrData = array(
    	    "chart" => array(
              "caption"=>"Salary and Raises",
              "subCaption"=>"For over the years",
              "xAxisname"=>"Year",
              "pYAxisName"=>"Amount (In INR)",
              "sYAxisName"=>"Raise %",
              "numberPrefix"=>"Rs",
              "sNumberSuffix"=>"%",
              "sYAxisMaxValue"=>"100",
              "numDivLines"=>"3",
              "theme"=>"fint"
          	)
         );

        //prepare categories  
      	$arrData["categories"] = array();
        $category = array();
		$total_sal= 0;
		$i=0;
        // Push the data into the category array
      	while($row = mysqli_fetch_array($result)) {
         	array_push($category, array(
          	"label" => $row["salary_year"]
          	)
         	);
			$total_sal= $total_sal + $row["salary_amount"];
			$i++;
      	}
		$avg_sal = $total_sal/$i; 
        array_push($arrData["categories"], array("category" => $category));

      //prepare dataset
      $arrData["dataset"] = array();
      array_push($arrData["dataset"], buildDataset(array("seriesName"=>"salary_amount"), "salary_amount", $strQuery));
      array_push($arrData["dataset"], buildDataset(array("seriesName"=>"salary_raise","salary_raise"=>"area",
        "showValues"=>"0",), "salary_raise", $strQuery));
      array_push($arrData["dataset"], buildDataset(array("seriesName"=>"salary_raise_percent %", "parentYAxis"=>"S",
            "renderAs"=>"line",
            "showValues"=>"0"), "salary_raise_percent", $strQuery));

      //prepare trendline
      $arrData["trendlines"] = array();
      $line = array();
      array_push($line, array("startValue"=>$avg_sal,"color"=>"#0075c2","valuePadding"=>"20", "displayvalue"=>"Average{br}Salary"));
      array_push($line, array("startValue"=>"21","parentYAxis"=>"s","color"=>"#f2c500","displayvalue"=>"Average{br}Raise %"));
      array_push($arrData["trendlines"], array("line" => $line));
    
      //JSON Encode the data to retrieve the string containing the JSON representation of the data in the array.
    	$jsonEncodedData = json_encode($arrData);

      /*Create an object for the mscombi chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/
      $mscombidy2dChart = new FusionCharts("mscombidy2d", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);
      // Render the chart
      $mscombidy2dChart->render();
      // Close the database connection
      $dbhandle->close();
    }

    function buildDataset($data, $dataColumName, $sqlquery) {
      $resultset = mysqli_query($GLOBALS['dbhandle'], $sqlquery);
      $datasetinner = $data;
      $makedata = array();

      while($row = mysqli_fetch_array($resultset)) {
        array_push($makedata, array(
          "value" => $row[$dataColumName]
        ));
      }         
      $datasetinner["data"] = $makedata;
      return $datasetinner;
    }
           
  	?>

  	<div id="chart-1"><!-- Fusion Charts will render here--></div>
   </body>
</html>