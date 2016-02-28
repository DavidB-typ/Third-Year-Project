<?php
    require_once 'NeilLib.php';
    require_once 'shaneFunctions.php';
    generate_header("View Recording");
    generate_loginbox();
    view_recording('localhost', 'root', '', 'projectdb');
    generate_footer("View Recording");
?>
