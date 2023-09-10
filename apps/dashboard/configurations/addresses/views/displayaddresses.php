<script>
	function display_states(countryId, countryName, state) {
		function removeOptions(selectbox) {
			var i;
			for (i = selectbox.options.length - 1; i >= 0; i--) {
				selectbox.remove(i);
			}
		}
		removeOptions(document.getElementById(state));

		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var All = xmlhttp.responseText;
				var states = All.split(",");
				var select = document.getElementById(state);
				select.options[select.options.length] = new Option('', '');
				var count = 0;
				var Display = "";
				document.getElementById('th1').innerHTML = "State Name";
				document.getElementById('addButton').innerHTML = "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#add_state'> <i class='ace-icon fa fa-plus'></i>&nbsp;Add New State</button>";
				for (index in states) {
					var split = states[index].split("_");
					var stateId = split[0];
					var stateName = split[1];
					count = count + 1;
					var Display = Display + "<tr><td>" + count + "</td><td>" + stateName + "</td><td><a href='#' class='green'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i> </a> <a href='#' class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i> </a> </td></tr> ";

					select.options[select.options.length] = new Option(stateName, stateId);
				}
				document.getElementById('countryId').innerHTML = "<option value='" + countryId + "'>" + countryName + "</option>";
				document.getElementById('country').innerHTML = "<option value='" + countryId + "'>" + countryName + "</option>";
				document.getElementById('country2').innerHTML = "<option value='" + countryId + "'>" + countryName + "</option>";
				if (All.length > 0) {
					document.getElementById('tableBody').innerHTML = Display;
					//document.getElementById('countryId').innerHTML = "<option value='" + countryId + "'>" + countryName + "</option>";
					//document.getElementById('country').innerHTML = "<option value='" + countryId + "'>" + countryName + "</option>";
					//document.getElementById('country2').innerHTML = "<option value='" + countryId + "'>" + countryName + "</option>";
				} else {
					document.getElementById('tableBody').innerHTML = "<tr>" + "<td><b>No states on the selected country</b></td>" + "<tr>";
				}
			}

		};
		xmlhttp.open("GET", "configurations/addresses/models/selectedstates.php?countryId=" + countryId, true);
		xmlhttp.send();
	}

	function display_zones(stateId, stateName, zone) {
		function removeOptions(selectbox) {
			var i;
			for (i = selectbox.options.length - 1; i >= 0; i--) {
				selectbox.remove(i);
			}
		}
		removeOptions(document.getElementById(zone));

		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {

			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var All = xmlhttp.responseText;

				var zones = All.split(",");
				var select = document.getElementById(zone);
				select.options[select.options.length] = new Option('', '');
				var count = 0;
				var Display = "";
				document.getElementById('th1').innerHTML = "Zone Name";
				document.getElementById('addButton').innerHTML = "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#add_zone'> <i class='ace-icon fa fa-plus'></i>&nbsp;Add New Zone</button>";
				for (index in zones) {
					var split = zones[index].split("_");
					var zoneId = split[0];
					var zoneName = split[1];
					count = count + 1;
					var Display = Display + "<tr><td>" + count + "</td><td>" + zoneName + "</td><td><a href='#' class='green'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i> </a> <a href='#' class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i> </a> </td></tr> ";
					select.options[select.options.length] = new Option(zoneName, zoneId);
				}

				document.getElementById('statem').innerHTML = "<option value='" + stateId + "'>" + stateName + "</option>";
				document.getElementById('statem2').innerHTML = "<option value='" + stateId + "'>" + stateName + "</option>";

				if (All.length > 0) {
					document.getElementById('tableBody').innerHTML = Display;
					//document.getElementById('statem').innerHTML = "<option value='" + stateId + "'>" + stateName + "</option>";
					//document.getElementById('statem2').innerHTML = "<option value='" + stateId + "'>" + stateName + "</option>";
				} else {

					document.getElementById('tableBody').innerHTML = "<tr>" + "<td><b>No zones on the selected state</b></td>" + "<tr>";
				}
			}
		};
		xmlhttp.open("GET", "configurations/addresses/models/selectedzones.php?stateId=" + stateId, true);
		xmlhttp.send();
	}



	function display_woredas(zoneId, zoneName, woreda) {


		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var All = xmlhttp.responseText;

				var woredas = All.split(",");

				var count = 0;
				var Display = "";
				document.getElementById('th1').innerHTML = "Woreda Name";
				document.getElementById('addButton').innerHTML = "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#add_woreda'> <i class='ace-icon fa fa-plus'></i>&nbsp;Add New Woreda</button>";
				for (index in woredas) {
					var split = woredas[index].split("_");
					var woredaId = split[0];
					var woredaName = split[1];
					count = count + 1;
					var Display = Display + "<tr><td>" + count + "</td><td>" + woredaName + "</td><td><a href='#' class='green'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i> </a> <a href='#' class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i> </a> </td></tr> ";

				}

				document.getElementById('zonem').innerHTML = "<option value='" + zoneId + "'>" + zoneName + "</option>";
				if (All.length > 0) {
					document.getElementById('tableBody').innerHTML = Display;
					//document.getElementById('zonem').innerHTML = "<option value='" + zoneId + "'>" + zoneName + "</option>";
				} else {
					document.getElementById('tableBody').innerHTML = "<tr>" + "<td><b>No woredas on the selected zone</b></td>" + "<tr>";
				}
			}
		};
		xmlhttp.open("GET", "configurations/addresses/models/selectedworedas.php?zoneId=" + zoneId, true);
		xmlhttp.send();
	}
</script>
