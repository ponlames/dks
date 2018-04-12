<?php
    $string1 = fopen("string1.txt", "r") or die("Unable to open file!");
    $string1 = fread($string1,filesize('string1.txt'));
    $string1 = str_replace("\r\n", ",", $string1);
    $string2 = fopen("string2.txt", "r") or die("Unable to open file!");
    $string2 = fread($string2,filesize('string2.txt'));
    $string2 = str_replace("\r\n", ",", $string2);
    $string3 = fopen("string3.txt", "r") or die("Unable to open file!");
    $string3 = fread($string3,filesize('string3.txt'));
    $string3 = str_replace("\r\n", ",", $string3);
    $string4 = fopen("string4.txt", "r") or die("Unable to open file!");
    $string4 = fread($string4,filesize('string4.txt'));
    $string4 = str_replace("\r\n", ",", $string4);
    $lower  = fopen("lower.txt", "r") or die("Unable to open file!");
    $lower  = fread($lower,filesize('lower.txt'));
    $lower  = str_replace("\r\n", ",", $lower);
    $upper  = fopen("upper.txt", "r") or die("Unable to open file!");
    $upper  = fread($upper,filesize('upper.txt'));
    $upper  = str_replace("\r\n", ",", $upper);
    $time  = fopen("time.txt", "r") or die("Unable to open file!");
    $time  = fread($time,filesize('time.txt'));
    $time  = str_replace("\r\n", ",", $time);
?> <!DOCTYPE HTML>
<html>
<head>
</head>
<style>
h1 {
    font-size: 30px;
}
body{
	background-color: lightBlue;
}
</style>

<script>
window.onload = function () {

var dataPoints1 = [];
var dataPoints2 = [];
var dataPoints3 = [];
var dataPoints4 = [];
var dataPoints5 = [];
var dataPoints6 = [];
var string1 = "<?php echo $string1 ?>";
var string1 = string1.split(",");
var string2 = "<?php echo $string2 ?>";
var string2 = string2.split(",");
var string3 = "<?php echo $string3 ?>";
var string3 = string3.split(",");
var string4 = "<?php echo $string4 ?>";
var string4 = string4.split(",");
var lower = "<?php echo $lower ?>";
var lower = lower.split(",");
var upper = "<?php echo $upper ?>";
var upper = upper.split(",");
var time = "<?php echo $time ?>";
var time = time.split(",");
var temp
var chart = new CanvasJS.Chart("chartContainer", {
	zoomEnabled: true,
	title: {
		text: "Deteriorated detect method"
	},
	axisX: {
		title: "Time(s)"
		
	},
	
	axisY:{
		
		suffix: " A",
		includeZero: false
	
	}, 
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		verticalAlign: "top",
		fontSize: 22,
		fontColor: "dimGrey",
		itemclick : toggleDataSeries
	},
	data: [{ 
		type: "line",
		xValueType: "dateTime",
		yValueFormatString: "####.0000A",
		xValueFormatString: "hh:mm:ss TT",
		showInLegend: true,
		name: "String1",
		dataPoints: dataPoints1
		},
		{				
			type: "line",
			xValueType: "dateTime",
			yValueFormatString: "####.0000A",
			showInLegend: true,
			name: "String2" ,
			dataPoints: dataPoints2
        },
        {				
			type: "line",
			xValueType: "dateTime",
			yValueFormatString: "####.0000A",
			showInLegend: true,
			name: "String3" ,
			dataPoints: dataPoints3
        },
        {				
			type: "line",
			xValueType: "dateTime",
			yValueFormatString: "####.0000A",
			showInLegend: true,
			name: "String4" ,
			dataPoints: dataPoints4
        },
        {				
			type: "line",
			xValueType: "dateTime",
			yValueFormatString: "####.0000A",
			showInLegend: true,
			name: "Lower" ,
			dataPoints: dataPoints5
        },
        {				
			type: "line",
			xValueType: "dateTime",
			yValueFormatString: "####.0000A",
			showInLegend: true,
			name: "Upper" ,
			dataPoints: dataPoints6
        }
        ]
});

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

