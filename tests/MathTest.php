<?php
/**
 * Created by PhpStorm.
 * User: Dell_PC
 * Date: 8/16/2019
 * Time: 22:15
 */
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testDouble()
    {
        $double = \Event\Math::double(2);
        $this->assertEquals(4,$double);
    }

    public function testDoubleIfzero()
    {
        $this->assertEquals(0,\Event\Math::double(0));
    }
}