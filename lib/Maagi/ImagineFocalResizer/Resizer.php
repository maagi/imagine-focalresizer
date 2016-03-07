<?php
namespace Maagi\ImagineFocalResizer;

use Imagine\Image\ImageInterface;
use Imagine\Image\BoxInterface;
use Imagine\Image\Box;
use Imagine\Image\Point;

class Resizer
{
    /**
     * resizes image using a focal point
     * @param  ImageInterface $image  an Imagine image
     * @param  BoxInterface   $size   size of resized imaga
     * @param  FocalPoint     $focal  focal point to use for size
     * @param  string         $filter Imagine filter to use
     * @return ImageInterface resized image
     */
    public function resize(ImageInterface $image, BoxInterface $size, FocalPointInterface $focal, $filter = ImageInterface::FILTER_UNDEFINED) 
    {
        $origSize = $image->getSize();
        $origWidth = $origSize->getWidth();
        $origHeight = $origSize->getHeight();
        $width = $size->getWidth();
        $height = $size->getHeight();
        $ratioHeight = $origHeight / $height;
        $ratioWidth = $origWidth / $width;

        if ($ratioHeight < $ratioWidth) {
            list($cropX1, $cropX2) = $this->calculateCrop($origWidth, $width, $focal->getX(), $ratioHeight);
            $cropY1 = 0;
            $cropY2 = $origHeight;
        } else {
            list($cropY1, $cropY2) = $this->calculateCrop($origHeight, $height, -$focal->getY(), $ratioWidth);
            $cropX1 = 0;
            $cropX2 = $origWidth;
        }

        $image
            ->crop(new Point($cropX1, $cropY1), new Box($cropX2 - $cropX1, $cropY2 - $cropY1))
            ->resize(new Box($width, $height, $filter))
        ;

        return $image;
    }

    protected function calculateCrop($origSize, $newSize, $focalFactor, $ratio) {
        $cropSize = $ratio * $newSize;

        $focalPoint = ($focalFactor + 1) * $origSize / 2;
        $cropStart = $focalPoint - $cropSize / 2;
        $cropEnd = $cropStart + $cropSize;

        if ($cropStart < 0) {
            $cropEnd -= $cropStart;
            $cropStart = 0;
        } else if ($cropEnd > $origSize) {
            $cropStart -= ($cropEnd - $origSize);
            $cropEnd = $origSize;
        }

        return array(ceil($cropStart), ceil($cropEnd));
    }
}