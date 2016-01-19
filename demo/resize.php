<?php
// change to Imagick or Gmagick if required
use Imagine\Gd\Imagine;
use Imagine\Image\ImageInterface;
use Imagine\Image\Box;
use Maagi\ImagineFocalResizer\Resizer;
use Maagi\ImagineFocalResizer\FocalPoint;

require_once '../vendor/autoload.php';

$width = $_POST['width'];
$height = $_POST['height'];
$focalx = $_POST['focalx'];
$focaly = $_POST['focaly'];

$imagine = new Imagine();
$resizer = new Resizer();

$image = $imagine->open('dragonfly.jpg');

$resizer->resize(
    $image, 
    new Box($width, $height),
    new FocalPoint($focalx, $focaly),
    ImageInterface::FILTER_UNDEFINED
);

// naturally you can do further processing to the image eg.
// $image->effects()->negative();

$image->save('dragonfly-resized.jpg');

header("Location: /?width=$width&height=$height&focalx=$focalx&focaly=$focaly");