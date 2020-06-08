<?php

require_once(__DIR__.'/../../Util.php');

/**
* ListCompression class
*
* Try to find a list order for which compression uses the least amount of memory
*
* @package ClassicComputerScienceProblemsInPhp
* @property $bytesCompressed How many bytes the compressed list takes up
*/
class ListCompression extends Chromosome {
  const PEOPLE = ["Michael", "Sarah", "Joshua", "Narine", "David", "Sajid", "Melanie", "Daniel", "Wei", "Dean", "Brian", "Murat", "Lisa"];

  /**
  * Current list
  * @var array
  */
  public $list = [];

  /**
  * Constructor
  *
  * @param array $list The list
  */
  public function __construct(array $list) {
    $this->list = $list;
  }

  /**
  * Magic getter method
  *
  * @param string $property
  * @return mixed The property value
  */
  public function __get($property) {
    switch ($property) {
    case 'bytesCompressed':
      return strlen(zlib_encode(implode(':', $this->list), ZLIB_ENCODING_DEFLATE));
    }
  }

  /**
  * Fitness function
  *
  * @return float
  */
  public function fitness(): float {
    return 1 / $this->bytesCompressed;
  }

  /**
  * Get a random instance
  *
  * @return Chromosome
  */
  public static function randomInstance(): Chromosome {
    $myList = self::PEOPLE;
    shuffle($myList);
    return new ListCompression($myList);
  }

  /**
  * Crossover
  *
  * @param Chromosome $other Another chromosome to crossover with
  * @return array Two modified chromosomes
  */
  public function crossover(Chromosome $other): array {
    $child1 = clone $this;
    $child2 = clone $other;
    $idx1 = rand(0, count($this->list) - 1);
    $idx2 = rand(0, count($this->list) - 1);
    $l1 = $child1->list[$idx1];
    $l2 = $child2->list[$idx2];
    $child1->list[array_search($l2, $child1->list)] = $child1->list[$idx2];
    $child1->list[$idx2] = $l2;
    $child2->list[array_search($l1, $child2->list)] = $child2->list[$idx1];
    $child2->list[$idx1] = $l1;
    return [$child1, $child2];
  }

  /**
  * Mutate
  *
  * Swap two locations
  */
  public function mutate() {
    $idx1 = rand(0, count($this->list) - 1);
    $idx2 = rand(0, count($this->list) - 1);
    $helper = $this->list[$idx1];
    $this->list[$idx1] = $this->list[$idx2];
    $this->list[$idx2] = $helper;
  }

  /**
  * String representation
  *
  * @return string
  */
  public function __toString(): string {
    return sprintf(
      "Order: %s; Bytes: %d",
      implode(', ', $this->list),
      $this->bytesCompressed
    );
  }
}