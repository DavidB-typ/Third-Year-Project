<?php
        session_start();
?>

<!DOCTYPE html>
<!-- Link to this page with <li><a href="recordings.php">Recordings</a></li> -->
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
                            <li class="active"><a href="recordings.php">Recordings</a></li>
                            <li><a href="testpage.php">Test Page</a></li>
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
                            <li class="active"><a href="recordings.php">Recordings</a></li>
                            <li><a href="testpage.php">Test Page</a></li>
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
                    <!-- HEADER GENERATION ENDS HERE-->

                    <!-- BEGIN SECTION STARTS HERE -->


                    <?php
                    /**
                    require_once 'NeilLib.php';
                    begin_section("Add a recording");
                    upload_recording('localhost', 'root', '', 'projectdb');
                    make_picture('assets/img/other/sound-editing-4.jpg', "A mechanical sound editor");
                    
                    end_section();
                     * 
                     */
                    ?>

                    <div class="col content">
                        <div class="col">
                            <div class="cell">
                                <div class="template-header">
                                    <h2>Search Recordings</h2>
                                </div>
                                <?php
                                //forms to search by name, event or title
                                require_once 'NeilLib.php';
                                search_recordings('localhost', 'root', '', 'projectdb');
                                ?>



                            </div>
                        </div>
                        <div class="col">
                            <div class="cell">

                            </div>
                        </div>
                        <div class="col">
                            <div class="cell">
                                <div class="template-header">

                                </div>

                                <?php
                                  require_once 'NeilLib.php';
                                  begin_section('Browse Recordings');
                                  browse_recordings('localhost', 'root', '', 'projectdb');

                                  end_section();
                                ?>          
                            </div>
                        </div>

                    </div>


                    <?php
                    require_once 'ShaneFunctions.php';
                    generate_loginbox();
                    ?>



                    <!-- FOOTER GENERATION STARTS HERE-->
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
                                        <li class="active"><a href="recordings.php">Recordings</a></li>

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
                            <li id="active"><a href="recordings.php">Recordings</a></li>
                            <li><a href="testpage.php">Test Page</a></li>
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
                            <li id="active"><a href="recordings.php">Recordings</a></li>
                            <li><a href="testpage.php">Test Page</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/app.js"></script>
    </body>
</html>