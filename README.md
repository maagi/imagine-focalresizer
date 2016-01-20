#ImagineFocalResizer

A tool for [Imagine Image manipulation library](http://imagine.readthedocs.org/) for PHP to resize its image instances using a central "focal point". The image will always be cropped so that the focal point remains within the resized image. This allows to create versions for different screen sizes while maintaining a "responsive crop".

The focal point defined by x and y coordinates ranging from the left top corner (-1,-1) to the right bottom corner (1,1). The center of the image is at (0,0).

The idea comes from Jono Menz's jQuery FocusPoint plugin. Its [documentation](https://github.com/jonom/jquery-focuspoint) illustrates how the approach works.

##Installation##

Use [Composer](https://getcomposer.org/) to install.

```bash
$ composer require maagi/imagine-focalresizer
```

##Usage##

```
use Imagine\Gd\Imagine; // or Imagick/Gmagick
use Imagine\Image\ImageInterface;
use Imagine\Image\Box;
use Maagi\ImagineFocalResizer\Resizer;
use Maagi\ImagineFocalResizer\FocalPoint;

$imagine = new Imagine();
$image = $imagine->open('dragonfly.jpg');

$resizer = new Resizer();

$resizer->resize(
    $image, 
    // target size
    new Box(100, 200),
    // crop around the point at 50% to the right and 70% to the top
    new FocalPoint(0.5, -0.7),  
    // Imagine filter for resize (optional)
    ImageInterface::FILTER_UNDEFINED 
);

// maybe do further processing with the image...

$image->save('dragonfly-resized.jpg');
```