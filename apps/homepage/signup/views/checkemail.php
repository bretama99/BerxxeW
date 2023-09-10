<script>
  function check_email() {
	    var email=document.getElementById('email').value;
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {	
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							 
				var The_Response = xmlhttp.responseText;
				if(The_Response=='Yes')
				{
				 document.getElementById("message").innerHTML = "<span style='color:red; font-size:12px;'> &nbsp; email already exists  </span><br>"; 
				}
				else if(The_Response=='No')
				{
				 document.getElementById("message").innerHTML = "";
				}
			}
		};
		xmlhttp.open("GET", "homepage/signup/models/checkchosenemail.php?email=" + email, true);
		xmlhttp.send();
	}
</script>