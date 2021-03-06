function toggleDisplay(elementId) {
  hideAll();
  showSelected(elementId);
} 

function showSelected(elementId) {
	var textElement = document.getElementById(elementId);
  textElement.style.display = 'block';
}

function hideAll() {
  document.getElementById('default').style.display = 'none';
  document.getElementById('detail').style.display = 'none';
  //document.getElementById('default').style.display = 'none';
  //document.getElementById('reply').style.display = 'none';
}

function popup(mylink, windowname) {
	if (! window.focus) return true;
	var href;
	if (typeof(mylink) == 'string') {
   	href=mylink;
   } else {
   	href=mylink.href;
   }
	window.open(href, windowname, 'width=600,height=400,scrollbars=yes');
	return false;
}

/*
Written by Matthew Harvey (matt AT unlikelywords DOT com)
(http://www.unlikelywords.com/html-morsels/)
Distributed under the Creative Commons 
"Attribution-NonCommercial-ShareAlike 2.0" License
(http://creativecommons.org/licenses/by-nc-sa/2.0/)
*/
function drawPercentBar(width, percent, color, background) { 
  var pixels = width * (percent / 100); 
  if (!background) { background = "none"; }

  document.write("<div style=\"position: relative; line-height: 1em; background-color: " 
                 + background + "; border: 1px solid black; width: " 
                 + width + "px\">"); 
  document.write("<div style=\"height: 1.5em; width: " + pixels + "px; background-color: "
                 + color + ";\"></div>"); 
  document.write("<div style=\"position: absolute; text-align: center; padding-top: .25em; width: " 
                 + width + "px; top: 0; left: 0\">" + percent + "%</div>"); 

  document.write("</div>"); 
} 

function currentTime() {
	var currentTime = new Date()
	var month = currentTime.getMonth()+1
	var date = currentTime.getDate()
	var hours = currentTime.getHours()
	var minutes = currentTime.getMinutes()

	if (minutes < 10) {
		minutes = "0" + minutes
	}
	
	var suffix = "AM";
	if (hours >= 12) {
		suffix = "PM";
		hours = hours - 12;
	}
	if (hours == 0) {
		hours = 12;
	}
	document.write("<b>" + month + "/" + date + "</b>")
}

function post(to, p) {
  var myForm = document.createElement("form");
  myForm.method="post" ;
  myForm.action = to ;
  for (var k in p) {
    var myInput = document.createElement("input") ;
    myInput.setAttribute("name", k) ;
    myInput.setAttribute("value", p[k]);
    myForm.appendChild(myInput) ;
  }
  document.body.appendChild(myForm) ;
  myForm.submit() ;
  document.body.removeChild(myForm) ;
}

function test() {
		alert("test from script.js");
}

function displayTeamProfile() {
	document.getElementById("demo").innerHTML=Date();
}

function toggle(showHideDiv, switchImgTag) {
 	var ele = document.getElementById(showHideDiv);
   var imageEle = document.getElementById(switchImgTag);
   if(ele.style.display == "block") {
   	ele.style.display = "none";
		imageEle.innerHTML = '<img style="margin:5px;" src="images/plus.png" height="15" width="15" />';
   }
   else {
    ele.style.display = "block";
     imageEle.innerHTML = '<img style="margin:5px;" src="images/minus.png" height="15" width="15" />';
   }
}

function toggleChat(showHideDiv) {
 	var ele = document.getElementById(showHideDiv);
  if(ele.style.display == "block") {
   	ele.style.display = "none";
   }
   else {
    ele.style.display = "block";
   }
}

