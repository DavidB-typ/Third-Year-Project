<?php

/**
 * NeilLib.php
 * Library for all Neil Cronin's php functions.
 * revised often so make sure your copy is up to date
 *
 * FOR THE LOVE OF GOD COMMENT YOUR STUFF
 *
 * 
 *
 *  
 */
//constants for database connection
$DBURL = 'localhost';
$DBUser = 'root';
$DBPassword = '';
$DB = 'projectdb';

/**
 * get_events_this_week
 * 
 * Retrieve all events happening within the next 7 days.
 * Another copy of pastevents with params swapped around 
 * @author Neil Cronin neilc5867@gmail.com
 *   
 * @param DBURL the url of the database to be used
 * @param DBUser the username for the database
 * @param DBPassword the password for the database
 * @param DB the database to be connected to
 */

function events_this_week($DBURL, $DBUser, $DBPassword, $DB)
{
//offset and limit are sent as get info
    $limit = 10;
    $offset = 0;
    if (!isset($_GET['pastoffset'])) {
        $offset = 0;
    } else {
        $offset = $_GET['pastoffset'];
        if ($offset < 0) {
            $offset = 0;
        }
    }
    
    $connection = mysqli_connect($DBURL, $DBUser, $DBPassword, $DB);
    if (!$connection) {
        die('Connection Error (' . mysqli_connect_errno() . ') Check your function inputs. ' . mysqli_connect_error());
    }
    mysqli_set_charset($connection, 'utf-8');
    $checkSizeSQL = "SELECT count(*) AS total FROM events";
    $sizeResult = mysqli_query($connection, $checkSizeSQL);
    $row = mysqli_fetch_assoc($sizeResult);
    $totalRecords = $row['total'];
    mysqli_free_result($sizeResult);

    $totalFetched = false;

    echo "<section id = eventsThisWeek>";
    echo "<h3>Events this week</h3>";

    $sql = "SELECT  *
            FROM    events
            WHERE   date BETWEEN CURDATE() + INTERVAL 7 DAY AND CURDATE() LIMIT " . $offset . "," . $limit . ";";
    $dbresult = mysqli_query($connection, $sql);

    if (mysqli_num_rows($dbresult) == 0) {
        echo "<h4>No events on for the next 7 days.</h4>";
    } 
    
    //rows were found
    else {
        While ($row = mysqli_fetch_assoc($dbresult)) {
            //link to view the event in here
            echo"
              <table>
              <tr>
              <th> Name </th>   <th> Date </th> <th> Time </th> <th> Location </th> <th> Type </th> <th> Description </th>
              </tr>
              <tr>
              <td><strong>MAKE THIS A LINK</strong> {$row['name']}</td> <td>{$row['date']}</td>  <td>{$row['time']}</td>  <td>{$row['location']}</td>  <td>{$row['type']}</td>  <td>{$row['description']}</td>
              </tr>
              
            ";
        }//end while
        //links here at bottom of table to switch pages ,redirecting to current page & section with updated pastoffset &pastlimit vars
        $prevOffSet = $offset - 10;
        $nextOffSet = $offset + 10;
        echo "<tr>";
        
        //if this is the first page,hide the previous button
        if($offset != 0){
            echo "<td><a href=\"all_events.php?pastoffset={$prevOffSet} #eventsThisWeek\">Previous</a></td>";           
        }


        //dont output the next link if its got all the records.
        //make sure the offset is less than the total number of records
        if ($offset +10 > $totalRecords) {
            $totalFetched = true;
        }

        if (!$totalFetched) {
            echo "<td><a href=\"all_events.php?pastoffset={$nextOffSet} #eventsThisWeek\">Next</a></td>";
        }

        echo "     </tr>
            </table>";

    }//end else there are results

    mysqli_free_result($dbresult);
    mysqli_close($connection);
    echo "</section>";        
    
    
}


/**
 * browse_future_events
 * Show events in the future.Carbon copy of browse_past_events with a single character changed.
 * @author Neil Cronin neilc5867@gmail.com
 *   
 * @param DBURL the url of the database to be used
 * @param DBUser the username for the database
 * @param DBPassword the password for the database
 * @param DB the database to be connected to
 */
