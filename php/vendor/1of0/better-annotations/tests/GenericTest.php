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

class GenericTest extends AbstractTestCase
{
	public function testReflectorSources()
	{
		$annotations = new Annotations($this->annotationReader);

		$annotatedClass = new ReflectionClass(SimpleClass::class);
		$annotatedProperty = $annotatedClass->getProperty('annotatedProperty');
		$annotatedMethod = $annotatedClass->getMethod('annotatedMethod');
		$nonAnnotatedMethod = $annotatedClass->getMethod('nonAnnotatedMethod');

		// Test multiple result calls

		$result = $annotations->get($annotatedClass);
		$this->assertCount(2, $result);
		$this->assertTrue($result[0] instanceof GenericAnnotation || $result[1] instanceof GenericAnnotation);
		$this->assertTrue($result[0] instanceof ClassAnnotation || $result[1] instanceof ClassAnnotation);

		$result = $annotations->get($annotatedProperty);
		$this->assertCount(2, $result);
		$this->assertTrue($result[0] instanceof GenericAnnotation || $result[1] instanceof GenericAnnotation);
		$this->assertTrue($result[0] instanceof PropertyAnnotation || $result[1] instanceof PropertyAnnotation);

		$result = $annotations->get($annotatedMethod);
		$this->assertCount(2, $result);
		$this->assertTrue($result[0] instanceof GenericAnnotation || $result[1] instanceof GenericAnnotation);
		$this->assertTrue($result[0] instanceof MethodAnnotation || $result[1] instanceof MethodAnnotation);

		$result = $annotations->get($nonAnnotatedMethod);
		$this->assertNotNull($result);
		$this->assertCount(0, $result);

		// Test single result calls

		$this->assertInstanceOf(ClassAnnotation::class, $annotations->get($annotatedClass, ClassAnnotation::class));
		$this->assertNull($annotations->get($annotatedClass, PropertyAnnotation::class));
		$this->assertNull($annotations->get($annotatedClass, MethodAnnotation::class));

		$this->assertInstanceOf(PropertyAnnotation::class, $annotations->get($annotatedProperty, PropertyAnnotation::class));
		$this->assertNull($annotations->get($annotatedProperty, ClassAnnotation::class));
		$this->assertNull($annotations->get($annotatedProperty, MethodAnnotation::class));

		$this->assertInstanceOf(MethodAnnotation::class, $annotations->get($annotatedMethod, MethodAnnotation::class));
		$this->assertNull($annotations->get($annotatedMethod, ClassAnnotation::class));
		$this->assertNull($annotations->get($annotatedMethod, PropertyAnnotation::class));

		$this->assertNull($annotations->get($nonAnnotatedMethod, ClassAnnotation::class));
		$this->assertNull($annotations->get($nonAnnotatedMethod, MethodAnnotation::class));
		$this->assertNull($annotations->get($nonAnnotatedMethod, PropertyAnnotation::class));
	}

	public function testClassNameSource()
	{
		$annotations = new Annotations($this->annotationReader);

		$result = $annotations->get(SimpleClass::class);

		$this->assertCount(2, $result);
		$this->assertTrue($result[0] instanceof GenericAnnotation || $result[1] instanceof GenericAnnotation);
		$this->assertTrue($result[0] instanceof ClassAnnotation || $result[1] instanceof ClassAnnotation);
	}

	public function testInstanceSource()
	{
		$annotations = new Annotations($this->annotationReader);

		$result = $annotations->get(new SimpleClass());

		$this->assertCount(2, $result);
		$this->assertTrue($result[0] instanceof GenericAnnotation || $result[1] instanceof GenericAnnotation);
		$this->assertTrue($result[0] instanceof ClassAnnotation || $result[1] instanceof ClassAnnotation);
	}

	public function testMethodPointer()
	{
		$annotations = new Annotations($this->annotationReader);

		$result = $annotations->get([SimpleClass::class, 'annotatedMethod']);

		$this->assertCount(2, $result);
		$this->assertTrue($result[0] instanceof GenericAnnotation || $result[1] instanceof GenericAnnotation);
		$this->assertTrue($result[0] instanceof MethodAnnotation || $result[1] instanceof MethodAnnotation);
	}

	public function testPropertyPointer()
	{
		$annotations = new Annotations($this->annotationReader);

		$result = $annotations->get([SimpleClass::class, 'annotatedProperty']);

		$this->assertCount(2, $result);
		$this->assertTrue($result[0] instanceof GenericAnnotation || $result[1] instanceof GenericAnnotation);
		$this->assertTrue($result[0] instanceof PropertyAnnotation || $result[1] instanceof PropertyAnnotation);
	}

	public function testMultipleAnnotationsOfSameType()
	{
		$annotations = new Annotations($this->annotationReader);

		// Fetching all annotations

		$result = $annotations->get([SimpleClass::class, 'multipleAnnotationsOfSameType']);

		$this->assertCount(4, $result);
		$total = 0;
		foreach ($result as $annotation)
		{
			$this->assertTrue($annotation instanceof GenericAnnotation || $annotation instanceof MethodAnnotation);
			$total += intval($annotation->value);
		}
		$this->assertEquals(10, $total);

		// Only fetching MethodAnnotation annotations

		$result = $annotations->get([SimpleClass::class, 'multipleAnnotationsOfSameType'], MethodAnnotation::class, true);

		$this->assertCount(3, $result);
		$total = 0;
		foreach ($result as $annotation)
		{
			$this->assertInstanceOf(MethodAnnotation::class, $annotation);
			$total += intval($annotation->value);
		}
		$this->assertEquals(9, $total);
	}
}
