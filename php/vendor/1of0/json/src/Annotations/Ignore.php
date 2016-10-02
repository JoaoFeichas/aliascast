<?php
/**
 * Copyright (c) 2016 Bernardo van der Wal
 * MIT License
 *
 * Refer to the LICENSE file for the full copyright notice.
 */

namespace OneOfZero\Json\Annotations;

use Doctrine\Common\Annotations\Annotation;

/**
 * Specified that the annotated member should not be serialized or deserialized.
 * 
 * @Annotation
 * @Target({"PROPERTY","METHOD"})
 */
class Ignore extends Annotation
{
	/**
	 * @var bool $ignoreOnSerialize
	 */
	public $ignoreOnSerialize = true;

	/**
	 * @var bool $ignoreOnDeserialize
	 */
	public $ignoreOnDeserialize = true;
}
