<!DOCTYPE html> 

<html>
  <head> 
  	<!-- 	http://www.featureblend.com/javascript-flash-detection-library.html -->
 		<script src="http://northbridgetech.org/dev/nexus/view/script/flash_detect.js"></script>
 		<link rel="stylesheet" type="text/css" href="http://northbridgetech.org/dev/nexus/view/style/style.css" />
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
 		
 		<!-- 
 		This script is calculating download speed relative to the northbridge web server (not the conference server but that is a TODO) 
 		Once the speed is calculate it rewrites the html with the calculate value. That happens inside the showResults() function.
 		-->
 		<script>
 			var imageAddr = "http://northbridgetech.org/dev/nexus/control/ookla-speedtest-mini/speedtest/random2000x2000.jpg"; 
			var downloadSize = 7610179; //image sized in Bytes
	
			window.onload = function() {
    		var oProgress = document.getElementById("progress");
    		oProgress.innerHTML = "Checking... <span class='fa fa-spinner fa-spin fa-2x'></span>";
    		window.setTimeout(MeasureConnectionSpeed, 1);
			};
			
			function MeasureConnectionSpeed() {
		    var oProgress = document.getElementById("progress");
    		var startTime, endTime;
    		var download = new Image();
    		download.onload = function () {
	        endTime = (new Date()).getTime();
        	showResults();
    		}
	    
	    	download.onerror = function (err, msg) {
	        oProgress.innerHTML = "Error checking download speed.";
  	  	}
	    
    		startTime = (new Date()).getTime();
    		var cacheBuster = "?nnn=" + startTime;
    		download.src = imageAddr + cacheBuster;
	    
    		function showResults() {
	        var duration = (endTime - startTime) / 1000;
        	var bitsLoaded = downloadSize * 8;
        	var speedBps = (bitsLoaded / duration).toFixed(2);
        	var speedKbps = (speedBps / 1024).toFixed(2);
        	var speedMbps = (speedKbps / 1024).toFixed(0);
        	oProgress.innerHTML = "Your download speed is approx. " + speedMbps + " Mbps";
           	//speedBps + " bps<br />"   + 
           	//speedKbps + " kbps<br />" + 
           	//speedMbps + " Mbps<br />";
          if (speedMbps > 2) {
          	document.getElementById("download_speed").src =  "http://northbridgetech.org/dev/nexus/view/image/light_green.png"; 
          } else {
          	document.getElementById("download_speed").src =  "http://northbridgetech.org/dev/nexus/view/image/light_red.png";
          } 
    		}
			}
		</script>
		<!-- End download calculation script -->

		<!-- Insert and upload speed check here, maybe similar to above? -->
		
		
		<!-- End upload calculation script -->
		
  </head>
 
	<body>
	
 			<table style="font-size:12px;width:350px;" cellpadding="5">
		 		<tr><td bgcolor="#eeeeee" valign="top" style="text-align: left;"><b>System&nbsp;Component</b><br/>&nbsp;</td><td valign="top" style="text-align: left;"><b>Your&nbsp;Status</b><br/></td><td valign="top" style="text-align: left;"><b>Details</b></td></tr>
 				<tr><td bgcolor="#eeeeee" valign="top" style="text-align: left;">Javascript</td><td valign="top" style="text-align: left "><img id="jscript_enabled" src="image/light_red.png" /></td><td valign="top" style="text-align: left;"><p id="jscript_version"></p></td></tr>
 				<tr><td bgcolor="#eeeeee" valign="top" style="text-align: left;">Flash</td><td valign="top" style="text-align: left "><img id="flash_enabled" src="" /></td><td valign="top" style="text-align: left;"><p id="flash_version"></p></td></tr>
 				<tr><td bgcolor="#eeeeee" valign="top" style="text-align: left;">Download&nbsp;Speed</td valign="top" style="text-align: left "><td valign="top" style="text-align: left;"><img id="download_speed" src="http://northbridgetech.org/dev/nexus/view/image/light_white.png" /></td><td valign="top" style="text-align: left "><p id="progress"></p></td></tr>
 				<tr><td bgcolor="#eeeeee" valign="top" style="text-align: left;">Upload&nbsp;Speed</td valign="top" style="text-align: left "><td valign="top" style="text-align: left;"><img id="upload_speed" src="http://northbridgetech.org/dev/nexus/view/image/light_white.png" /></td><td valign="top" style="text-align: left ">TODO</p></td></tr>
 				<tr>
 					<td bgcolor="#eeeeee" valign="top">Your&nbsp;Media&nbsp;Options</td><td colspan="2">
 						<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
        			width="400"
   					  height="300"
    					id="haxe"
    					align="middle">
							<param name="movie" value="hello.swf"/>
							<param name="allowScriptAccess" value="always" />
							<param name="quality" value="high" />
							<param name="scale" value="noscale" />
							<param name="salign" value="lt" />
							<param name="bgcolor" value="#ffffff"/>
							<embed src="hello.swf"
       					bgcolor="#ffffff"
      					width="400"
       					height="300"
       					name="haxe"
       					quality="high"
       					align="middle"
       					allowScriptAccess="always"
       					type="application/x-shockwave-flash"
       					pluginspage="http://www.macromedia.com/go/getflashplayer"
							/>
						</object>
 					</td></tr>
 			</table>
 			
<script>
	// Check for Javascript
  document.getElementById("jscript_enabled").src = "http://northbridgetech.org/dev/nexus/view/image/light_green.png";
  document.getElementById("jscript_version").innerHTML = "You have enabled Javascript.";
</script>

<script> 
	// Check for Flash 
 	if(FlashDetect.installed && FlashDetect.versionAtLeast(11,2)) {
      document.getElementById("flash_enabled").src = "http://northbridgetech.org/dev/nexus/view/image/light_green.png";         
  } else {
   		document.getElementById("flash_enabled").src = "http://northbridgetech.org/dev/nexus/view/image/light_red.png";
  }
  
 	if(FlashDetect.installed) {
      document.getElementById("flash_version").innerHTML = "You are running Flash version " + FlashDetect.major + "." + FlashDetect.minor;         
  } else {
   		document.getElementById("flash_version").innerHTML = "You do not have Flash installed in this browser.";
  }
</script>	

	</body>	
</html>