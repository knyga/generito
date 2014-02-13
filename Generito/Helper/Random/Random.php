<?php

/*
 * This file is part of the Generito package.
 *
 * (c) Oleksandr Knyga <oleksandrknyga@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Generito\Helper\Random;

//https://github.com/rchouinard/rych-random/blob/master/Random.php
use Rych\Random\Random as RychRandom;

class Random {
	private static $random;

	public static function getRandom(GeneratorInterface $generator = null, EncoderInterface $encoder = null) {
		if(!isset(static::$random)) {
			static::$random = new RychRandom($generator, $encoder);
		}

		return static::$random;
	}

	private function __construct() {
		throw new \RuntimeException("Unsupported operation");
	}
}