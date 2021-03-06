<?php

require_once(__DIR__.'/../Autoloader.php');

$original = str_repeat('TAGGGATTAACCGTTATATATATATAGCCATGGATCGATTATATAGGGATTAACCGTTATATATATATAGCCATGGATCGATTATA', 100);
Util::out(sprintf("Original: %d", strlen($original)));
$compressed = new CompressedGene($original);
Util::out(sprintf("Compressed: %d", strlen($compressed->getBitString())));
if ($original == $compressed->decompress()) {
  Util::out("Identical");
} else {
  Util::out("Different!");
}
