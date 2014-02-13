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

interface DistributionInterface {
	/**
	 * Gets frequencies
	 * @return array
	 */
	public function getFrequencies();

	/**
	 * Sets frequencies
	 * @param array $frequencies
	 * @return DistributionInterface
	 */
	public function setFrequencies($frequencies);

	/**
	 * @return Integer
	 */
	public function getCount();

	/**
	 * @param Integer $count
	 * @return FixedDistribution
	 */
	public function setCount($count);

	/**
	 * Returns random number, based on input frequencies
	 * @return float
	 * @throws \RuntimeException	Exception when no frequencies
	 */
	public function random();
}