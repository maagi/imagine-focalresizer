<?php
namespace Maagi\ImagineFocalResizer\Test;

use Maagi\ImagineFocalResizer\FocalPoint;

class FocalPointTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiateWithIntAndFloatValues()
    {
        $fp = new FocalPoint(1, -1);

        $this->assertEquals(1, $fp->getX());
        $this->assertEquals(-1, $fp->getY());        

        $fp = new FocalPoint(0.5, -0.5);

        $this->assertEquals(0.5, $fp->getX());
        $this->assertEquals(-0.5, $fp->getY());        
    }

    public function testOutOfBoundValuesChangeToMaximumAndMinimumValues()
    {
        $fp = new FocalPoint(1000, -1000);

        $this->assertEquals(1, $fp->getX());
        $this->assertEquals(-1, $fp->getY());        
    }

    /**
     * @expectedException Maagi\ImagineFocalResizer\Exception\InvalidArgumentException
     */
    public function testThrowsExceptionWithInvalidValues()
    {
        new FocalPoint('foo', 'bar');        
    }
}

