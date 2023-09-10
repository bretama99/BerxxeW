<?php
error_reporting(0);
ignore_user_abort(true);
set_time_limit(0); // disable the time limit for this script

$folder = $_GET['folder'];

$path = '../../../../../files/' . $folder . '/'; // change the path to fit your websites document structure
$dl_file = preg_replace("([^\w\s\d\-_~,;:\[\]\(\].]|[\.]{2,})", '', $_GET['download_file']); // simple file name validation
$dl_file = filter_var($dl_file, FILTER_SANITIZE_URL); // Remove (more) invalid characters
$fullPath = $path . $dl_file;

if ($fd = fopen($fullPath, "r")) {
    $fsize = filesize($fullPath);
    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);
    switch ($ext) {
        case "pdf":
            header("Content-length: $fsize");
            header("Content-type: application/pdf");
            header("Cache-control: private"); //use this to open files directly
            while (!feof($fd)) {
                $buffer = fread($fd, 2048);
                echo $buffer;
            }
            break;
            // add more headers for other content types here
        default;
            header("Content-length: $fsize");
            header('Content-Type: image/jpeg');
            header("Cache-control: private"); //use this to open files directly
            while (!feof($fd)) {
                $buffer = fread($fd, 2048);
                echo $buffer;
            }
    }
} else {
    echo "path not found";
}
fclose($fd);
exit;