var updateInterval = 300;
// initial value
var yValue1 = 0; 
var yValue2 = 0;
var yValue3 = 0;
var yValue4 = 0;
var yValue5 = 0;
var yValue6 = 0;
var dataLength = time.length; 

//var time = new Date;
// starting at 9.30 am
//time.setHours(9);
//time.setMinutes(30);
//time.setSeconds(00);
//time.setMilliseconds(00);
var deltaY1,deltaY2,deltaY3,deltaY4,deltaY5,deltaY6;
function updateChart(count) {
	count = count || 1;
	for (var j = 0; j < count-1; j++ ) {
		//time.setTime(time.getTime()+ updateInterval);
		temp = time[j].replace(/-/g," ");
        temp = temp.replace(/:/g," ");
        temp = temp.split(' ');
        var year = parseInt(temp[2])
        var month = parseInt(temp[1])
        var day = parseInt(temp[0])
        var hours = parseInt(temp[3])
        var minutes = parseInt(temp[4])
        var seconds = parseInt(temp[5])
	     //xVal = new Date(parseInt(temp[2]),parseInt(temp[1]),parseInt(temp[0]),parseInt(temp[3]),parseInt(temp[4]),parseInt(temp[5]))
		xVal =  new Date(year, month, day, hours, minutes, seconds);
		deltaY1 = parseFloat(string1[j]) ;
		deltaY2 = parseFloat(string2[j]) ;
        deltaY3 = parseFloat(string3[j]) ;
        deltaY4 = parseFloat(string4[j]) ;
        deltaY5 = parseFloat(lower[j]) ;
        deltaY6 = parseFloat(upper[j]) ;
        
        
	// adding random value and rounding it to two digits. 
	yValue1 =  deltaY1;
	yValue2 =  deltaY2;
    yValue3 =  deltaY3;
    yValue4 =  deltaY4;
    yValue5 =  deltaY5;
    yValue6 =  deltaY6;

	// pushing the new values
	dataPoints1.push({
		x: xVal,
		y: yValue1
	});
	dataPoints2.push({
		x: xVal,
		y: yValue2
	});
    dataPoints3.push({
		x: xVal,
		y: yValue3
	});
    dataPoints4.push({
		x: xVal,
		y: yValue4
	});
    dataPoints5.push({
		x: xVal,
		y: yValue5
	});

    dataPoints6.push({
		x: xVal,
		y: yValue6
	});
	}

	// updating legend text with  updated with y Value 
	chart.options.data[0].legendText = " Current String1 " + yValue1 ; 
	chart.options.data[1].legendText = " Current String2 " + yValue2 ;
    chart.options.data[2].legendText = " Current String3 " + yValue3;
    chart.options.data[3].legendText = " Current String4 " + yValue4;
    chart.options.data[4].legendText = " Lower" + yValue5;
    chart.options.data[5].legendText = " Upper" + yValue6;
	chart.render();
}
// generates first set of dataPoints 
updateChart(dataLength);	
setInterval(function(){updateChart()}, updateInterval);
}
</script>
<meta http-equiv="refresh" content="10" />
</head>
<body>
<div id="chartContainer" style="height: 650px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	
</body>
</html>

