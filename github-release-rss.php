<?php
// Get repo from path
$repo = (isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : false);
// If not set, die
if(!$repo) die('No repo specified (PATH_INFO)');
// Drop leading slash
$repo = (substr($repo, 0, 1) == "/" ? substr($repo, 1) : $repo);
// Check for exactly one slash b/c repos use ":owner/:repo" notation
if(strpos($repo, "/") == "-1" ||
    strpos($repo, "/") != strrpos($repo, "/")) die('Invalid repo (Slash)');
// Convert to array of 2 parts (owner & repo)
$repoarr = explode("/", $repo);
// Validate username (Regex from https://www.npmjs.com/package/github-username-regex under CC0)
if(preg_match("/^[a-z\d](?:[a-z\d]|-(?=[a-z\d])){0,38}$/i", $repoarr[0]) !== 1)
    die('Invalid repo (PREG :owner)');
// Validate repo (modified from the above) to loosely sanitize
if(preg_match("/^[a-z\d](?:[a-z\d]|[-_](?=[a-z\d])){0,}$/i", $repoarr[1]) !== 1)
    die('Invalid repo (PREG :owner)');

// Get Repository Information (to $repodata)
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.github.com/repos/$repo");
curl_setopt($ch, CURLOPT_USERAGENT, "GitHub Release RSS");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$repodata = json_decode(curl_exec($ch), true);
curl_close($ch);
// Get All Releases (to $releases)
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.github.com/repos/$repo/releases");
curl_setopt($ch, CURLOPT_USERAGENT, "GitHub Release RSS");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$releases = json_decode(curl_exec($ch), true);
curl_close($ch);

// Generate RSS Feed

// Do NOT add a newline at the start of this echo (W3C Validator flips out)
echo('<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
    <atom:link href="https://example.com/github-release-rss.php/' . $repodata["full_name"] . '" rel="self" type="application/rss+xml" />
    <title>' . $repodata["full_name"] . '</title>
    <description>' . htmlentities($repodata["description"]) . '</description>
    <link>' . $repodata["html_url"] . '</link>
    <lastBuildDate>' . date(DATE_RSS) . '</lastBuildDate>
    <pubDate>' . date(DATE_RSS, strtotime($repodata["updated_at"])) . '</pubDate>
    <ttl>1800</ttl>');
foreach($releases as $release) {
echo('
    <item>
        <title>' . $release["name"] . '</title>
        <description>' . htmlentities($release["body"]) . '</description>
        <link>' . $release["html_url"] . '</link>
        <pubDate>' . date(DATE_RSS, strtotime($release["published_at"])) . '</pubDate>
    </item>');
}
?>
</channel>
</rss>