function browse_future_events($DBURL, $DBUser, $DBPassword, $DB) 
{
//offset and limit are sent as get info
    $limit = 10;
    $offset = 0;
    if (!isset($_GET['pastoffset'])) {
        $offset = 0;
    } else {
        $offset = $_GET['pastoffset'];
        if ($offset < 0) {
            $offset = 0;
        }
    }
    
    $connection = mysqli_connect($DBURL, $DBUser, $DBPassword, $DB);
    if (!$connection) {
        die('Connection Error (' . mysqli_connect_errno() . ') Check your function inputs. ' . mysqli_connect_error());
    }
    $checkSizeSQL = "SELECT count(*) AS total FROM events";
    $sizeResult = mysqli_query($connection, $checkSizeSQL);
    $row = mysqli_fetch_assoc($sizeResult);
    $totalRecords = $row['total'];
    mysqli_free_result($sizeResult);

    $totalFetched = false;

    echo "<section id = futureEvents>";
    echo "<h3> Past Events </h3>";
    $connection = mysqli_connect($DBURL, $DBUser, $DBPassword, $DB);
    if (!$connection) {
        die('Connection Error (' . mysqli_connect_errno() . ') Check your function inputs. ' . mysqli_connect_error());
    }
    //set the default client character set 
    mysqli_set_charset($connection, 'utf-8');

    $sql = "select * from events where date > NOW() limit " . $offset . "," . $limit . ";";
    $dbresult = mysqli_query($connection, $sql);

    if (mysqli_num_rows($dbresult) == 0) {
        echo "<h4>No future events right now.</h4>";
    } 
    
    //rows were found
    else {
        While ($row = mysqli_fetch_assoc($dbresult)) {
            //link to view the event in here
            echo"
              <table>
              <tr>
              <th> Name </th>   <th> Date </th> <th> Time </th> <th> Location </th> <th> Type </th> <th> Description </th>
              </tr>
              <tr>
              <td><strong>MAKE THIS A LINK</strong> {$row['name']}</td> <td>{$row['date']}</td>  <td>{$row['time']}</td>  <td>{$row['location']}</td>  <td>{$row['type']}</td>  <td>{$row['description']}</td>
              </tr>
              
            ";
        }//end while
        //links here at bottom of table to switch pages ,redirecting to current page & section with updated pastoffset &pastlimit vars
        $prevOffSet = $offset - 10;
        $nextOffSet = $offset + 10;
        echo "<tr>";
        
        //if this is the first page,hide the previous button
        if($offset != 0){
            echo "<td><a href=\"all_events.php?pastoffset={$prevOffSet} #futureEvents\">Previous</a></td>";           
        }


        //dont output the next link if its got all the records.
        //make sure the offset is less than the total number of records
        if ($offset +10 > $totalRecords) {
            $totalFetched = true;
        }

        if (!$totalFetched) {
            echo "<td><a href=\"all_events.php?pastoffset={$nextOffSet} #futureEvents\">Next</a></td>";
        }

        echo "     </tr>
            </table>";

    }//end else there are results

    mysqli_free_result($dbresult);
    mysqli_close($connection);
    echo "</section>";    
}//end browse_future_events



/**
 * browse_past_events 
 * Show events in descending order of date / time in the past
 * Need to figure out a way to display 10 at a time,then going to next 10 when
 * a link is clicked
 * "select * from table_name where (your condition) limit ".$offset.",".$limit.""
 * @author Neil Cronin neilc5867@gmail.com
 *  * 
 * @param DBURL the url of the database to be used
 * @param DBUser the username for the database
 * @param DBPassword the password for the database
 * @param DB the database to be connected to
 */
