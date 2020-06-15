<?php

require_once(__DIR__.'/../../../Util.php');

use PHPUnit\Framework\TestCase;

final class LayerTest extends TestCase {
  /**
  * @covers Layer::__construct
  */
  public function testConstructInputLayer() {
    $layer = new Layer_TestProxy(NULL, 2, 0.5);
    $this->assertInstanceOf('Layer', $layer);
  }

  /**
  * @covers Layer::__construct
  */
  public function testConstructOtherLayer() {
    $previousLayer = new Layer_TestProxy(NULL, 2, 0.5);
    $layer = new Layer_TestProxy($previousLayer, 2, 0.5);
    $this->assertInstanceOf('Layer', $layer);
  }

  /**
  * @covers Layer::outputs
  */
  public function testOutputsForInputLayer() {
    $layer = new Layer_TestProxy(NULL, 2, 0.5);
    $this->assertEquals([1, 1], $layer->outputs([1, 1]));
  }

  /**
  * @covers Layer::outputs
  */
  public function testOutputsForOtherLayer() {
    $previousLayer = new Layer_TestProxy(NULL, 2, 0.5);
    $layer = new Layer_TestProxy($previousLayer, 2, 0.5);
    $this->assertEquals(2, count($layer->outputs([1, 1])));
  }
}

class Layer_TestProxy extends Layer {
  public function createNeuron(array $weights, float $learningRate): Neuron {
    return new Layer_TestProxy_Neuron($weights, $learningRate);
  }

  public function derivativeActivationFunction(float $x): float {
    return $x;
  }
}

class Layer_TestProxy_Neuron extends Neuron {
  public function activationFunction(float $x): float {
    return $x;
  }
}
