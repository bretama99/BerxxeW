<?php
function encryptHash($content)
{
    include('cryptsalt.php');
    return hash("sha512", $salt . $content);
}
function integrityCheck($content, $hash)
{
    include('cryptsalt.php');
    return hash("sha512", $salt . $content) == $hash;
}

if (isset($_GET['contentForHash'])) {
    echo "lkjdflkdjf";
    $content = $_GET['contentForHash'];
    echo json_encode(encryptHash($content));
}


?>