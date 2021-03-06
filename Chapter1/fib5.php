<?php

require_once(__DIR__.'/../Autoloader.php');

function fib5(int $n) {
  yield 0; // Special case
  if ($n > 0) {
    yield 1; // Special case
  }
  $last = 0; // Initially set to fib(0)
  $next = 1; // Initially set to fib(1)
  for ($i = 1; $i < $n; $i++) {
    $helper = $last;
    $last = $next;
    $next += $helper;
    yield $next; // Main generator step
  }
}

foreach(fib5(50) as $i) {
   Util::out($i);
}
