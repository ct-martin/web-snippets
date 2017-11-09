<?php
// This is an index.php file for having a simple, file-based CMS
// Pages are stored in pages/ but you can also add subfolders in the array in the first foreach loop
// This is not meant for huge sites, it's meant to be simple. Pages are "whitelist" to simplify sanitizing
// Header and footer should be in inc/ and named header.php and footer.php
$pages = array();
foreach(array("", "subfolder") as $foldir) {
	$pgfiles = array_diff(scandir("pages/" . ($foldir == "" ? "" : $foldir . "/")), array('..', '.'));
	foreach($pgfiles as $page) {
		if(strlen($page) >= 5 && substr($page, -4) == ".php") {
			array_push($pages, ($foldir == "" ? "" : $foldir . "/") . substr($page, 0, -4));
		}
	}
}

$req = (isset($_GET['page']) ? $_GET['page'] : 'home');
$raw = false;

if(preg_match('/^(\/){0,1}raw(\/){0,1}(.*)/ims', $req)) {
	$raw = true;
	$req = preg_replace('/^(\/){0,1}raw(\/){0,1}(.*)/ims', '$3', $req);
	if($req == "") $req = 'home';
}

if(!in_array($req, $pages)) {
	$req = '404';
}

if($raw) {
	include('pages/' . $req . '.php');
} else {
	include('inc/header.php');
	include('pages/' . $req . '.php');
	include('inc/footer.php');
}
?>
