<?php

/**
 * Copyright (c) 2015 Bernardo van der Wal
 * MIT License
 *
 * Refer to the LICENSE file for the full copyright notice.
 */

namespace OneOfZero\Json\Test\FixtureClasses;

use OneOfZero\Json\Annotations\Converter;
use /** @noinspection PhpUnusedAliasInspection */OneOfZero\Json\Test\FixtureClasses\StaticCustomConverter;

class ClassUsingStaticCustomConverter
{
	/**
	 * @Converter(StaticCustomConverter::class)
	 * @var string $someProperty
	 */
	public $someProperty;
}
