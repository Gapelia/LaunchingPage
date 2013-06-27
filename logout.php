<?php
    setcookie("gapKey", '', time()-3600, "/");
    //setcookie("fbs_" . $app_id, '', time()-3600, "/", ".gapelia.com");
    header("Location: http://www.gapelia.com/");
?>
