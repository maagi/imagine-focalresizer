<?php
namespace Maagi\ImagineFocalResizer\Test;

use Imagine\Image\ImageInterface;
use Imagine\Image\Box;
use Imagine\Gd\Imagine;
use Maagi\ImagineFocalResizer\Resizer;
use Maagi\ImagineFocalResizer\FocalPoint;

class ResizerTest extends \PHPUnit_Framework_TestCase
{
    public function testResize()
    {
        $imagine = new Imagine();
        $resizer = new Resizer();

        $imageDir = __DIR__ . '/../../test-images';
        $target = $imageDir .'/resizedimage1.jpg';
        $image = $imagine->open($imageDir .'/testimage1.jpg');

        $resizer->resize(
            $image, 
            new Box(100, 200),
            new FocalPoint(0.5, -1),
            ImageInterface::FILTER_UNDEFINED
        );

        $image->save($target);

        $image = $imagine->open($target);
        $size = $image->getSize();

        $this->assertEquals(100, $size->getWidth());
        $this->assertEquals(200, $size->getHeight());

        unlink($target);
    }
}