function messageToFill() {
	var y=document.getElementById("toDisplay");
	var names = document.forms['messageForm'].elements['names[]'];
	var toNames = "";
	var checkedCount = 0;
	for (var i=0, len=names.length; i<len; i++) {
    toNames = toNames + (names[i].checked ? (names[i].value + ", ") : ""); 
    if (names[i].checked) {checkedCount++;}
	}
	if (i == 0) {
		// We have only one input, not a list so above loop will return nothing
		toNames = names.checked ? (names.value + ", ") : "";
	}
	var trim1 = toNames.replace(/(, $)/g, "") // remove trailing comma
	var trim2 = trim1.replace(/([0-9]*::)/g, "") // remove embedded user id
	if (checkedCount > 3) {
		y.innerHTML=checkedCount + " recipients";
	} else {
		y.innerHTML=trim2;
	}
	
	if (trim2.length < 1) {
		document.getElementById("messageSendSubmit").disabled = true;
		y.innerHTML="Select recipients from right";
	} else {
		document.getElementById("messageSendSubmit").disabled = false;
	}

}

function checkAll(namesClass) {
	var names = document.getElementsByClassName(namesClass);
	for (var i=0, len=names.length; i<len; i++) {
		names[i].checked = true;
	}	
	messageToFill();
}

function uncheckAll(namesClass) {
	var names = document.getElementsByClassName(namesClass);
	for (var i=0, len=names.length; i<len; i++) {
		names[i].checked = false;
	}	
	messageToFill();
}

function disableTestMessageLink() {
   var link=document.getElementById("testMessageLink");
   link.style.color="#c9c9a7";
   link.setAttribute("href", "#");
   link.innerHTML = 'To test, save your changes';
}

function hasGetUserMedia() {
		return !!(navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);
}
		
function checkAudio() {
	if (hasGetUserMedia()) {
		navigator.getUserMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);
  	if (navigator.getUserMedia) {
     	navigator.getUserMedia( {video:false,audio:true}, 
     	
     			function(stream) { 
     				document.getElementById("audio_enabled").src = "image/light_green.png";
     			}, 
     			
     			function(error) { 
    			if (error == "PERMISSION_DENIED" || error.name == "PermissionDeniedError") {
     				document.getElementById("audio_enabled").src = "image/light_green.png";
    			} else {
     				document.getElementById("audio_enabled").src = "image/light_red.png";
    			}
    		});
  		} else {
  		}
 		} else { 
 			document.getElementById("audio_enabled").src = "image/light_red.png";
		}	

	document.getElementById("audioButton").innerHTML = "Re-Check";
}

function checkVideo() {
	if (hasGetUserMedia()) {
		navigator.getUserMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);
  	if (navigator.getUserMedia) {
     	navigator.getUserMedia( {video:true,audio:false}, 
     	
     			function(stream) { 
     				document.getElementById("video_enabled").src = "image/light_green.png";
     			}, 
     			
     			function(error) { 
    			if (error == "PERMISSION_DENIED" || error.name == "PermissionDeniedError") {
     				document.getElementById("video_enabled").src = "image/light_green.png";
    			} else {
     				document.getElementById("video_enabled").src = "image/light_red.png";
    			}
    		});
  		} else {
  		}
 		} else { 
 			document.getElementById("video_enabled").src = "image/light_red.png";
		}	

	document.getElementById("videoButton").innerHTML = "Re-Check";
}
	
function showUser(str) {
	
	showWait();

  if (str=="") {
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("light_userprofile").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","profileLightbox.php?id="+str,true);
  xmlhttp.send();
  
  document.getElementById('light_userprofile').style.display='block';
  document.getElementById('fade').style.display='block';

}

function showWait() {
	document.getElementById("light_userprofile").innerHTML="<a href=\"javascript:void(0)\" onclick=\"document.getElementById('light_userprofile').style.display='none';document.getElementById('fade').style.display='none'\" style=\"float:right\">Close</a><p>One moment please...</p><hr/>";
}

function countChars() {
     var l = "1000";
     var str = document.getElementById("messagearea").value;
     var len = str.length;
     if(len <= l) {
          document.getElementById("txtLen").value=l-len;
     } else {
          //document.getElementById("textArea").value=str.substr(0, 140);
     }
}

