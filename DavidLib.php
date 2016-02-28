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