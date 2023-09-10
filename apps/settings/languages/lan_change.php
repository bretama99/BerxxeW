<?php 
if(isset($_GET['language'])){
  $language = $_GET['language'];
  setcookie("language", $language, time()+(5*365 * 24 * 60 * 60));
  
       header("location:$language");
		
}
?>