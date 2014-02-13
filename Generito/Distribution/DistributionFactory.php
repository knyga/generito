<?php

/*
 * This file is part of the Generito package.
 *
 * (c) Oleksandr Knyga <oleksandrknyga@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Generito\Distribution;

use Generito\Distribution\Concrete\DiscreteDistribution;
use Generito\Distribution\Concrete\FixedDistribution;
//use Generito\Distribution\Concrete\ContinuousDistribution;

class DistributionFactory {

	/**
	 * @param  string $type DistributionType
	 * @return DistributionInterface
	 */
	public function createDistribution($type) {
		switch($type) {
			case DistributionTypes::DISCRETE:
			return new DiscreteDistribution;

			case DistributionTypes::FIXED:
			return new FixedDistribution;

			// case DistributionTypes::CONTINUOUS:
			// return new ContinuousDistribution;

			default:
			throw new InvalidArgumentException("Invalid distribution type");
		}
	}

}