<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Traffic Lights</title>

	<style type="text/css">
		.dot {
			height: 50px;
			width: 50px;
			background-color: #bbb;
			border-radius: 50%;
			display: inline-block;
		}
	</style>
</head>
<body>
<div style="text-align:center">
  <h4>Signal A</h4>
  <span class="dot signalA"></span>
  <h4>Signal B</h4>
  <span class="dot signalB"></span>
  <h4>Signal C</h4>
  <span class="dot signalC"></span>
  <h4>Signal D</h4>
  <span class="dot signalD"></span>
</div>
<form id="trafficform" method="post">
	<h3>Priority</h3>
	<input type="text" id="signalA" name="signalA" placeholder="Signal A">
	<input type="text" id="signalB" name="signalB" placeholder="Signal B">
	<input type="text" id="signalC" name="signalC" placeholder="Signal C">
	<input type="text" id="signalD" name="signalD" placeholder="Signal D">
	<br><br>
	<input type="text" id="greentime" name="greentime" placeholder="Green Signal Time(In Second)">
	<input type="text" id="yellowtime" name="yellowtime" placeholder="Yellow Signal Time(In Second)">
	<button type="submit" id="submit" name="submit">Save</button>
	<div style="color: green;font-size: xx-large;" id='successmsg'></div>
</form>
<center><button type="submit" id="start" name="submit">start</button></center> <br><br>
<center><button type="submit" id="stop" name="submit">stop</button></center>


</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/validate.js"></script>


<script>
	$(document).ready(function(){
		var intervalId;
		$("#trafficform").validate({
			rules: {
				signalA: {
					required: true,
					digits: true
				},
				signalB: {
					required: true,
					digits: true
				},
				signalC: {
					required: true,
					digits: true
				},
				signalD: {
					required: true,
					digits: true
				},
				greentime: {
					required: true,
					digits: true
				},
				yellowtime: {
					required: true,
					digits: true
				}
			}
		});
	});

	$.validator.setDefaults({
		submitHandler: function() {
			submitfun();
		}
	})
	function submitfun(){
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url() ?>index.php/Welcome/savepriority',
			type: "POST",
			async:false,
			data: $('#trafficform').serialize(),
			success: function(msg){
				var responce = $.parseJSON(msg);
				rtnstatus = responce.status;
				if(rtnstatus){
					$("#successmsg").html(responce.msg)
				}else{
					alert(responce.msg);
				}
			},
			error: function(){
				alert("AJAX Failed!!!");
			}
  		});
	}

	$("#start").click(function(){
		$.ajax({
			url: '<?php echo base_url() ?>index.php/Welcome/getpriority',
			type: "POST",
			async:false,
			success: function(msg){
				var responce = $.parseJSON(msg);
				rtnstatus = responce.status;
				if(rtnstatus){
						console.log("Values => ",responce.values);
						console.log("Values Length => ",responce.values.length);
						Timerstart(responce.values);
				}
			},
			error: function(){
				alert("GET AJAX Failed!!!");
			}
  		});
	});

	function Timerstart(data){
		var greenlight = data[0].greenlight *1000;
		//GreenLights(data,0);
		var count = 0;  
	  var maxCount = data.length;
    intervalId = setInterval(function() {  
      if (count < maxCount) {  
          GreenLights(data,count); // Call the function  
          count++; // Increment the counter  
      } else {  
          clearInterval(intervalId); // Clear the interval when max count is reached  
          console.log("Stopped calling the function after " + maxCount + " times.");  
      }  
  	}, greenlight); // Cal

	}
	function GreenLights(data,count)
	{
			var signaldata = data[count];
			var greenlight = data[0].greenlight *1000;
			var yellowlight = data[0].yellowlight *1000;
			var yellow = parseInt(greenlight)+ parseInt(yellowlight);

			if(count == 0){
				$('.signal'+signaldata.signals).css('background-color',"green");
				$('.signal'+data[1].signals).css('background-color',"red");
				$('.signal'+data[2].signals).css('background-color',"red");
				$('.signal'+data[3].signals).css('background-color',"red");
			}
			if(count == 1){
				$('.signal'+signaldata.signals).css('background-color',"green");
				$('.signal'+data[0].signals).css('background-color',"red");
				$('.signal'+data[2].signals).css('background-color',"red");
				$('.signal'+data[3].signals).css('background-color',"red");
			}
			if(count == 2){
				$('.signal'+signaldata.signals).css('background-color',"green");
				$('.signal'+data[1].signals).css('background-color',"red");
				$('.signal'+data[0].signals).css('background-color',"red");
				$('.signal'+data[3].signals).css('background-color',"red");
			}
			if(count == 3){
				$('.signal'+signaldata.signals).css('background-color',"green");
				$('.signal'+data[1].signals).css('background-color',"red");
				$('.signal'+data[2].signals).css('background-color',"red");
				$('.signal'+data[0].signals).css('background-color',"red");
			}
			console.log("greenlight => ",greenlight);
			setTimeout(function() {
				$('.signal'+signaldata.signals).css('background-color',"yellow");
      }, greenlight);
      console.log("yellow => ",yellow);
      setTimeout(function() {
				$('.signal'+signaldata.signals).css('background-color',"red");
      }, yellow);

			console.log("count => ",signaldata.signals);
	}
	$("#stop").click(function(){
		clearInterval(intervalId);
		alert("Stopped");
	});
</script>