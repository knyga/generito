<?php

/*
 * This file is part of the Generito package.
 *
 * (c) Oleksandr Knyga <oleksandrknyga@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Generito\Test;

use Generito\Distribution\DistributionFactory;
use Generito\Distribution\DistributionTypes;

class DistributionFactoryTest extends \PHPUnit_Framework_TestCase {
	private $factory;

	public function setUp() {
		$this->factory = new DistributionFactory();
	}

	public function testInstanceOf() {
		$discrete = $this->factory->createDistribution(DistributionTypes::DISCRETE);
		$this->assertInstanceOf('Generito\Distribution\Concrete\DiscreteDistribution', $discrete);
	}
}