<br>
<br>
<font>
<h1>	Current String1 &nbsp;&nbsp;&nbsp; Current String2 &nbsp;&nbsp;&nbsp; Current String3 &nbsp;&nbsp;&nbsp; Current String4 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Upper&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lower</h1>
</font>
<br>
<?php

	$line = '';
	$f = fopen('error.txt', 'r');
	$file = file('error.txt');
	$cursor = -1;

	fseek($f, $cursor, SEEK_END);
	$char = fgetc($f);

	/**
	 * Trim trailing newline chars of the file
	 */
	while ($char === "\n" || $char === "\r") {
		fseek($f, $cursor--, SEEK_END);
		$char = fgetc($f);
	}

	/**
	 * Read until the start of file or first newline char
	 */
	while ($char !== false && $char !== "\n" && $char !== "\r") {
		/**
		 * Prepend the new char
		 */
		$line = $char . $line;
		fseek($f, $cursor--, SEEK_END);
		$char = fgetc($f);
	}
    $line_old = $file[sizeof($file)-2];
    $line_old1 = $file[sizeof($file)-3];
    $line_old2 = $file[sizeof($file)-4];
    $line_old3 = $file[sizeof($file)-5];
    $line_old4 = $file[sizeof($file)-6];
    $line_old5 = $file[sizeof($file)-7];
    $line_old6 = $file[sizeof($file)-8];
    $line_old7 = $file[sizeof($file)-9];
    $line_old8 = $file[sizeof($file)-10];
    $line_old9 = $file[sizeof($file)-11];
    $line_old10 = $file[sizeof($file)-12];
	$line_old11 = $file[sizeof($file)-13];
	$line_old12 = $file[sizeof($file)-14];
	$line_old13 = $file[sizeof($file)-15];
	$line_old14 = $file[sizeof($file)-16];
	$line_old15 = $file[sizeof($file)-17];
	$line_old16 = $file[sizeof($file)-18];
	$line_old17 = $file[sizeof($file)-19];
	$line_old18 = $file[sizeof($file)-20];
	$line_old19 = $file[sizeof($file)-21];
	$line_old20 = $file[sizeof($file)-22];
	$line_old21 = $file[sizeof($file)-23];
	$line_old22 = $file[sizeof($file)-24];
	$line_old23 = $file[sizeof($file)-25];
	$line_old24 = $file[sizeof($file)-26];
	$string1 = explode(',', $string1);
	$string2 = explode(',', $string2);
	$string3 = explode(',', $string3);
	$string4 = explode(',', $string4);
	$lower = explode(',', $lower);
	$upper = explode(',', $upper);

	$error = $line;
	$error = explode(' ', $error);

	/*if ((int)$error[0] == 1){
		echo "<font color='red'size='120'>".(string)($string1[count($string1)-2])."</font>";
	}
	else{
		echo "<font color='green' size='120'>".(string)($string1[count($string1)-2])."</font>";
	}
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";


	if ((int)$error[1] == 1){
		echo "<font color='red' size='120'>".(string)($string2[count($string2)-2])."</font>";
	}
	else{
		echo "<font color='green' size='120' >".(string)($string2[count($string2)-2])."</font>";
	}
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";


	if ((int)$error[2] == 1){
		echo "<font color='red' size='120' >".(string)($string3[count($string3)-2])."</font>";
	}
	else{
		echo "<font color='green' size='120' >".(string)($string3[count($string3)-2])."</font>";
	}
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";


	if ((int)$error[3] == 1){
		echo "<font color='red' size='120' >".(string)($string4[count($string4)-2])."</font>";
	}
	else{
		echo "<font color='green' size='120' >".(string)($string4[count($string4)-2])."</font>";
	}
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";


	echo "<font size='10'>".(string)($upper[count($upper)-2])."</font>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<font size='10'>".(string)($lower[count($lower)-2])."</font>";;
	echo "<br>";
	echo "<font size='10'>".($line_old)."</font>";
	echo "<br>";
	echo "<font size='10'>".($line)."</font>";
	echo "<br>";
    echo "<font size='10'>".($line[3])."</font>";
    echo "<br>";
	echo "<font size='10'>".($line_old[0])."</font>";
    echo "<br>";
    echo "<font size='10'>".($line_old1[0])."</font>";
    echo "<br>";
    echo "<br>";*/
    if ((int)$line[0] == 0){
		echo "<font color='green'size='120'>".(string)($string1[count($string1)-2])."</font>";
	}
    elseif ((int)$line_old[0] && (int)$line_old1[0] && (int)$line_old2[0] && (int)$line_old3[0]  && (int)$line_old4[0]  && (int)$line_old5[0]  && (int)$line_old6[0] && (int)$line_old7[0]  && (int)$line_old8[0]  && (int)$line_old9[0]  && (int)$line_old10[0] && (int)$line_old11[0] && (int)$line_old12[0] && (int)$line_old13[0]  && (int)$line_old14[0]  && (int)$line_old15[0]  && (int)$line_old16[0] && (int)$line_old17[0]  && (int)$line_old18[0]  && (int)$line_old19[0]  && (int)$line_old20[0] && (int)$line_old21[0] && (int)$line_old22[0] && (int)$line_old23[0] && (int)$line_old24[0] == 1)  
    {
		echo "<font color='red' size='120'>".(string)($string1[count($string1)-2])."</font>";
    }
    else{
        echo "<font color='orange' size='120'>".(string)($string1[count($string1)-2])."</font>";
    }
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    if ((int)$line[2] == 0){
		echo "<font color='green'size='120'>".(string)($string2[count($string2)-2])."</font>";
	}
    elseif ((int)$line_old[2] && (int)$line_old1[2] && (int)$line_old2[2] && (int)$line_old3[2]  && (int)$line_old4[2]  && (int)$line_old5[2]  && (int)$line_old6[2] && (int)$line_old7[2]  && (int)$line_old8[2]  && (int)$line_old9[2]  && (int)$line_old10[2] && (int)$line_old11[2] && (int)$line_old12[2] && (int)$line_old13[2]  && (int)$line_old14[2]  && (int)$line_old15[2]  && (int)$line_old16[2] && (int)$line_old17[2]  && (int)$line_old18[2]  && (int)$line_old19[2]  && (int)$line_old20[2] && (int)$line_old21[2] && (int)$line_old22[2] && (int)$line_old23[2] && (int)$line_old24[2] == 1)  
    {
		echo "<font color='red' size='120'>".(string)($string2[count($string2)-2])."</font>";
    }
    else{
        echo "<font color='orange' size='120'>".(string)($string2[count($string2)-2])."</font>";
    }
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    if ((int)$line[4] == 0){
		echo "<font color='green'size='120'>".(string)($string3[count($string3)-2])."</font>";
	}
    elseif ((int)$line_old[4] && (int)$line_old1[4] && (int)$line_old2[4] && (int)$line_old3[4]  && (int)$line_old4[4]  && (int)$line_old5[4]  && (int)$line_old6[4] && (int)$line_old7[4]  && (int)$line_old8[4]  && (int)$line_old9[4]  && (int)$line_old10[4] && (int)$line_old11[4] && (int)$line_old12[4] && (int)$line_old13[4]  && (int)$line_old14[4]  && (int)$line_old15[4]  && (int)$line_old16[4] && (int)$line_old17[4]  && (int)$line_old18[4]  && (int)$line_old19[4]  && (int)$line_old20[4] && (int)$line_old21[4] && (int)$line_old22[4] && (int)$line_old23[4] && (int)$line_old24[4] == 1)  
    {
		echo "<font color='red' size='120'>".(string)($string3[count($string3)-2])."</font>";
    }
    else{
        echo "<font color='orange' size='120'>".(string)($string3[count($string3)-2])."</font>";
    }
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    if ((int)$line[6] == 0){
		echo "<font color='green'size='120'>".(string)($string4[count($string4)-2])."</font>";
	}
    elseif ((int)$line_old[6] && (int)$line_old1[6] && (int)$line_old2[6] && (int)$line_old3[6]  && (int)$line_old4[6]  && (int)$line_old5[6]  && (int)$line_old6[6] && (int)$line_old7[6]  && (int)$line_old8[6]  && (int)$line_old9[6]  && (int)$line_old10[6] && (int)$line_old11[6] && (int)$line_old12[6] && (int)$line_old13[6]  && (int)$line_old14[6]  && (int)$line_old15[6]  && (int)$line_old16[6] && (int)$line_old17[6]  && (int)$line_old18[6]  && (int)$line_old19[6]  && (int)$line_old20[6] && (int)$line_old21[6] && (int)$line_old22[6] && (int)$line_old23[6] && (int)$line_old24[6] == 1)  
    {
		echo "<font color='red' size='120'>".(string)($string4[count($string4)-2])."</font>";
    }
    else{
        echo "<font color='orange' size='120'>".(string)($string4[count($string4)-2])."</font>";
    }
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<font size='10'>".(string)($upper[count($upper)-2])."</font>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<font size='10'>".(string)($lower[count($lower)-2])."</font>";;
	?>
<br>
<br>