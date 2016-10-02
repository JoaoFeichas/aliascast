<?php

/**
 * Created by PhpStorm.
 * User: joaofeichas
 * Date: 02/10/16
 * Time: 09:32
 */
class NumberUtilsTest extends PHPUnit_Framework_TestCase
{
    public function testLongNumber()
    {
        $number = 1;

        $longNumber = NumberUtils::getInstance()->toLongNumber($number);

        return $longNumber;
    }
}
