<script>
  function check_username() {
	    var userName=document.getElementById('userName').value;
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {	
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							 
				var The_Response = xmlhttp.responseText;
				if(The_Response=='Yes')
				{
				 document.getElementById("message_username").innerHTML = "<span style='color:red; font-size:12px;'> &nbsp; UserName already exists </span><br>"; 			 
				}
				else if(The_Response=='No')
				{
				 document.getElementById("message_username").innerHTML = "";
				}
			}
		};
		xmlhttp.open("GET", "homepage/signup/models/checkchosenusername.php?userName=" + userName, true);
		xmlhttp.send();
	}
</script>