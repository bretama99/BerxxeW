<script>
    function check_phone() {
        var mobilePhone = document.getElementById('mobilePhone').value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                var The_Response = xmlhttp.responseText;
                if (The_Response == 'Yes') {
                    document.getElementById("phone-message").innerHTML = "<span style='color:red; font-size:12px;'> &nbsp; Phone Number already exists  </span><br>";
                } else if (The_Response == 'No') {
                    document.getElementById("phone-message").innerHTML = "";
                }
            }
        };
        xmlhttp.open("GET", "homepage/signup/models/checkchosenphone.php?mobilePhone=" + mobilePhone, true);
        xmlhttp.send();
    }
</script>