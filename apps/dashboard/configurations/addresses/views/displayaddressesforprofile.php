<script>
    function display_states_pro(countryId, statem) {
        function removeOptions(selectbox) {
            var i;
            for (i = selectbox.options.length - 1; i >= 0; i--) {
                selectbox.remove(i);
            }
        }
        removeOptions(document.getElementById(statem));

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var All = xmlhttp.responseText;
                var states = All.split(",");
                var select = document.getElementById(statem);
                select.options[select.options.length] = new Option('', '');

                for (index in states) {
                    var split = states[index].split("_");
                    var stateId = split[0];
                    var stateName = split[1];

                    select.options[select.options.length] = new Option(stateName, stateId);
                }
            }
        };
        xmlhttp.open("GET", "configurations/addresses/models/selectedstates.php?countryId=" + countryId, true);
        xmlhttp.send();
    }

    function display_zones_pro(stateId, zonem) {
        function removeOptions(selectbox) {
            var i;
            for (i = selectbox.options.length - 1; i >= 0; i--) {
                selectbox.remove(i);
            }
        }
        removeOptions(document.getElementById(zonem));

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {

            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var All = xmlhttp.responseText;
                var zones = All.split(",");
                var select = document.getElementById(zonem);
                select.options[select.options.length] = new Option('', '');

                for (index in zones) {
                    var split = zones[index].split("_");
                    var zoneId = split[0];
                    var zoneName = split[1];

                    select.options[select.options.length] = new Option(zoneName, zoneId);
                }
            }
        };
        xmlhttp.open("GET", "configurations/addresses/models/selectedzones.php?stateId=" + stateId, true);
        xmlhttp.send();
    }

    function display_woredas_pro(zoneId, woredam) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {

            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var All = xmlhttp.responseText;
                var woredas = All.split(",");
                var select = document.getElementById(woredam);
                select.options[select.options.length] = new Option('', '');

                for (index in woredas) {
                    var split = woredas[index].split("_");
                    var woredaId = split[0];
                    var woredaName = split[1];

                    select.options[select.options.length] = new Option(woredaName, woredaId);
                }
            }
        };
        xmlhttp.open("GET", "configurations/addresses/models/selectedworedas.php?zoneId=" + zoneId, true);
        xmlhttp.send();
    }
</script>