function browse_past_events($DBURL, $DBUser, $DBPassword, $DB) {
    //offset and limit are sent as get info
    $limit = 10;
    $offset = 0;
    if (!isset($_GET['pastoffset'])) {
        $offset = 0;
    } else {
        $offset = $_GET['pastoffset'];
        if ($offset < 0) {
            $offset = 0;
        }
    }
    
    $connection = mysqli_connect($DBURL, $DBUser, $DBPassword, $DB);
    if (!$connection) {
        die('Connection Error (' . mysqli_connect_errno() . ') Check your function inputs. ' . mysqli_connect_error());
    }
    $checkSizeSQL = "SELECT count(*) AS total FROM events";
    $sizeResult = mysqli_query($connection, $checkSizeSQL);
    $row = mysqli_fetch_assoc($sizeResult);
    $totalRecords = $row['total'];
    mysqli_free_result($sizeResult);

    $totalFetched = false;

    echo "<section id = pastEvents>";
    echo "<h3> Past Events </h3>";
    $connection = mysqli_connect($DBURL, $DBUser, $DBPassword, $DB);
    if (!$connection) {
        die('Connection Error (' . mysqli_connect_errno() . ') Check your function inputs. ' . mysqli_connect_error());
    }
    //set the default client character set 
    mysqli_set_charset($connection, 'utf-8');

    $sql = "select * from events where date < NOW() limit " . $offset . "," . $limit . ";";
    $dbresult = mysqli_query($connection, $sql);

    if (mysqli_num_rows($dbresult) == 0) {
        echo "<h4>No past events to show right now.</h4>";
    } 
    
    //rows were found
    else {
        While ($row = mysqli_fetch_assoc($dbresult)) {
            //link to view the event in here
            echo"
              <table>
              <tr>
              <th> Name </th>   <th> Date </th> <th> Time </th> <th> Location </th> <th> Type </th> <th> Description </th>
              </tr>
              <tr>
              <td><strong>MAKE THIS A LINK </strong>{$row['name']}</td> <td>{$row['date']}</td>  <td>{$row['time']}</td>  <td>{$row['location']}</td>  <td>{$row['type']}</td>  <td>{$row['description']}</td>
              </tr>
              
            ";
        }//end while
        //links here at bottom of table to switch pages ,redirecting to current page & section with updated pastoffset &pastlimit vars
        $prevOffSet = $offset - 10;
        $nextOffSet = $offset + 10;
        echo "<tr>";
        
        //if this is the first page,hide the previous button
        if($offset != 0){
            echo "<td><a href=\"all_events.php?pastoffset={$prevOffSet} #pastEvents\">Previous</a></td>";           
        }


        //dont output the next link if its got all the records.
        //make sure the offset is less than the total number of records
        if ($offset +10 > $totalRecords) {
            $totalFetched = true;
        }

        if (!$totalFetched) {
            echo "<td><a href=\"all_events.php?pastoffset={$nextOffSet} #pastEvents\">Next</a></td>";
        }

        echo "     </tr>
            </table>";

    }//end else there are results

    mysqli_free_result($dbresult);
    mysqli_close($connection);
    echo "</section>";
}

//end browse_past_events


/**
 * browse_recordings
 * generate 10 recordings from highest id to lowest (most - less recent)
 * add a way to go from 1 to 10,10 - 20 etc?
 * 
 * @author Neil Cronin neilc5867@gmail.com
 * 
 * @param DBURL the url of the database to be used
 * @param DBUser the username for the database
 * @param DBPassword the password for the database
 * @param DB the database to be connected to
 */
