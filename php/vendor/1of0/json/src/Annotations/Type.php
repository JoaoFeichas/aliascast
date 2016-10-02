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
 * Specifies the type for the annotated member.
 * 
 * @Annotation
 * @Target({"PROPERTY","METHOD"})
 */
class Type extends Annotation
{
	/**
	 * @var string $value
	 */
	public $value;
}
