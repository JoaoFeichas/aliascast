<?php

/**
 * Copyright (c) 2015 Bernardo van der Wal
 * MIT License
 *
 * Refer to the LICENSE file for the full copyright notice.
 */

namespace OneOfZero\BetterAnnotations\Tests\Helpers;

use DI\Container;
use DI\ContainerBuilder;
use function DI\get;
use function DI\object;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\Reader;
use OneOfZero\BetterAnnotations\Tests\Fixtures\SimpleClass;
use PHPUnit_Framework_BaseTestListener;
use PHPUnit_Framework_Test;

class PhpUnitDependencyInjector extends PHPUnit_Framework_BaseTestListener
{
	/**
	 * @var Container $container
	 */
	private static $container;

	/**
	 * @return Container
	 */
	private static function getContainer()
	{
		if (!self::$container)
		{
			AnnotationRegistry::registerLoader([ require __DIR__ . '/../../vendor/autoload.php', 'loadClass' ]);

			self::$container = (new ContainerBuilder)
				->useAnnotations(true)
				->addDefinitions([
					Reader::class => object(AnnotationReader::class),
					SimpleClass::class => object(),
					'simple' => get(SimpleClass::class)
				])
				->build()
			;
		}
		return self::$container;
	}

	/**
	 * @param PHPUnit_Framework_Test $test
	 */
	public function startTest(PHPUnit_Framework_Test $test)
	{
		self::getContainer()->injectOn($test);
	}
}