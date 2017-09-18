<?php
// A Bootstrap v4 carousel template
// https://getbootstrap.com/docs/4.0/components/carousel/
/* Syntax:
$gallery = array(
    array(
        "src" => "url here",
        "alt" => "alt text to display, overrides caption",
        "caption" => "slide caption, will be used for alt text unless an alt text is specified",
        "capheading" => "heading for caption on slide. will not appear in alt text"
    )
)
require('path to this file');
*/
if(isset($gallery)) {
?>
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="padding-bottom:1rem;">
                            <ol class="carousel-indicators">
<?php
    for($i = 0; $i < count($gallery); $i++) {
?>
                                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo($i); ?>"<?php if($i==0) echo(" class=\"active\""); ?>></li>
<?php
    }
?>
                            </ol>
                            <div class="carousel-inner">
<?php
    for($i = 0; $i < count($gallery); $i++) {
?>

                                <div class="carousel-item<?php if($i==0) echo(" active"); ?>">
                                    <img class="d-block w-100" src="<?php echo($gallery[$i]["src"]); ?>" alt="<?php echo((isset($gallery[$i]["alt"]) || isset($gallery[$i]["caption"])) ? (isset($gallery[$i]["alt"]) ? $gallery[$i]["alt"] : $gallery[$i]["caption"]) : "Slide " . $i); ?>">
<?php
        if(isset($gallery[$i]["capheading"]) || isset($gallery[$i]["caption"])) {
?>
                                    <div class="carousel-caption d-none d-md-block">
                                        <?php if(isset($gallery[$i]["capheading"])) echo("<h3>" . $gallery[$i]["capheading"] . "</h3>"); ?>
                                        <?php if(isset($gallery[$i]["caption"])) echo("<p>" . $gallery[$i]["caption"] . "</p>"); ?>
                                    </div>
<?php
        }
?>
                                </div>
<?php
    }
?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                <!--<span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                <!--<span class="carousel-control-next-icon" aria-hidden="true"></span>-->
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
<?php
} else {
    echo("NO GALLERY TO DISPLAY");
}
?>
