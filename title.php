<!-- Put this in your <title> tag in your <head> to generate a title from a file name.
     "projects/thing-a" -> "projects/thing a" -> array("projects", "thing a") ->
     array("thing a", "projects") -> "thing a - projects" -> "Thing A - Projects" -->
<?php echo(ucwords(implode(" - ", array_reverse(explode("/", str_replace("-", " ", $req)))))); ?>
