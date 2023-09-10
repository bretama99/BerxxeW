<?php
?>
<script src="../js/jquery-1.10.2.min.js"></script>
<script>
    $(document).ready(function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showLocation);
        } else {
            $('#location').html('Geolocation is not supported by this browser.');
        }
    });

    function showLocation(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        $.ajax({
            type: 'POST',
            url: 'common/locations/common/setLocation.php',
            data: 'latitude=' + latitude + '&longitude=' + longitude,
            success: function(msg) {
                if (msg) {
                    $("#location").html(msg);
                } else {
                    $("#location").html('Not Available');
                }
            }
        });
    }
</script>