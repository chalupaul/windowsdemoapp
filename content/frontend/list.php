<?php
require "./_config.php";
require "./_header.php";

# list all names

$names_url = "http://" . $app_hostname . "/api/names";

$raw_names = file_get_contents($names_url);
$raw_names = str_replace('[', '', $raw_names);
$raw_names = str_replace(']', '', $raw_names);
$raw_names = str_replace('"', '', $raw_names);

$names = explode(',', $raw_names);


?>

<h2>
<?php 
print "Total Names: " . count($names) . "\n";
?>
</h2>
<ul>
<?php foreach ($names as $name)
	print "<li>" . $name . "</li>\n";
?>
</ul>

<?php
require "./_footer.php";
?>
