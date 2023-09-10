<script>
	function searchaccount() {
		var email = document.getElementById('email').value;
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

				var The_Response = xmlhttp.responseText;
				if (The_Response == 'No') {
					document.getElementById("message").innerHTML = "<span style='color:red; font-size:16px;'> &nbsp; Account Not Found  </span><br>";
				}
				else {
					var usersId = The_Response;
					document.getElementById("message").innerHTML = "<div class='col-sm-12 col-sm-12 col-sm-12'> <form action='' method='post'> Send code via email: " + email + "   <input type='hidden' name='email' value='" + email + "'> <input type='hidden' name='usersId' value='" + usersId + "'> <input type='submit' name='send_mail' value='Continue' class='btn btn-skin btn-block btn-sm'></form></div><br>";
				}

			}
		};
		xmlhttp.open("GET", "homepage/password/models/checksearchedemail.php?email=" + email, true);
		xmlhttp.send();
	}
</script>