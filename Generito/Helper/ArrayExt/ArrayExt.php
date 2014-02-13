<?php

/*
 * This file is part of the Generito package.
 *
 * (c) Oleksandr Knyga <oleksandrknyga@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Generito\Helper\ArrayExt;

class ArrayExt {
	public static function isAssociative($arr) {
		return array_keys($arr) !== range(0, count($arr) - 1);
	}
}