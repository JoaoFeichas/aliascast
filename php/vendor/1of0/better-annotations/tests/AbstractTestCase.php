<?php

/**
 * Copyright (c) 2015 Bernardo van der Wal
 * MIT License
 *
 * Refer to the LICENSE file for the full copyright notice.
 */

namespace OneOfZero\BetterAnnotations\Tests;

use DI\Annotation\Inject;
use DI\Container;
use Doctrine\Common\Annotations\Reader;
use \PHPUnit_Framework_TestCase;

class AbstractTestCase extends PHPUnit_Framework_TestCase
{
	/**
	 * @Inject
	 * @var Container $container
	 */
	protected $container;

	/**
	 * @Inject
	 * @var Reader $annotationReader
	 */
	protected $annotationReader;
}
