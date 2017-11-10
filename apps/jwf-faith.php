<?php
/* Manages the redirection of the jwf.faith domain.
   Picks a random site from the list below and redirects the user. */
$sites = array(
	'https://en.wikipedia.org/wiki/Free_and_open-source_software',
	'https://en.wikipedia.org/wiki/Oracle_Corporation#Controversies',
	'http://ritlug.com',
);
header("Location: " . $sites[rand(0, count($sites) - 1)]);
?>
