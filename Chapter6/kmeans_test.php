<?php

require_once(__DIR__.'/../Autoloader.php');

$point1 = new DataPoint([2.0, 1.0, 1.0]);
$point2 = new DataPoint([2.0, 2.0, 5.0]);
$point3 = new DataPoint([3.0, 1.5, 2.5]);
$kmeansTest = new KMeans(2, [$point1, $point2, $point3]);
$testClusters = $kmeansTest->run();
foreach ($testClusters as $index => $cluster) {
  Util::out("Cluster $index:");
  foreach($cluster->points as $point) {
    Util::out($point);
  }
}
