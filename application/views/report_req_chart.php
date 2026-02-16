<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PT INDOSPEC ASIA | Request Transport</title>
	<link type="image/png" href="<?php 'assets/images/favicon.png'; ?>" rel="icon"/>	
	
	<script type="text/javascript" src="<?php echo 'assets/external-js/jquery-3.1.1.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo 'assets/highcharts/code/highcharts.js'; ?>" ></script>
	<script type="text/javascript" src="<?php echo 'assets/highcharts/code/modules/exporting.js'; ?>" ></script>
	
	
</head>

<body style="background-image: url('<?php echo base_url('assets/images/my-bg.jpg'); ?>')" >

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$yy = date('Y');
$mm = date('n');
?>

<script type="text/javascript">
$(document).ready(function() {
	
	var chart1; 

    chart1 = new Highcharts.Chart({
    chart: {
        renderTo: 'container-chart',
        type: 'line'
     },  

    title: {
        text: 'Transport Request <?php echo $yy ?>'
    },

    subtitle: {
        text: 'PT Indospec Asia'
    },

    yAxis: {
        title: {
            text: 'Transport Request Number'
        }
    },
	
	xAxis: {
            categories: ['January','February','March','April','May','June','July','August','September','November','October','December']
    },
		 
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },



    series: [
	{
        name: 'Driver',
        data: [
		<?php 
		for($i=1;$i<=$mm;$i++){
			if($i==$mm){$x="";}else{$x=",";}
			$num1 = $this->M_Report_Request_Chart->M_Select_Req_Driver_Num($i,$yy)->num_rows();
			echo $num1.$x;
		}
		?>		
		]
    },
	
	{
        name: 'Courier',
        data: [
		<?php 
		for($i=1;$i<=$mm;$i++){
			if($i==$mm){$x="";}else{$x=",";}
			$num4 = $this->M_Report_Request_Chart->M_Select_Req_Courier_Num($i,$yy)->num_rows();
			echo $num4.$x;
		}
		?>		
		]
    },
	
	],
	
	

    responsive: {
        rules: [{
            condition: {
                maxWidth: 100
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
	}
	});
});
</script>


<center><div id="container-chart" ></div></center>

</body>
</html>