function browse_recordings($DBURL, $DBUser, $DBPassword, $DB) {

    $connection = mysqli_connect($DBURL, $DBUser, $DBPassword, $DB);
    if (!$connection) {
        die('Connection Error (' . mysqli_connect_errno() . ') Check your function inputs. ' . mysqli_connect_error());
    }
    //set the default client character set 
    mysqli_set_charset($connection, 'utf-8');


    //offset and limit are sent as get info
    $limit = 10;
    $offset = 0;
    if (!isset($_GET['pastoffset'])) {
        $offset = 0;
    } else {
        $offset = $_GET['pastoffset'];
        if ($offset < 0) {
            $offset = 0;
        }
    }

    $checkSizeSQL = "SELECT count(*) AS total FROM recordings";
    $sizeResult = mysqli_query($connection, $checkSizeSQL);
    $row = mysqli_fetch_assoc($sizeResult);
    $totalRecords = $row['total'];
    mysqli_free_result($sizeResult);

    $totalFetched = false;

    $sql = "select * from recordings limit " . $offset . "," . $limit . ";";
    $dbresult = mysqli_query($connection, $sql);

    //if no result
    if (!$dbresult) {
        die("<p>{$sql} offset is {$offset}, past offset is {$_GET['pastoffset']}</p><p>There was an error in the query: " . mysqli_error($connection) . " </p>");
    }

    //if no rows are found
    if (mysqli_num_rows($dbresult) == 0) {
        echo "<p>No record rows were found.</p>";
    }//end if
    else {
        echo "<section id =browse >";
        echo "
              <table>
              <tr>
              <th> Filename </th>   <th> Description </th> <th> Event Name </th> <th> Uploader </th>
              </tr>
              ";
        While ($row = mysqli_fetch_assoc($dbresult)) {
            //link to view the event in here
            echo"
              <tr>
              <td><a href = \"viewRecording.php?recordingid={$row['recordingid']}\">{$row['title']}</td> <td>{$row['description']}</td>  <td>{$row['eventname']}</td>  <td>{$row['uploader']}</td>
              </tr>
              
            ";
        }//end while
        
        
        //links here at bottom of table to switch pages ,redirecting to current page & section with updated pastoffset &pastlimit vars
        $prevOffSet = $offset - 10;
        $nextOffSet = $offset + 10;
        echo "
            <tr>
            ";
        if($offset != 0){
            echo "<td><a href=\"recordings.php?pastoffset={$prevOffSet} #browse\">Previous</a></td>";           
        }


        //dont output the next link if its got all the records.
        //make sure the offset is less than the total number of records
        if ($offset +10 > $totalRecords) {
            $totalFetched = true;
        }

        if (!$totalFetched) {
            echo "<td><a href=\"recordings.php?pastoffset={$nextOffSet} #browse\">Next</a></td>";
        }

        echo "     </tr>
            </table>";
    }//end else there are results

    mysqli_free_result($dbresult);
    mysqli_close($connection);
    echo "</section>";
}

//end browse_recordings

/**
 * view_recording
 * Display the recording based on what filetype is is after fetching it based on
 * the url & using PATHINFO to get filetype
 * 
 * @author Neil Cronin neilc5867@gmail.com
 * 
 * @param DBURL the url of the database to be used
 * @param DBUser the username for the database
 * @param DBPassword the password for the database
 * @param DB the database to be connected to
 */
function view_recording($DBURL, $DBUser, $DBPassword, $DB) {
    $connection = mysqli_connect($DBURL, $DBUser, $DBPassword, $DB);
    if (!$connection) {
        die('Connection Error (' . mysqli_connect_errno() . ') Check your function inputs. ' . mysqli_connect_error());
    }
    //set the default client character set 
    mysqli_set_charset($connection, 'utf-8');

    $sql = "SELECT * FROM recordings WHERE recordingid = {$_GET['recordingid']};";
    $dbresult = mysqli_query($connection, $sql);

    if (mysqli_num_rows($dbresult) == 0) {
        echo "<p>There was an error in the query</p>";
    }
    $row = mysqli_fetch_assoc($dbresult);

    //grab stuff from the row and put it in variables
    $path = $row['url'];
    $title = $row['title'];
    $description = $row['description'];
    $eventname = $row['eventname'];
    $uploader = $row['uploader'];
    begin_section($title);


    //figure out the filetype
    $ext = pathinfo($path, PATHINFO_EXTENSION);

    //if its a MP4, WebM or OGG,use html5 video
    if ($ext == 'webm' || $ext == 'ogg' || $ext == 'mp4') {
        echo"
        <video width = \"640\" height = \"480\" autoplay controls>
        <source src = \"$path\" type = \"video/{$ext}\">
        Your browser does not support the video tag.
        </video>
        ";
    }//end if video
    //if audio of type mp3, wav or ogg
    else if ($ext == 'wav' || $ext == 'ogg' || $ext == 'mp3') {
        echo "
        <audio controls autoplay>
        <source src = \"{$path}\" type = \"audio/{$ext}\">
        Your browser does not support the audio element.
        </audio>
        ";
    }

    
    //if its a text document
    else if ($ext == 'txt') {
        echo file_get_contents($path);
    }

    //presuming its a picture
    else if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png') {
        make_picture($path, $description);
    } else {
        echo "<p> Weird file format detected: {$ext}";
    }

    echo "<p><strong>Uploaded by MAKE THIS A LINK TO PROFILE {$uploader} at the event MAKE THIS A LINK TO EVENT {$eventname}</strong></p>";
    echo "<p>{$description}</p>";
    end_section();
    mysqli_free_result($dbresult);
    mysqli_close($connection);
}

