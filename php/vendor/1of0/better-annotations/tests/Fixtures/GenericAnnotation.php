<?php

/**
 * Copyright (c) 2015 Bernardo van der Wal
 * MIT License
 *
 * Refer to the LICENSE file for the full copyright notice.
 */

namespace OneOfZero\BetterAnnotations\Tests\Fixtures;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Target("ALL")
 */
class GenericAnnotation extends Annotation
{

}