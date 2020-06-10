<?php

require_once(__DIR__.'/../../Util.php');

/**
* SimpleEquation class
*
* Solve a mathematic equation using a genetic algorithm
*
* @package ClassicComputerScienceProblemsInPhp
*/
class SimpleEquation extends Chromosome {
  /**
  * x value of the equation
  * @var int
  */
  private $x = 0;

  /**
  * y value of the equation
  * @var int
  */
  private $y = 0;

  /**
  * Constructor
  *
  * @param int $x The x value
  * @param int $y The y value
  */
  public function __construct(int $x, int $y) {
    $this->x = $x;
    $this->y = $y;
  }

  /**
  * Calculate the fitness
  *
  * Put the current parameters into the equation 6x - x^2 + 4y - y^2
  *
  * @return float The fitness value
  */
  public function fitness(): float {
    return 6 * $this->x - $this->x * $this->x + 4 * $this->y - $this->y * $this->y;
  }

  /**
  * Randomly create an instance
  *
  * @return Chromosome The random instance
  */
  public static function randomInstance(): Chromosome {
    return new SimpleEquation(rand(0, 100), rand(0, 100));
  }

  /**
  * Crossover: swap two individuals' y values
  *
  * @param Chromosome $other The individual to crossover with
  * @return array Two modified chromosomes
  */
  public function crossover(Chromosome $other): array {
    $child1 = clone $this;
    $child2 = clone $other;
    $child1->y = $other->y;
    $child2->y = $this->y;
    return [$child1, $child2];
  }

  /**
  * Mutate
  */
  public function mutate() {
    if ((float)rand() / getrandmax() > 0.5) { // Mutate x
      if ((float)rand() / getrandmax() > 0.5) {
        $this->x++;
      } else {
        $this->x--;
      }
    } else { // Otherwise mutate y
      if ((float)rand() / getrandmax() > 0.5) {
        $this->y++;
      } else {
        $this->y--;
      }
    }
  }

  /**
  * String representation
  *
  * @return string
  */
  public function __toString(): string {
    return sprintf(
      "X: %d, Y: %d, Fitness: %.2f",
      $this->x,
      $this->y,
      $this->fitness()
    );
  }
}
