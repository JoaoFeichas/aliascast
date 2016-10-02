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
 * Explicitly includes the annotated method as a setter.
 * 
 * @Annotation
 * @Target({"METHOD"})
 */
class Setter extends AbstractName
{

}
