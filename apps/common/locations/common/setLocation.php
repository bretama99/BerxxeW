<?php
session_start();
if (!empty($_POST['latitude']) && !empty($_POST['longitude'])) {
    $_SESSION['latitude'] = trim($_POST['latitude']);
    $_SESSION['longitude'] = trim($_POST['longitude']);
}
