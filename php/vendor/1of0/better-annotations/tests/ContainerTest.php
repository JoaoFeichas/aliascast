<?php

/**
 * Copyright (c) 2015 Bernardo van der Wal
 * MIT License
 *
 * Refer to the LICENSE file for the full copyright notice.
 */

namespace OneOfZero\BetterAnnotations\Tests;

use OneOfZero\BetterAnnotations\Annotations;
use OneOfZero\BetterAnnotations\Tests\Fixtures\ClassAnnotation;
use OneOfZero\BetterAnnotations\Tests\Fixtures\GenericAnnotation;
use OneOfZero\BetterAnnotations\Tests\Fixtures\MethodAnnotation;
use OneOfZero\BetterAnnotations\Tests\Fixtures\PropertyAnnotation;
use OneOfZero\BetterAnnotations\Tests\Fixtures\SimpleClass;
use ReflectionClass;

class ContainerTest extends AbstractTestCase
{
	public function testContainerKeySource()
	{
		$annotations = new Annotations($this->annotationReader, $this->container);

		$result = $annotations->get('simple');

		$this->assertCount(2, $result);
		$this->assertTrue($result[0] instanceof GenericAnnotation || $result[1] instanceof GenericAnnotation);
		$this->assertTrue($result[0] instanceof ClassAnnotation || $result[1] instanceof ClassAnnotation);
	}

	public function testContainerKeyMethodPointer()
	{
		$annotations = new Annotations($this->annotationReader, $this->container);

		$result = $annotations->get(['simple', 'annotatedMethod']);

		$this->assertCount(2, $result);
		$this->assertTrue($result[0] instanceof GenericAnnotation || $result[1] instanceof GenericAnnotation);
		$this->assertTrue($result[0] instanceof MethodAnnotation || $result[1] instanceof MethodAnnotation);
	}

	public function testContainerKeyPropertyPointer()
	{
		$annotations = new Annotations($this->annotationReader, $this->container);

		$result = $annotations->get(['simple', 'annotatedProperty']);

		$this->assertCount(2, $result);
		$this->assertTrue($result[0] instanceof GenericAnnotation || $result[1] instanceof GenericAnnotation);
		$this->assertTrue($result[0] instanceof PropertyAnnotation || $result[1] instanceof PropertyAnnotation);
	}
}
