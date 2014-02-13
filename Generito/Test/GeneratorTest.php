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

use Generito\Generator;
use Generito\Distribution\DistributionFactory;

use Generito\Helper\Random\Random;

class GeneratorTest extends \PHPUnit_Framework_TestCase {
	public function setUp() {
		$this->frequencies = array(
			4 => 100,
			5 => 100,
			6 => 50,
			7 => 50,
			8 => 50,
			9 => 50,
			10 => 100,
			11 => 40,
			12 => 30,
			13 => 20,
			14 => 50);

		$distribution = (new DistributionFactory)
			->createDistribution(DistributionFactory::DISCRETE)
			->setFrequencies($this->frequencies);

		$this->generator = new Generator($distribution,
			function($value) {
				return $value;
			});
	}

	public function testDiscreteGenerate() {
		$distribution = (new DistributionFactory)
			->createDistribution(DistributionFactory::DISCRETE)
			->setFrequencies($this->frequencies);

		$this->generator->setDistribution($distribution);

		$result = $this->generator->generate(6400);
		$cnt = array();
		
		for($i=0, $l = count($result);$i<$l;$i++) {
			$val = $result[$i];

			if(array_key_exists($val, $cnt)) {
				++$cnt[$val];
			} else {
				$cnt[$val] = 1;
			}
		}

		asort($cnt);
		$keys = array_keys($cnt);

		for($i = 1, $length = count($keys); $i < $length; $i++) {
			$this->assertLessThanOrEqual($this->frequencies[$keys[$i]], $this->frequencies[$keys[$i-1]]);
		}
	}

	public function testFixedGenerate() {
		$distribution = (new DistributionFactory)
			->createDistribution(DistributionFactory::FIXED)
			->setFrequencies($this->frequencies);

		$this->generator->setDistribution($distribution);

		$result = $this->generator->generate(6400);
		$cnt = array();
		
		for($i=0, $l = count($result);$i<$l;$i++) {
			$val = $result[$i];

			if(array_key_exists($val, $cnt)) {
				++$cnt[$val];
			} else {
				$cnt[$val] = 1;
			}
		}

		asort($cnt);
		$keys = array_keys($cnt);

		for($i = 1, $length = count($keys); $i < $length; $i++) {
			$this->assertLessThanOrEqual($this->frequencies[$keys[$i]], $this->frequencies[$keys[$i-1]]);
		}
	}

	public function testDiscreteGenerateRandomHandler() {
		$distribution = (new DistributionFactory)
			->createDistribution(DistributionFactory::DISCRETE)
			->setFrequencies($this->frequencies);

		$this->generator->setDistribution($distribution)
			->setHandler(function($value) {
				return array(
					"value" => $value,
					"code" => Random::getRandom()->getRandomString(8, "abcdefghijklmnopqrstuvwxyz0123456789")
					);
			});

		$result = $this->generator->generate(2);

		//var_dump($result);
	}
}