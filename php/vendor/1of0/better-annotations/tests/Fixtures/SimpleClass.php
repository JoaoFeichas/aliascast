<?php

/**
 * Copyright (c) 2015 Bernardo van der Wal
 * MIT License
 *
 * Refer to the LICENSE file for the full copyright notice.
 */

namespace OneOfZero\BetterAnnotations\Tests\Fixtures;

/**
 * @GenericAnnotation
 * @ClassAnnotation
 */
class SimpleClass
{
	/**
	 * @GenericAnnotation
	 * @PropertyAnnotation
	 */
	public $annotatedProperty;

	/**
	 * @GenericAnnotation
	 * @MethodAnnotation
	 */
	public function annotatedMethod()
	{
	}

	/**
	 *
	 */
	public function nonAnnotatedMethod()
	{

	}

	/**
	 * @GenericAnnotation("1")
	 * @MethodAnnotation("2")
	 * @MethodAnnotation("3")
	 * @MethodAnnotation("4")
	 */
	public function multipleAnnotationsOfSameType()
	{

	}
}