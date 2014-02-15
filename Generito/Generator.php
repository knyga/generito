<?php

/*
 * This file is part of the Generito package.
 *
 * (c) Oleksandr Knyga <oleksandrknyga@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Generito;

class Generator {
	/**
	 * @var Generito\Distribution\DistributionInterface
	 */
	private $distribution;

	/**
	 * Takes float as input and returns what user would like to see as result
	 * @var function
	 */
	private $handler;

	public function __construct($distribution, $handler) {
		$this->setDistribution($distribution);
		$this->setHandler($handler);
	}

	/**
	 * @param  integer $count
	 * @return array
	 */
	public function generate($count = 1) {
		$result = array();
		$handler = $this->handler;

		$this->distribution->setCount($count);

		for($i=0;$i<$count;$i++) {
			$result[] = $handler($this->distribution->random());
		}

		return $result;
	}

	/**
	 * @return misc
	 */
	public function generateOne() {
		$result = $this->generate(1);
		return $result[0];
	}

	/**
	 * @return Generito\Distribution\DistibutionInterface
	 */
	public function getDistribution() {
		return $this->distribution;
	}

	/**
	 * @param Generito\Distribution\DistibutionInterface $distribution
	 * @return Generator
	 */
	public function setDistribution($distribution) {
		$this->distribution = $distribution;
		return $this;
	}

	/**
	 * @return function
	 */
	public function getHandler() {
		return $this->handler;
	}

	/**
	 * @param function $handler
	 * @return Generator
	 */
	public function setHandler($handler) {
		$this->handler = $handler;
		return $this;
	}
}