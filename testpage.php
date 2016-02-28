<?php
 require_once 'NeilLib.php';
 require_once 'shaneFunctions.php';
 
    generate_header("testpage");
    generate_loginbox();
    begin_section("This is a test");
    echo "<p>Shane loves willies</p>";
    make_picture("assets/img/other/wat.jpg", "PHP makes my face go like this");
    
    generate_footer("testpage");
?>
