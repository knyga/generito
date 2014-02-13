<?php

/*
 * This file is part of the Generito package.
 *
 * (c) Oleksandr Knyga <oleksandrknyga@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Generito\Distribution\Concrete;

use Generito\Distribution\DistributionInterface;
use Generito\Distribution\AbstractDistribution;
use Generito\Helper\ArrayExt\ArrayExt;

/**
 * The FixedDistribution is a distribution that returns fixed numer of values and it's types based on input frequencies
 */
class FixedDistribution extends AbstractDistribution implements DistributionInterface {
	/**
	 * @var array(misc => integer)
	 */
	private $shouldReturnCount;

	/**
	 * @param Integer $count
	 * @return FixedDistribution
	 */
	public function setCount($count) {
		$this->shouldReturnCount = $this->calculateShouldRetuns($this->getFrequencies(), $count);
		return parent::setCount($count);
	}

	private function calculateShouldRetuns($frequencies, $count) {
		$freqTotal = array_sum($frequencies);
		$keys = array_keys($frequencies);
		$freqLength = count($frequencies);

		$normCoef = $count / $freqTotal;
		$shouldRetuns = $frequencies;
		$shouldTotal = 0;

		for($i=0;$i<$freqLength;$i++) {
			$shouldRetuns[$keys[$i]] = floor($shouldRetuns[$keys[$i]] * $normCoef);
			$shouldTotal += $shouldRetuns[$keys[$i]];
		}

		$shouldRetuns[$freqLength-1] += $count - $shouldTotal;

		return $shouldRetuns;
	}


	/**
	 * Returns new number, based on shouldReturnCount
	 * @return misc
	 * @throws \RuntimeException	Exception when no frequencies
	 */
	public function random() {
		if(!isset($this->shouldReturnCount)) {
			$this->shouldReturnCount = $this->getFrequencies();
		}

		$keys = array_keys($this->shouldReturnCount);
		$count = count($keys);

		for($i = 0; $i<$count && 0 == $this->shouldReturnCount[$keys[$i]]; $i++) {
			unset($this->shouldReturnCount[$keys[$i]]);
			$keys = array_keys($this->shouldReturnCount);
			$count = count($keys);
			--$i;
		}

		if($count > 0) {
			--$this->shouldReturnCount[$keys[$i]];
			return $keys[$i];
		} else {
			throw new \RuntimeException("Limit reached, no more elements");
		}
	}
}