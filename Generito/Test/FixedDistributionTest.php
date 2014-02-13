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

use Generito\Distribution\Concrete\FixedDistribution;

class FixedDistributionTest extends \PHPUnit_Framework_TestCase {
	public function testDistribution() {
		$distribution = new FixedDistribution;
		$distribution->setFrequencies(array(100, 200, 300));
		$cnt = array(0 => 0, 1 => 0, 2 => 0);
		
		for($i=0;$i<600;$i++) {
			++$cnt[$distribution->random()];
		}

		$this->assertGreaterThan($cnt[1], $cnt[2]);
		$this->assertGreaterThan($cnt[0], $cnt[1]);
	}

	public function testDistributionCountSet() {
		$distribution = new FixedDistribution;
		$distribution->setFrequencies(array(100, 200, 300));
		$distribution->setCount(1000);
		$cnt = array(0 => 0, 1 => 0, 2 => 0);
		
		for($i=0;$i<1000;$i++) {
			++$cnt[$distribution->random()];
		}

		$this->assertGreaterThan($cnt[1], $cnt[2]);
		$this->assertGreaterThan($cnt[0], $cnt[1]);
	}

	public function testDistributionAssosiative() {
		$distribution = new FixedDistribution;
		$distribution->setFrequencies(array('a' => 100, 'b' => 200, 'c' => 300));
		$cnt = array('a' => 0, 'b' => 0, 'c' => 0);
		
		for($i=0;$i<600;$i++) {
			++$cnt[$distribution->random()];
		}

		$this->assertGreaterThan($cnt['b'], $cnt['c']);
		$this->assertGreaterThan($cnt['a'], $cnt['b']);
	}

	/**
	 * @expectedException	\RuntimeException
	 */
	public function testDistributionAssosiativeThrowLimitException() {
		$distribution = new FixedDistribution;
		$distribution->setFrequencies(array('a' => 100, 'b' => 200, 'c' => 300));
		$cnt = array('a' => 0, 'b' => 0, 'c' => 0);
		
		for($i=0;$i<6000;$i++) {
			++$cnt[$distribution->random()];
		}

		$this->assertGreaterThan($cnt['b'], $cnt['c']);
		$this->assertGreaterThan($cnt['a'], $cnt['b']);
	}
}