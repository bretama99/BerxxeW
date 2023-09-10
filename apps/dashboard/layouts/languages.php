<?php
if (isset($_COOKIE['lang'])) {
    $selected_lang = $_COOKIE['lang'];
} else {
    $selected_lang = 'english';
}
$lang_all = json_decode(file_get_contents("../../i18n/" . $selected_lang . ".json"), true);
$lang = $lang_all[$selected_lang];
?>
<select id="language" onchange="setLaguage()" value="6" style="margin-top:8px;">
    <?php
    if (isset($_COOKIE['lang'])) {
        $lan = $_COOKIE['lang'];
        $lanName = $lang[$lan];
    }
    ?>

    <?php if (isset($_COOKIE['lang'])) { ?>
        <option value="<?php echo $lan; ?>"><?php echo $lanName; ?></option>
    <?php } ?>
    <?php if (isset($_COOKIE['lang'])) {
        if ($_COOKIE['lang'] != "english") { ?>
            <option value="english">English</option>
        <?php }
    } ?>
    <?php if (isset($_COOKIE['lang'])) {
        if ($_COOKIE['lang'] != "amharic") { ?>
            <option value="amharic">ኣማርኛ</option>
        <?php }
    } ?>
    <?php if (isset($_COOKIE['lang'])) {
        if ($_COOKIE['lang'] != "tigrigna") { ?>
            <option value="tigrigna">ትግርኛ</option>
        <?php }
    } ?>

    <?php if (!isset($_COOKIE['lang'])) { ?>
        <option value="english">English</option>
        <option value="amharic">ኣማርኛ</option>
        <option value="tigrigna">ትግርኛ</option>
    <?php } ?>

</select>
<script>
    function setLaguage() {
        var cookieVariable = "lang";
        var cookieVarValue = document.getElementById("language").value;

        var d = new Date();
        d.setTime(d.getTime() + (60 * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cookieVariable + "=" + cookieVarValue + "; " + expires;
        window.location.reload();
    }
</script>