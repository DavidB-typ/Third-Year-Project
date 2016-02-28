/**
* begin_HTML
* Create a HTML beginning including a head and opens a body
*
* The body must be closed with the end_HTML function below
* 
* @author David Broderick 
*/
function begin_HTML(){
echo'
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

';
}//end begin_HTML

* make_header
* Create a HTML header for the top of each page and prepares for content function below
* 
* @author David Broderick 
*/
function make_header(){
echo'
<div class="site-header-fixture">
            <div class="site-header-ghost">
                <div class="col width-fit mobile-width-fit">
                    <div class="cell">
                        <a href="index.php" class="logo"></a>
                    </div>
                </div>
                <div class="col width-fill mobile-width-fill">
                    <div class="cell">
                        <ul class="col nav">
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="my_events.php">My Events</a></li>
                            <li><a href="all_events.php">All Events</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="site-header">
                <div class="col width-fit mobile-width-fit">
                    <div class="cell">
                        <a href="#" class="logo"></a>
                    </div>
                </div>
                <div class="col width-fill mobile-width-fill">
                    <div class="cell">
                        <ul class="col nav">
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="my_events.php">My Events</a></li>
                            <li><a href="all_events.php">All Events</a></li>
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
}//end make_header




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
function begin_section($h1){
echo'
<div class="col content">
<div class="col">
<div class="cell">
<div class="template-header">
<h2>'. $h1 .'</h2>
</div>

';
}//end begin_section
/**
* end_section
* finish up your content so that it is styled properly
* 
* @author Neil Cronin neilc5867@gmail.com
*/
function end_section()
{
echo '
</div>
</div>
</div>';
}//end end_section
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
function make_picture($url, $caption)
{
echo ' <div class="col leuven">
<div class="cell panel">
<div class="body">
<div class="cell">
<figure class="nuremberg"> 
<img src=" '. $url . '" alt=""> 
<figcaption>' . $caption .'</figcaption> 
</figure> 
</div>
</div>
</div>
</div>';
}


/**
* end_HTML
* Ends the page with nav and a footer as well as closing the body and html
* 
* @author David Broderick 
*/
function end_HTML(){
echo'
<!DOCTYPE html>
 <div class="col">
                            <div class="cell panel">
                                <div class="header">
                                    Links
                                </div>
                                <div class="body">
                                    <div class="cell menu">
                                        <ul class="left nav links">
                                            <li><a href="index.php">Home</a></li>
                                            <li class="active"><a href="my_events.php">My Events</a></li>
                                            <li><a href="all_events.php">All Events</a></li>
                                        </ul>
                                    </div>
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
                        <ul class="nav">
                            <li><a href="index.php">Home</a></li>
                            <li id="active"><a href="my_events.php">My Events</a></li>
                            <li><a href="all_events.php">All Events</a></li>
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
                        <ul class="nav">
                            <li><a href="index.php">Home</a></li>
                            <li id="active"><a href="my_events.php">My Events</a></li>
                            <li><a href="all_events.php">All Events</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/app.js"></script>
    </body>
</html>

';
}//end end_HTML
