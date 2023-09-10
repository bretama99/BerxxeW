<script>
 function display_states(countryId,state) {
	function removeOptions(selectbox)
		{
			var i;
			for(i = selectbox.options.length -1  ; i >= 0 ; i--)
			{
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
			var count=0;
			var Display="";
			for(index in states) {
				var split = states[index].split("_");
				var stateId = split[0];
				var stateName = split[1];
				count=count+1;
				
				select.options[select.options.length] = new Option(stateName, stateId);			 
			}
			
		}
	};
	xmlhttp.open("GET", "configurations/addresses/models/selectedstates.php?countryId=" + countryId, true);
	xmlhttp.send();
}
 
function display_zones(stateId,zone) {
	function removeOptions(selectbox)
		{
			var i;
			for(i = selectbox.options.length -1  ; i >= 0 ; i--)
			{
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
			var count=0;
			var Display="";
			for(index in zones) {
				var split = zones[index].split("_");
				var zoneId = split[0];
				var zoneName = split[1];
				count=count+1;
				select.options[select.options.length] = new Option(zoneName, zoneId);
			}
		}
	};
	xmlhttp.open("GET", "configurations/addresses/models/selectedzones.php?stateId=" + stateId, true);
	xmlhttp.send();
}

function display_woredas(zoneId,woreda) {
	function removeOptions(selectbox)
		{
			var i;
			for(i = selectbox.options.length -1  ; i >= 0 ; i--)
			{
				selectbox.remove(i);
			}
		}
		removeOptions(document.getElementById(woreda));
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		   
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var All = xmlhttp.responseText;
			var weredas = All.split(",");
			var select = document.getElementById(woreda);
			select.options[select.options.length] = new Option('', '');
			var count=0;
			var Display="";
			for(index in weredas) {
				var split = weredas[index].split("_");
				var weredaId = split[0];
				var weredaName = split[1];
				count=count+1;
				select.options[select.options.length] = new Option(weredaName, weredaId);
			}
		}
	};
	xmlhttp.open("GET", "configurations/addresses/models/selectedworedas.php?zoneId=" + zoneId, true);
	xmlhttp.send();
}
</script>
