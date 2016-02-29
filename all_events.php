<?php
    session_start();

/**
 * all_events.php
 * Browse all events that are on soon
 * 
 * @author Neil Cronin neilc5867@gmail.com
 */
    require_once 'NeilLib.php';
    require_once 'shaneFunctions.php';
    //require_once 'DavidLib.php';
    generate_header("All Events");
        echo "<h1>username is {$_SESSION['username']}</h1>";
    
    begin_section("All Events");

    //upcoming events   
    browse_future_events('localhost', 'root', '', 'projectdb');
    
    //past events
    browse_past_events('localhost', 'root', '', 'projectdb');
    
    //events this week
    events_this_week('localhost', 'root', '', 'projectdb');
    

    
    
    end_section();
    generate_loginbox();
    generate_footer("All Events");

?>