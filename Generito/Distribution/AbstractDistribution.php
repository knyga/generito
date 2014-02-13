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

use Generito\Helper\ArrayExt\ArrayExt;

abstract class AbstractDistribution implements DistributionInterface {
	/**
	 * Array like (100, 200, 100)
	 * or (4 => 100, 5 => 200, 6 => 100)
	 * @var array
	 */
	private $frequencies;

	/**
	 * Accomulated frequencies. For (100, 200, 100) is (100, 300, 400)
	 * @var array
	 */
	private $accomulated;

	/**
	 * @var Integer
	 */
	private $count;

	/**
	 * Gets frequencies
	 * @return array
	 */
	public function getFrequencies() {
		return $this->frequencies;
	}

	/**
	 * Sets frequencies
	 * @param array $frequencies
	 * @return DistributionInterface
	 */
	public function setFrequencies($frequencies) {
		$this->frequencies = $frequencies;
		$this->accomulated = $this->accomulate($frequencies);
		return $this;
	}

	/**
	 * Gets accomulated from frequencies values
	 * @return array
	 */
	protected function getAccomulated() {
		return $this->accomulated;
	}

	/**
	 * Sets accomulated from frequencies  values
	 * @param array $accomulated
	 * @return DistributionInterface
	 */
	protected function setAccomulated($accomulated) {
		$this->accomulated = $accomulated;
		return $this;
	}

	/**
	 * @return Integer
	 */
	public function getCount() {
		return $this->count;
	}

	/**
	 * @param Integer $count
	 * @return FixedDistribution
	 */
	public function setCount($count) {
		$this->count = $count;
		return $this;
	}

	protected function accomulate($frequencies) {
		$accomulated = array();
		$fLength = count($frequencies);


		if($fLength < 1) {
			return $accomulated;
		}

		if(ArrayExt::isAssociative($frequencies)) {
			$frequencies = array_values($frequencies);
		}

		$accomulated[0] = $frequencies[0];

		for($i=1; $i < $fLength; $i++) {
			$accomulated[] = $accomulated[$i - 1] + $frequencies[$i];
		}

		return $accomulated;
	}

	/**
	 * Returns random number, based on input frequencies
	 * @return integer
	 * @throws \RuntimeException	Exception when no frequencies
	 */
	public function random() {
		throw new RuntimeException("Unsupported operation");
	}
}