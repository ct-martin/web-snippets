<?php
// Uses Bootstrap's Cards: https://getbootstrap.com/docs/4.0/components/card/
// This was designed to be semi-static, so it's in this file,
// but the array can be moved to another file and then just require() this.
// Use "$featuredcardsonly = true;" to only show cards marked as featured.
$cards = array(
    array(
        'name' => 'Card Title',
        'url' => '/somewhere',
        'desc' => 'description',
        'img' => 'url to image',
        'imgalt' => 'alt text for image',
        'header' => 'optional, adds a header to the card',
        'featured' => true // optional, marks as featured
);
?>
                        <div class="row" style="margin-top:.75rem;">
<?php
foreach ($cards as $card) {
    if(!(isset($featuredcardsonly) && $featuredcardsonly) || (isset($card["featured"]) && $card["featured"])) {
?>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card">
                                <?php if(isset($card["header"]) && $card["header"]) { ?>
                                    <div class="card-header">
                                        <?php echo($card["header"]); ?>
                                    </div>
                                <?php }
                                if(isset($card["img"]) && $card["img"] != "") { ?>
                                    <img class="card-img-top" src="<?php if(isset($card["img"]) && $card["img"]!="") echo($card["img"]); ?>"<?php echo((isset($card["imgalt"]) && $card["imgalt"]!="") ? " alt=\"" . $card["imgalt"] . "\"" : ""); ?> style="width:90%;margin:5%;">
                                <?php } ?>
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo($card["name"]); ?></h4>
                                        <p class="card-text"><?php echo($card["desc"]); ?></p>
                                        <a href="<?php echo($card["url"]); ?>" class="btn btn-primary w-100">See Project</a>
                                    </div>
                                </div>
                            </div>
<?php
    }
}
?>
                        </div>