//end view_recording

/**
 * search_recordings
 * Search the database of recordings by name or event 
 * redirect to the current page with the results,but dont load the browse section 
 * 
 * @author Neil Cronin neilc5867@gmail.com
 * 
 * @param DBURL the url of the database to be used
 * @param DBUser the username for the database
 * @param DBPassword the password for the database
 * @param DB the database to be connected to
 */
function search_recordings($DBURL, $DBUser, $DBPassword, $DB) {
    echo '<section id ="search">';
    /**
     * check if the user has put in something to search for,
     * by checking the get variables.
     * if they arent set,print a table.
     * 
     */
    if (!isset($_GET['filename']) && !isset($_GET['eventname'])) {
        echo'
        <form action = "recordings.php#search" >
        <fieldset>
        <p><strong>File name</strong></p>
        <input type="text" name="filename" value="" placeholder ="File name"/>
        </p><strong>Event name</strong></p> 
        <input type="text" name="eventname" value="" placeholder ="Event name"/>

        </fieldset>
                        <input type="submit" value="Search" />
        </form>

        ';
    }
    /**
     * They have put in a term and are searching for it 
     */ else {
        echo'
            <p><i>Searching...</i></p>
        <form action = "recordings.php#search" >
        <fieldset>
        <p><strong>File name</strong></p>
        <input type="text" name="filename" value="" placeholder ="File name"/>
        </p><strong>Event name</strong></p> 
        <input type="text" name="eventname" value="" placeholder ="Event name"/>
 
        </fieldset>
                           <input type="submit" value="Search" />
        </form>
        ';

        $connection = mysqli_connect($DBURL, $DBUser, $DBPassword, $DB);
        if (!$connection) {
            die('Connection Error (' . mysqli_connect_errno() . ') Check your function inputs. ' . mysqli_connect_error());
        }
        //set the default client character set 
        mysqli_set_charset($connection, 'utf-8');

        //search string built with ifs based on get data
        //if they are searching for a filename but not an eventname


        if ($_GET['filename'] != '') {
            $sql = 'SELECT title, description, eventname, recordingid FROM recordings WHERE title LIKE \'%' . $_GET['filename'] . ' %\';';
        }//end filename search
        //if they are searching for an eventname but NOT a title
        if ($_GET['eventname'] != '') {
            $sql = "SELECT title, description, eventname, recordingid FROM recordings WHERE eventname LIKE '%{$_GET['eventname']}%';";
        }//end eventname search
        //if they are searching for both
        if ($_GET['filename'] != '' && $_GET['eventname'] != '') {
            $sql = "SELECT title, description, eventname, recordingid  FROM recordings WHERE eventname LIKE '%{$_GET['eventname']}%' OR title LIKE '%{$_GET['filename']}%';";
        }//end bothsearch

        if ($_GET['filename'] == '' && $_GET['eventname'] == '') {
            return;
        }
        $dbresult = mysqli_query($connection, $sql);
        $numRecordings = mysqli_num_rows($dbresult);

        //if no result
        if (!$dbresult) {
            die("<p>{$sql}</p><p>There was an error in the query: " . mysqli_error($connection) . " </p>");
        } else {


            //show results in a table
            echo "<table>
                    <caption>Found {$numRecordings} matching recordings.</caption>
                <tr>    <th>Filename</th>  <th>Description</th>  <th>Event name</th>";
            //for each row,make a table row
            while ($row = mysqli_fetch_assoc($dbresult)) {
                echo "<tr>";
                echo "<td><a href = \"viewRecording.php?recordingid={$row['recordingid']}\">{$row['title']}</a></td> <td>{$row['description']}</td> <td>{$row['eventname']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        }//end else Results found
        mysqli_free_result($dbresult);
        mysqli_close($connection);
    }//end else (db search)
    echo '</section>';
}

//end search_recordings

/**
 * upload_recordings
 * If user is logged in,let them upload a file to the recordings database.
 * 
 * put this only on an event page?that way event name and ID will be available
 * 
 * Otherwise,tell them they must be logged in
 * 
 * @author Neil Cronin neilc5867@gmail.com
 * 
 * @param DBURL the url of the database to be used
 * @param DBUser the username for the database
 * @param DBPassword the password for the database
 * @param DB the database to be connected to
 */
function upload_recording($DBURL, $DBUser, $DBPassword, $DB) {

    //check if the session variable saying a user is logged in is there
    if (!isset($_SESSION['username'])) {
        echo "<p><strong>You must be <a href='loginpage.php'>logged in</a> to upload a file.</strong></p>";
    }//end if they arent logged in
    //
    //they are logged in,proceed
    else {
        //connect to the database
        $connection = mysqli_connect($DBURL, $DBUser, $DBPassword, $DB);
        if (!$connection) {
            die('Connection Error (' . mysqli_connect_errno() . ') Check your function inputs. ' . mysqli_connect_error());
        }
        //set the default client character set 
        mysqli_set_charset($connection, 'utf-8');

        echo
        '<form name = "uploadform" action = "' . $_SERVER['PHP_SELF'] . '" method = "POST">
            <input type="text" name="Title" value="" />
            <input type="file" name="File" value="" />
            <input type="text" name="Event recorded" value="Put in the event name exactly as is shown on the event page" />
            <textarea name="Description (optional)" rows="4" cols="20">
            </textarea>
            <input type="submit" value="submit" />
            <input type="reset" value="reset" />
        </form >';


        mysqli_free_result($dbresult);
        mysqli_close($connection);
    }
}

//end upload_recording



/**
 * display_recording
 * display the given recording that is identified in the get info.
 * Figure out file extension using pathinfo and decide based on that what to do
 * 
 * @author Neil Cronin neilc5867@gmail.com
 * @param filename
 */

/**
 * Make picture
 * Puts a picture at the side of whatever it is.
 * Put it in between start&end section 
 * 
 * @author Neil Cronin neilc5867@gmail.com  
 * 
 * @param url the url of the picture (should be in assets/img/other/)
 * @param caption a caption for the picture
 * 
 */
function make_picture($url, $caption) {
    echo '                     <div class="col leuven">
                                    <div class="cell panel">
                                        <div class="body">
                                            <div class="cell">
                                                <figure class="nuremberg">  
                                                    <img src=" ' . $url . '" alt=""> 
                                                    <figcaption>' . $caption . '</figcaption>  
                                                </figure>  
                                            </div>
                                        </div>
                                    </div>
                                </div>';
}

/**
 * begin_section
 * Start some content in the center of the page.
 * 
 * Put your PHP between this and end_section!
 * 
 * @author Neil Cronin neilc5867@gmail.com
 * 
 * @param h1 the name of the section
 */
function begin_section($h1) {
    echo'
    <div class="col content">
                        <div class="col">
                            <div class="cell">
                                <div class="template-header">
                                    <h2>' . $h1 . '</h2>
                                </div>
                                

 ';
}

//end begin_section

/**
 * end_section
 * finish up your content so that it is styled properly
 * 
 * @author Neil Cronin neilc5867@gmail.com
 */
function end_section() {

    echo '
                                </div>
                        </div>
                   </div>';
}

//end end_section

/**
 * generate_header
 * 
 * generates the preamble [top navbars,title, html etc] for a standard page
 * @author Neil Cronin neilc5867@gmail.com
 * 
 * @param current page name
 */
function generate_header($currPage) {
    echo '
                <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="utf-8">
                    <link rel="stylesheet" type="text/css" media="all"  href="assets/css/cascade/production/build-full.min.css" />
                    <link rel="stylesheet" type="text/css" media="all"  href="assets/css/site.css" />
                    <!--[if lt IE 8]><link rel="stylesheet" href="assets/css/cascade/production/icons-ie7.min.css"><![endif]-->
                    <!--[if lt IE 9]><script src="assets/js/shim/iehtmlshiv.js"></script><![endif]-->
                    <title>Irish Wildlife Fund</title>
                    <meta name="description" content="Irish Wildlife Fund">
                    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <style type="text/css">


                    </style>
                </head>
                <body>
                    <div class="site-header-fixture">
                        <div class="site-header-ghost">
                            <div class="col width-fit mobile-width-fit">
                                <div class="cell">
                                    <a href="#" class="logo"></a>
                                </div>
                            </div>
                            <div class="col width-fill mobile-width-fill">
                                <div class="cell">
                                    <ul class="col nav">                                                                 <!--   TOP NAVBAR -->
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="my_events.php">My Events</a></li>
                                        <li><a href="all_events.php">All Events</a></li>
                                        <li><a href="recordings.php">Recordings</a></li>
                                        <li class="active"><a href=" ' . $currPage . '.php "> ' . $currPage . '</a></li> 
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="site-header">
                            <div class="col width-fit mobile-width-fit">
                                <div class="cell">
                                    <a href="index.php" class="logo"></a>
                                </div>
                            </div>
                            <div class="col width-fill mobile-width-fill">
                                <div class="cell">
                                    <ul class="col nav">                                                                 <!--   TOP NAVBAR -->
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="my_events.php">My Events</a></li>
                                        <li><a href="all_events.php">All Events</a></li>
                                        <li><a href="recordings.php">Recordings</a></li>
                                        <li class="active"><a href=" ' . $currPage . '.php "> ' . $currPage . '</a></li> 
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="site-body centered-content">
                        <div class="site-center">
                            <div class="cell">
                                <div class="col">
                                    <div class="cell">
                                        <div class="page-header">
                                            <h1>Irish Wildlife Fund</h1>
                                        </div>
                                    </div>
                                </div>
                          
                                
    ';
}

//end generate_header

/**
 * generate_footer
 * 
 * generates the preamble [top navbars,title, html etc] for a standard page
 * @author Neil Cronin neilc5867@gmail.com
 * 
 * @param current page name
 */
function generate_footer($currPage) {

    echo '
                        <div class="col">
                            <div class="cell panel">
                                <div class="header">
                                    Links
                                </div>
                                <div class="body">
                                    <div class="cell menu">
                                        <ul class="left nav links">                                                                 <!--   SIDE NAVBAR -->
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="my_events.php">My Events</a></li>
                                            <li><a href="all_events.php">All Events</a></li>
                                            <li><a href="recordings.php">Recordings</a></li>
                                            <li class="active"><a href=" ' . $currPage . '.php "> ' . $currPage . '</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                  </div>
                 </div>
                <div class="site-header-ghost">
                    <div class="site-footer">
                        <div class="col width-fit">
                            <div class="cell">
                                <a href="#" class="powered-by"></a>
                            </div>
                        </div>
                        <div class="col width-fill">
                            <div class="cell pipes">
                                <ul class="nav">                                                                 <!--   BOTTOM NAVBAR -->
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="my_events.php">My Events</a></li>
                                    <li><a href="all_events.php">All Events</a></li>
                                    <li><a href="recordings.php">Recordings</a></li>
                                    <li class="active"><a href=" ' . $currPage . '.php "> ' . $currPage . '</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="site-footer-fixture">
                    <div class="site-footer">
                        <div class="col width-fit">
                            <div class="cell">
                                <a href="#" class="powered-by"></a>
                            </div>
                        </div>
                        <div class="col width-fill">
                            <div class="cell pipes">
                                <ul class="nav">                                                                 <!--   BOTTOM NAVBAR -->
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="my_events.php">My Events</a></li>
                                    <li><a href="all_events.php">All Events</a></li>
                                    <li><a href="recordings.php">Recordings</a></li>
                                    <li class="active"><a href=" ' . $currPage . '.php "> ' . $currPage . '</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="assets/js/app.js"></script>
            </body>
        </html>';
}

//end generate_footer
//end file?>