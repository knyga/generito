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
 * The DiscreteDistribution is a distribution that returns random values, given as input
 */
class DiscreteDistribution extends AbstractDistribution implements DistributionInterface {

	/**
	 * Returns random number, based on input frequencies
	 * @return integer
	 * @throws \RuntimeException	Exception when no frequencies
	 */
	public function random() {
		$accomulated = $this->getAccomulated();

		if(!isset($accomulated)) {
			throw new \RuntimeException("Accomulated values not specified");
		}

		$length = count($accomulated);

		if($length < 2) {
			return $this->result(0);
		}

		$randomValue = rand(0, $accomulated[$length - 1]);

		if($randomValue < $accomulated[0]) {
			return $this->result(0);
		}

		for($i = 1; $i < $length; $i++) {

			if($accomulated[$i-1] < $randomValue && $accomulated[$i] >= $randomValue) {
				return $this->result($i);
			}
		}

		return $this->result(0);
	}

	private function result($position) {
		$frequencies = $this->getFrequencies();

		if(ArrayExt::isAssociative($frequencies)) {
			$keys = array_keys($frequencies);
			return $keys[$position];
		} else {
			return $position;
		}
	}
}