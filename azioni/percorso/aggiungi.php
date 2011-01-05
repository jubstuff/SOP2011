<?php
$post = print_r($_POST, true);

$fp = fopen ("Json.txt", "w+");
fwrite ($fp, $post);
fclose($fp);
?>
